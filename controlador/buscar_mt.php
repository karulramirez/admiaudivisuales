<?php

$razon = "";


if (count($_POST)==2) {

    foreach ($_POST as $key => $value) {

        if ($key=="equipo") {
            $consulta = new Consultar();
            $instruccion = "SELECT * FROM ".TABLAS['eq']." WHERE serial='".$value."'";
            $array = $consulta->getDates($instruccion);
            
            if ($array) {

                foreach($array as $fila){

                    $consulta2 = new Consultar();
                    $instruccion2 = "SELECT * FROM ".TABLAS['mant']." WHERE equipos_sn=".$fila['sn']."";
                    $array2 = $consulta2->getDates($instruccion2);

                    if ($array2) {
                        $codBusqueda = $fila['sn'];
                        break;
                    }

                }

                if ($codBusqueda=="") {
                    $razon = "El equipo no ha estado en mantenimiento";
                }

                break;

            }else{
                $razon = "El equipo serial del equipo no existe";
            }

        }

    }

    echo $razon;

}else{
    echo "El numero de valores no corresponde ";
}

?>