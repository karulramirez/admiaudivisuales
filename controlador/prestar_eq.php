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
            //echo $value1.": VALOR<br>";
            

            if ($value2==0 or $value2=="") {

                $equipos[$key2] = $value1;

                if($key1=="cedula" or $key1=="serial") {

                    if (preg_match(EXPREG['number'],$value1)) {
                        $sentencia ="";

                        if ($key1=="cedula") {
                            $sentencia = "SELECT * FROM ".TABLAS['pres']." WHERE usuario_idUsuario='".$equipos['usuario_idUsuario']."'";
                        }else{
                            $sentencia = "SELECT * FROM ".TABLAS['pres']." WHERE equipos_sn='".$equipos['equipos_sn']."'";
                        }

                        $consulta = new Consultar();
                        $array = $consulta->getDates($sentencia);
                        
                        if ($array) {
                            $validar = 2;
                            $razon = "El equipo ha sido prestado o el usuario ya tiene un equipo en prestamo";
                            break;
                        }else{
                            $validar = 1;
                        }
                    }else{
                        $razon = "la cedula y el serial solo pueden ser numericos "+$value1;
                        $validar =2;
                        break;
                    }

                    

                }else{

                    if ($hoy > $equipos['fechaHoraFinal']) {
                        echo "La fecha de entrega ya ha pasado";
                        $validar = 2;
                    }
                }
                break;

                
            }

        }

        if ($validar==2) {
            break;
        }

    }

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