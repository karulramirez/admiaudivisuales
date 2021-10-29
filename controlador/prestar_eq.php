<?php

//require "../DB/Functions_Mysql.php";

#incluir el archivo Funtions_Mysql.php en el body de la vista antes de llamar a este archivo

$equipos = array("idprestamo"=>-1,
"usuario_idUsuario"=>0,
"equipos_sn" => 0,
"fechaHoraFinal"=>"");


$validar=0;
$razon = "";
$hoy = date("Y-m-d");

if (count($_POST)==4) {


    foreach ($_POST as $key1 => $value1) {

        #echo $key1." : ".$value1." <br><br>";


        foreach ($equipos as $key2 => $value2) {

            #echo $key2." : ".$value2." : ".$key1."<br><br>";
            #echo $value1.": VALOR<br>";
            

            if ($value2==0 or $value2=="") {

                //$equipos[$key2] = $value1;

                if($key1=="cedula") {

                    if (preg_match(EXPREG['number'],$value1)) {
                        $sentencia ="";
                        $consulta = new Consultar();

                        if ($key1=="cedula") {

                            $consulta2 = new Consultar();
                            $sentencia = "SELECT * FROM ".TABLAS['user']." WHERE cedula=".$value1."";
                            $array2 = $consulta2->getDates($sentencia);

                            if (!$array2) {
                                $razon = "El usuario no existe";
                                $validar = 2;

                            }else{
                                foreach ($array2 as $fila) {
                                    
                                    $equipos['usuario_idUsuario']=$fila['idUsuario'];
                                }
                                
                                $sentencia = "SELECT * FROM ".TABLAS['pres']." WHERE usuario_idUsuario=".$equipos['usuario_idUsuario']."";
                                $array = $consulta->getDates($sentencia);

                                if ($array) {
                                    foreach ($array as $fila) {
                                        
                                        if (!$fila['fechaDevolucion']) {
                                            $razon = "El usuario ya tiene un equipo prestado";
                                            $validar = 2;
                                            break;
                                        }
                                        
                                    }
                                }
                            }

                            break;

                        }

                    }else{
                        $razon = "la cedula solo pueden se numerico "+$value1;
                        $validar =2;
                        break;
                    }

                    

                }elseif($key1=="serial"){

                    $sentencia = "SELECT * FROM ".TABLAS['eq']." WHERE serial='".$value1."'";
                    $array = $consulta->getDates($sentencia);

                    if ($array) {
                        foreach ($array as $fila) {

                            if ($fila['disponible']=="No") {
                                $razon = "El equipo no esta disponible";
                                $validar = 2;
                            }
                            
                            $equipos['equipos_sn']=$fila['sn'];
                        }
                    }else{
                        $razon = "El serial del equipo no existe";
                        $validar = 2;
                    }
                    break;

                }else{
                    $equipos['fechaHoraFinal'] = $value1;

                    if ($hoy > $equipos['fechaHoraFinal']) {
                        $razon = "La fecha de entrega ya ha pasado";
                        $validar = 2;
                        break;
                    }elseif ($validar==0) {
                        $validar=1;
                    }
                    break;
                }

                
            }

        }

        if ($validar==2 or $validar==1) {
            break;
        }

    }

    #$razon = $validar;

    if ($validar==1) {

        $buscar = new Consultar();

        $info = $buscar->getDates("SELECT MAX(idprestamo)+1 AS Ultimo FROM ".TABLAS['pres']);

        if ($info) {
            foreach ($info as $llave) {
                $idPres = $info[0]['Ultimo'];
    
            }
        }else{
            $idPres = 0;
        }


        

        //echo var_dump(array_values($info)); revisar estructura array

        $insertar = new Insertar(TABLAS['pres']);
        $hoy = date("Y-m-d H:i:s");

        //echo $equipos['fechaHoraFinal'] ." : ".$equipos['equipos_sn']." : ".$equipos['equipos_sn']." : ".$equipos['usuario_idUsuario'];

        $equipos['idprestamo']=$idPres;

        $insertar->add('fechaHoraInicio',$hoy);

        foreach ($equipos as $key => $value) {

            $insertar->add($key,$value);

        }

        $insertar->ready();

        $actualizar = new Update(TABLAS['eq'],'sn',$equipos['equipos_sn']);
        $actualizar->addVal('disponible','No');
        $actualizar->ready();

        /*$consulta = "SELECT * FROM ".TABLAS['user']." WHERE correo='".$login['correo']."' AND clave='".$login['password']."'";

        $validar = new Consultar();

        $array = $validar->getDates($consulta);

        if ($array) {
            echo "BIENVENIDO";
        }else{
            echo "Cuenta no valida";
        }*/

    }else{
        echo "no se pudo completar el registro: ".$razon."<br>";
    }

}else{
    echo"No se pudo leer los datos<br>".count($_POST);
}

?>