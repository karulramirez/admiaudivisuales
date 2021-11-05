<?php

$variable = new Consultar();
$sentencia= "SELECT * FROM usuario";
$filas = $variable->getDates($sentencia) ;
//$consulta = $filas;
//$resultados=mysqli_fetch_assoc($sentencia);
/* var_dump($filas); */
if ($filas) {
    foreach($filas as $fila){

        echo "<tr>";
        echo "<td>"; echo $fila['cedula']; echo "</td>";
        echo "<td>"; echo $fila['nombre']; echo "</td>";
        echo "<td>"; echo $fila['apellido']; echo "</td>";
        echo "<td>"; echo $fila['facultad']; echo "</td>";
        echo "<td>"; echo $fila['tel']; echo "</td>";
        echo "<td>"; echo $fila['correo']; echo "</td>";
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