<?php

//require "../DB/Functions_Mysql.php";

#incluir el archivo Funtions_Mysql.php en el body de la vista antes de llamar a este archivo

$mantenimiento = array("idmantenimiento"=>-1,
"FechaInicioMant"=>"",
"descripcion"=>"",
"equipos_sn"=>0);


$validar=0;
$razon = "";

if (count($_POST)==3) {


    foreach ($_POST as $key1 => $value1) {

        #echo $key1." : ".$value1." <br><br>";


        foreach ($mantenimiento as $key2 => $value2) {

            #echo $key2." : ".$value2." : ".$key1."<br><br>";
            #echo $value1.": VALOR<br>";
            

            if ($value2==0 or $value2=="") {

                //$mantenimiento[$key2] = $value1;

                if($key1=="serial"){

                    $sentencia = "SELECT * FROM ".TABLAS['eq']." WHERE serial='".$value1."'";
                    $consulta = new Consultar();
                    $array = $consulta->getDates($sentencia);

                    if ($array) {
                        foreach ($array as $fila) {

                            if ($fila['disponible']=="No") {
                                $razon = "El equipo no esta disponible";
                                $validar = 2;
                                break;
                            }
                            
                            $mantenimiento['equipos_sn']=$fila['sn'];
                        }
                    }else{
                        $razon = "El serial del equipo no existe";
                        $validar = 2;
                        break;
                    }

                }elseif($key1=="descripcion"){
                    $mantenimiento['descripcion'] = $value1;
                    $validar = 1;
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

        $info = $buscar->getDates("SELECT MAX(idmantenimiento)+1 AS Ultimo FROM ".TABLAS['mant']);

        if ($info) {
            foreach ($info as $llave) {
                $idMant = $info[0]['Ultimo'];
    
            }
        }else{
            $idMant = 0;
        }


        

        //echo var_dump(array_values($info)); revisar estructura array

        $insertar = new Insertar(TABLAS['mant']);
        $hoy = date("Y-m-d H:i:s");

        //echo $mantenimiento['fechaHoraFinal'] ." : ".$mantenimiento['mantenimiento$mantenimiento_sn']." : ".$mantenimiento['mantenimiento$mantenimiento_sn']." : ".$mantenimiento['usuario_idUsuario'];

        $mantenimiento['idmantenimiento']=$idMant;
        $mantenimiento['FechaInicioMant']=$hoy;

        foreach ($mantenimiento as $key => $value) {

            $insertar->add($key,$value);

        }

        $insertar->ready();

        $actualizar = new Update(TABLAS['eq'],'sn',$mantenimiento['equipos_sn']);
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