<?php


if (count($_POST)==3) {

    $hoy = date("Y-m-d H:i:s");

    foreach ($_POST as $key => $value) {

        if ($key=="devuelto") {
            $actualizar = new Update(TABLAS['mant'],'idmantenimiento',$value);
            $actualizar->addVal('FechaReparacion',$hoy);
            $actualizar->ready();
            $elimina="No";
        }

        if ($key=="eliminar") {
            $actualizar = new Update(TABLAS['mant'],'idmantenimiento',$value);
            $actualizar->erase();
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


if ($elimina=="Si") {
    header( "refresh:1; MantenimientoEquipos.php" ); 
    die();
}elseif($elimina=="No"){
    header( "refresh:1; url=Registro_mantenimiento.php" ); 
    die();
}

?>