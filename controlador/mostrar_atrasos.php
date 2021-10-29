<?php

$tablas = array("us"=>TABLAS['user'],
"pres"=>TABLAS['pres'],
"eq" => TABLAS['eq']);

$hoy = date("Y-m-d");


$variable = new Consultar();

if (preg_match(EXPREG['number'],$codBusqueda)) {
    $sentencia= "SELECT * FROM ".$tablas['pres']." as pres INNER JOIN ".$tablas['us']." as us ON pres.usuario_idUsuario = us.idUsuario
    INNER JOIN ".$tablas['eq']." as eq ON eq.sn = pres.equipos_sn WHERE pres.equipos_sn =".$codBusqueda."";
}else{
    $sentencia= "SELECT * FROM ".$tablas['pres']." as pres INNER JOIN ".$tablas['us']." as us ON pres.usuario_idUsuario = us.idUsuario
    INNER JOIN ".$tablas['eq']." as eq ON eq.sn = pres.equipos_sn";

}

$filas = $variable->getDates($sentencia);
//$consulta = $filas;
//$resultados=mysqli_fetch_assoc($sentencia);
/* var_dump($filas); */

if ($filas) {
    foreach($filas as $fila){


        if ($fila['fechaHoraFinal']<$hoy and !$fila['fechaDevolucion']) {
            echo "<tr>";
            echo "<td>"; echo $fila['cedula']; echo "</td>";
            echo "<td>"; echo $fila['nombre']; echo "</td>";
            echo "<td>"; echo $fila['apellido']; echo "</td>";
            echo "<td>"; echo $fila['sn']; echo "</td>";
            echo "<td>"; echo $fila['ct']; echo "</td>";
            echo "<td>"; echo $fila['fechaHoraFinal']; echo "</td>";
            echo "<td><form method='POST' action='Devolucion.php' id='demo-form2' data-parsley-validate class='form-horizontal form-label-left'>";
            echo "<input type='submit' value='Confirmar' name='confirmar' class='btn btn-success'>";
            echo "<input type='hidden' value='".$fila['idprestamo']."' name='devuelto'>";
            echo "</form></td>";
            echo "<tr>";
        }
    
        
    }
}

if (isset($_POST['confirmar'])) {
    $atraso="Si";
    include "../Controlador/terPrestamo.php";
    //header("Refresh:1");
}



?>
