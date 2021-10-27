<?php


if (count($_POST)==2) {

    $hoy = date("Y-m-d H:i:s");

    foreach ($_POST as $key => $value) {

        if ($key=="devuelto") {
            $actualizar = new Update(TABLAS['pres'],'idprestamo',$value);
            $actualizar->addVal('fechaDevolucion',$hoy);
            $actualizar->ready();
            break;
        }

    }

}else{
    echo "El numero de valores no corresponde ";
}

?>