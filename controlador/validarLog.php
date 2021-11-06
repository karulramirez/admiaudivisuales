<?php

include "../DB/Functions_Mysql.php"; 

$login = array("usuario"=>"","password"=>"");

if (count($_POST)==3) {

    foreach ($_POST as $key1 => $value1) {


        foreach ($login as $key2 => $value2) {
            

            if ($key1==$key2) {
                $login[$key2] = $value1;

                
            }

        }

    }

    if ($login["usuario"]!="" and $login["password"]!="") {

        $consulta = "SELECT * FROM ".TABLAS['user']." WHERE nombre='".$login['usuario']."' AND clave='".$login['password']."'";

        $validar = new Consultar();

        $array = $validar->getDates($consulta);

        if ($array) {
            @session_start();

            foreach ($array as $fila) {
                $_SESSION["usuario"]["nombre"]=$fila['nombre'];
                $_SESSION["usuario"]["idUser"]=$fila['idUsuario'];
            }
            
            header("Location: ../Vista/Prestamo.php");
            die();
        }else{
            echo "Cuenta no valida";
        }

    }
    

}

?>