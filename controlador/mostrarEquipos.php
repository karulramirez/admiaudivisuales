<?php

$variable = new Consultar();
$sentencia= "SELECT * FROM equipos";
$filas = $variable->getDates($sentencia) ;
//$consulta = $filas;
//$resultados=mysqli_fetch_assoc($sentencia);
/* var_dump($filas); */
foreach($filas as $fila){

    $obs = "Ninguna";

    if ($fila['observaciones']) {
        $obs = $fila['observaciones'];
    }

    echo "<tr>";
    echo "<td>"; echo $fila['sn']; echo "</td>";
    echo "<td>"; echo $fila['ct']; echo "</td>";
    echo "<td>"; echo $fila['modelo']; echo "</td>";
    echo "<td>"; echo $obs; echo "</td>";
    echo "<tr>";
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