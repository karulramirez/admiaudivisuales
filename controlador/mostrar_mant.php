<?php

$tablas = array("mant"=>TABLAS['mant'],
"eq" => TABLAS['eq']);

$hoy = date("Y-m-d");

if ($elimina=="Si") {
    $boton="<input type='submit' value='Cancelar' name='confirmar' class='btn btn-danger'>";
    $mens = "eliminar";
}else{
    $boton="<input type='submit' value='Confirmar' name='confirmar' class='btn btn-success'>";
    $mens = "devuelto";
}


$variable = new Consultar();

if (preg_match(EXPREG['number'],$codBusqueda)) {
    $sentencia= "SELECT * FROM ".$tablas['mant']." as mant 
    INNER JOIN ".$tablas['eq']." as eq ON eq.sn = mant.equipos_sn WHERE mant.equipos_sn =".$codBusqueda."";
}else{
    $sentencia= "SELECT * FROM ".$tablas['mant']." as mant 
    INNER JOIN ".$tablas['eq']." as eq ON eq.sn = mant.equipos_sn";

}

$filas = $variable->getDates($sentencia);
//$consulta = $filas;
//$resultados=mysqli_fetch_assoc($sentencia);
/* var_dump($filas); */

if ($filas) {
    foreach($filas as $fila){


        /*$devol = "Sin devolver";
    
        if ($fila['fechaDevolucion']) {
            $devol = $fila['fechaDevolucion'];
        }*/


            echo "<tr>";
            echo "<td>"; echo $fila['serial']; echo "</td>";
            echo "<td>"; echo $fila['ct']; echo "</td>";
            echo "<td>"; echo $fila['modelo']; echo "</td>";
            echo "<td>"; echo $fila['FechaInicioMant']; echo "</td>";
            if (!$fila['FechaReparacion']) {
                echo "<td><form method='POST' action='MantenimientoEquipos.php' id='demo-form2' data-parsley-validate class='form-horizontal form-label-left'>";
                echo $boton;
                echo "<input type='hidden' value='".$fila['idmantenimiento']."' name='".$mens."'>";
                echo "<input type='hidden' value='".$fila['sn']."' name='equipo'>";
                echo "</form></td>";
            }else{
                echo "<td>Reparado</td>";
            }
            echo "<tr>";
    
        
    }
}

if (isset($_POST['confirmar'])) {
    include "../Controlador/terMant.php";
    //header("Refresh:1");
}



?>