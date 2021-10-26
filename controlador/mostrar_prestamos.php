
<?php

$tablas = array("us"=>TABLAS['user'],
"pres"=>TABLAS['pres'],
"eq" => TABLAS['eq']);


$variable = new Consultar();
$sentencia= "SELECT * FROM ".$tablas['pres']." as pres INNER JOIN ".$tablas['us']." as us ON pres.usuario_idUsuario = us.idUsuario
INNER JOIN ".$tablas['eq']." as eq ON eq.sn = pres.equipos_sn";
$filas = $variable->getDates($sentencia) ;
//$consulta = $filas;
//$resultados=mysqli_fetch_assoc($sentencia);
/* var_dump($filas); */

if ($filas) {
    foreach($filas as $fila){


        $devol = "Sin devolver";
    
        if ($fila['fechaDevolucion']) {
            $devol = $fila['fechaDevolucion'];
        }
    
        echo "<tr>";
        echo "<td>"; echo $fila['cedula']; echo "</td>";
        echo "<td>"; echo $fila['nombre']; echo "</td>";
        echo "<td>"; echo $fila['apellido']; echo "</td>";
        echo "<td>"; echo $fila['facultad']; echo "</td>";
        echo "<td>"; echo $fila['tel']; echo "</td>";
        echo "<td>"; echo $fila['sn']; echo "</td>";
        echo "<td>"; echo $fila['ct']; echo "</td>";
        echo "<td>"; echo $fila['fechaHoraInicio']; echo "</td>";
        echo "<td>"; echo $fila['fechaHoraFinal']; echo "</td>";
        echo "<td>"; echo $devol; echo "</td>";
        if (!$fila['fechaDevolucion']) {
            echo "<td><form method='POST' action='Prestamo.php' id='demo-form2' data-parsley-validate class='form-horizontal form-label-left'>";
            echo "<input type='submit' value='Confirmar' name='confirmar' class='btn btn-success'>";
           // echo "<td><button type='submit' class='btn btn-success'>Confirmar</button></td>";
            echo "</form></td>";
        }else{
            echo "<td></td>";
        }
        echo "<tr>";
    }
}




/* while($filas=mysqli_fetch_assoc($resultados))
{
    echo "<tr>";//
    echo "<td>"; echo $filas['sn']; echo "</td>";
    echo "<td>"; echo $filas['ct']; echo "</td>";
    echo "<td>"; echo $filas['modelo']; echo "</td>";
    echo "<td>"; echo $filas['descripcion']; echo "</td>";
    echo "<tr>";
} */
?>
