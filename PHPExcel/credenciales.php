<?php

//importar la ruta PHPExcel
require "../PHPExcel\Classes\PHPExcel.php";
//require "../DB\conexion.php";

$archivos = 'lista.xlsx';

//cargar la hoja de execel
$excel = PHPExcel_IOFactory::load($archivos);

//cargar la hoja de execel
$excel -> setActiveSheetIndex(0);

//cargar la hoja de calculo 
$numerofilas = $excel -> setActiveSheetIndex(0)->getHighestRow();

//echo $numerofilas;

for($i=2;$i <= $numerofilas;$i++){
     $cedula = $excel -> getActiveSheet()->getCell('A'.$i)->getCalculatedVaule();
     echo $cedula."-";

     /*$nombre = $excel -> getActiveSheet()->getCell('B'.$i)->getCalculatedVaule();
     $apellido = $excel -> getActiveSheet()->getCell('C'.$i)->getCalculatedVaule();
     $facultd = $excel -> getActiveSheet()->getCell('D'.$i)->getCalculatedVaule();
     $tel = $excel -> getActiveSheet()->getCell('E'.$i)->getCalculatedVaule();
     $corrreo = $excel -> getActiveSheet()->getCell('F'.$i)->getCalculatedVaule();
     $corrreo = $excel -> getActiveSheet()->getCell('D'.$i)->getCalculatedVaule();
     $$rol = $excel -> getActiveSheet()->getCell('G'.$i)->getCalculatedVaule();
     
) */

}


?>