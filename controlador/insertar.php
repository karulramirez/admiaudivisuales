<?php

#incluir el archivo Funtions_Mysql.php en el body de la vista antes de llamar a este archivo

$equipos = array("cedula"=>0,
"nombre"=>"",
"apellido"=>"",
"facultad"=>"",
"tel"=>"",
"correo"=>"");


$validar=0;
$razon = "";

if (count($_POST)==6) {


    foreach ($_POST as $key1 => $value1) {

        #echo $key1." : ".$value1." <br><br>";


        foreach ($equipos as $key2 => $value2) {

            #echo $key2." : ".$value2." : ".$key1."<br><br>";
            

            if ($key1==$key2) {

                $equipos[$key2] = $value1;

                /*if ($key1=="nombres" OR $key1=="apellidos") {

                    if (!preg_match(EXPREG['letras'],$value1)) {
                        $validar=2;
                        echo "solo letras y espacios <br><br>";
                    }

                }*/

                if ($value1=="" and $key1!="correo") {
                    $razon = "Algunos campos obligatorios estan vacios";
                    $validar = 2;

                }elseif($key1=="cedula") {

                    if (preg_match(EXPREG['number'],$value1)) {
                        $sentencia = "SELECT * FROM ".TABLAS['usuarios']." WHERE cedula='".$usuario['cedula']."'";
                        $consulta = new Consultar();
                        $array = $consulta->getDates($sentencia);
                        
                        if ($array) {
                            $validar = 2;
                            $razon = "El cedula ya se encuentra registrado";
                        }else{
                            $validar = 1;
                        }
                    }else{
                        $razon = "el cedula solo puede ser numerico";
                        $validar =2;
                        break;
                    }

                    

                }

                
            }

        }

        if ($validar==2) {
            break;
        }

    }

    if ($validar==1) {

        $buscar = new Consultar();

        /*$info = $buscar->getDates("SELECT MAX(codUser)+1 AS Ultimo FROM ".TABLAS['user']);


        foreach ($info as $llave) {
            $codUs = $info[0]['Ultimo'];

        }*/

        //echo var_dump(array_values($info)); revisar estructura array

        $insertar = new Insertar(TABLAS['eq']);

        #$insertar->add('codUser',$codUs);

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
