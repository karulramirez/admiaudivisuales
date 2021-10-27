<?php

$razon = "";


if (count($_POST)==2) {

    foreach ($_POST as $key => $value) {

        if ($key=="equipo") {

            if (preg_match(EXPREG['number'],$value)) {
                $consulta = new Consultar();
                $instruccion = "SELECT * FROM ".TABLAS['pres']." WHERE equipos_sn=".$value."";
                $array = $consulta->getDates($instruccion);

                if ($array) {
                    $codBusqueda = $value;
                    break;
                }else{
                    $razon = "El equipo no ha sido prestado en ninguna ocasion";
                }

            }else{
                $razon = "El serial del equipo debe ser numerico";
            }
        }

    }

    echo $razon;

}else{
    echo "El numero de valores no corresponde ";
}

?>