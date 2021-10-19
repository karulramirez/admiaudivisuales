<?php

require('config_bd.php');

class ConexionBD
{

    protected $conexion;

    public function __construct(){
        $this->conexion = new mysqli(HOST,USER,PASS,gh);

       /* if ($this->conexion->connect_errno) {
            echo "No se pudo conectar a la gh ".$this->conexion->connect_error;

            return;
        }else{
            echo "conexion establecida -- ";//.TABLAS['user'];
        }*/

        $this->conexion->set_charset(CHARSET_gh);
    }
    
}


//$prueba = new ConexionBD();

?>

