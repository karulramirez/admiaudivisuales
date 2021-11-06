<?php

#incluir el archivo Funtions_Mysql.php en el body de la vista antes de llamar a este archivo

$usuario = array("idUsuario"=>0,
"cedula"=>0,
"nombre"=>"",
"apellido"=>"",
"facultad"=>"",
"tel"=>"",
"correo"=>"",
"tipoUsuario"=>"");


$validar=0;
$razon = "";

if (count($_POST)==8) {


    foreach ($_POST as $key1 => $value1) {

        #echo $key1." : ".$value1." <br><br>";


        foreach ($usuario as $key2 => $value2) {

            #echo $key2." : ".$value2." : ".$key1."<br><br>";
            

            if ($key1==$key2) {
                $usuario[$key2] = $value1;

                if ($key1=="nombres" OR $key1=="apellido") {


                    if (!preg_match(EXPREG['letras'],$value1)) {
                        $validar=2;
                        $razon = "solo letras y espacios en los campos determinados <br><br>";
                        break;
                    }elseif($usuario['nombre']!="" AND $usuario['apellido']!=""){
                        //echo "entro";
                        $usuario['nombre'] = strtoupper($usuario['nombre']);
                        $usuario['apellido'] = strtoupper($usuario['apellido']);

                        $sentencia = "SELECT * FROM ".TABLAS['user']." WHERE nombre='".$usuario['nombre']."' AND apellido='".$usuario['apellido']."'";
                        $consulta = new Consultar();
                        $array = $consulta->getDates($sentencia);

                        if ($array) {
                            $razon = "El usuario ya se encuentra registrado";
                            $validar=2;
                            break;
                        }
                    }

                    break;

                }

                if ($value1=="" and $key1!="correo") {
                    $razon = "Algunos campos obligatorios estan vacios";
                    $validar = 2;
                    break;

                }elseif($key1=="cedula") {

                    if (preg_match(EXPREG['number'],$value1)) {
                        $sentencia = "SELECT * FROM ".TABLAS['user']." WHERE cedula='".$usuario['cedula']."'";
                        $consulta = new Consultar();
                        $array = $consulta->getDates($sentencia);
                        
                        if ($array) {
                            $validar = 2;
                            $razon = "La cedula ya se encuentra registrada";
                        }else{
                            $validar = 1;
                        }
                    }else{
                        $razon = "La cedula solo puede ser numerica";
                        $validar =2;
                        break;
                    }
                    break;

                    

                }elseif ($key1=="correo") {

                    if (preg_match(EXPREG['email'],$value1)) {

                        $sentencia = "SELECT * FROM ".TABLAS['user']." WHERE correo='".$usuario['correo']."'";
                        $consulta = new Consultar();
                        $array = $consulta->getDates($sentencia);

                        if ($array) {
                            $razon = "El correo ya se encuentra registrado";
                            $validar = 2;
                            break;
                        }

                    }else{
                        $razon = "El formato del correo no es valido";
                        $validar = 2;
                        break;
                    }

                    
                }elseif ($key1=="tel") {
                    if (preg_match(EXPREG['number'],$value1)) {
                        $sentencia = "SELECT * FROM ".TABLAS['user']." WHERE tel='".$usuario['tel']."'";
                        $consulta = new Consultar();
                        $array = $consulta->getDates($sentencia);

                        if ($array) {
                            $razon = "El telefono ya se encuentra registrado";
                            $validar = 2;
                            break;
                        }

                    }else {
                        $razon = "El telefono debe ser numerico";
                        $validar = 2;
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

        $info = $buscar->getDates("SELECT MAX(idUsuario)+1 AS Ultimo FROM ".TABLAS['user']);

        if ($info) {
            foreach ($info as $llave) {
                $idUser = $info[0]['Ultimo'];
    
            }
        }else{
            $idUser = 0;
        }

        $usuario['idUsuario'] = $idUser;

        /*$info = $buscar->getDates("SELECT MAX(codUser)+1 AS Ultimo FROM ".TABLAS['user']);


        foreach ($info as $llave) {
            $codUs = $info[0]['Ultimo'];

        }*/

        //echo var_dump(array_values($info)); revisar estructura array

        $insertar = new Insertar(TABLAS['user']);

        #$insertar->add('codUser',$codUs);

        foreach ($usuario as $key => $value) {
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
