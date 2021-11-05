<?php

$idPres ="";

if (count($_POST)==3) {

    $hoy = date("Y-m-d H:i:s");

    foreach ($_POST as $key => $value) {

        if ($key=="devuelto") {
            $actualizar = new Update(TABLAS['pres'],'idprestamo',$value);
            $actualizar->addVal('fechaDevolucion',$hoy);
            $actualizar->ready();
        }

        if ($key=="equipo") {
            $actualizar = new Update(TABLAS['eq'],'sn',$value);
            $actualizar->addVal('disponible','Si');
            $actualizar->ready();
            break;
        }

    }

}else{
    echo "El numero de valores no corresponde ";
}


if ($atraso=="Si") {
    header( "refresh:1; mora.php" ); 
    die();
}elseif("No"){
    header( "refresh:1; url=Prestamo.php" ); 
    die();
}

?>