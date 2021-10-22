<?php

//importar la ruta PHPExcel
require "../PHPExcel\Classes\PHPExcel.php";
//require "../DB\conexion.php";

$archivos = 'equipo.xlsx';

//cargar la hoja de execel
$excel = PHPExcel_IOFactory::load($archivos);

//cargar la hoja de execel
$excel -> setActiveSheetIndex(0);

//cargar la hoja de calculo 
$numerofilas = $excel -> setActiveSheetIndex(0)->getHighestRow();

//echo $numerofilas;

for($i=2;$i <= $numerofilas;$i++){
     $SN = $excel -> getActiveSheet()->getCell('A'.$i)->getCalculatedVaule();
     echo $SN."-";
     if($SN==""){

     }else {
     /*$ct = $excel -> getActiveSheet()->getCell('B'.$i)->getCalculatedVaule();
     $modelo = $excel -> getActiveSheet()->getCell('C'.$i)->getCalculatedVaule();
     $descripcion = $excel -> getActiveSheet()->getCell('D'.$i)->getCalculatedVaule();
     $CONSULTA = "INSERT INTO equipo(sn,ct,modelo,descripcion) vaule ('SN','CT','modelo','descripcion')
     ";
     $resultados = mysqli->query($CONSULTA);
     ) */}
}


?>