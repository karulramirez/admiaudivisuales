<?php
    if(isset($_POST['descargar'])){
        // conexión a la base de datos
        $dbHost = 'localhost:3306'; // host
        $dbUser = 'root'; // usuario
        $dbPass = ''; // contraseña de la bd
        $dbName = 'gh'; // nombre de la base de datos

        $dbTable = "prestamo"; // tabla a modificar (importar)

        $mysqli = new mysqli($dbHost, $dbUser, $dbPass, $dbName);

        // Traer los elemenos de la base de datos
        $query = $mysqli->query("SELECT * FROM ".$dbTable." as pres INNER JOIN usuario as us ON pres.usuario_idUsuario = us.idUsuario INNER JOIN equipos as eq ON eq.sn = pres.equipos_sn");
        if (!$query) {
            print_r($mysqli->error);
        }

        $columns = Array('cedula', 'nombre', 'apellido', 'facultad', 'tel', 'serial', 'ct', 'fechaHoraInicio', 'fechaHoraFinal', 'fechaDevolucion');

        if($query){
            if($query->num_rows > 0){ 
                $delimiter = ","; 
                $filename = $dbTable."_" . date('Y-m-d') . ".csv"; 
                
                // Un archivo pointer
                $f = fopen('php://memory', 'w'); 

                // Colocar la cabecera del archivo excel.
                fputcsv($f, array("sep=".$delimiter)); 
                
                // Colocar la cabecera del archivo excel.
                fputcsv($f, $columns, $delimiter); 

                // Escribir fila tras fila y escribirlo en el archivo csv.
                while($row = $query->fetch_assoc()){ 
                    $data = array();
                    for($i = 0; $i < count($columns); $i++){
                        $column = $columns[$i];
                        if(isset($row[$column])) {
                            if($column == 'fechaHoraInicio' || $column == 'fechaDevolucion') {
                                $timestamp = strtotime($row[$column]);
                                $row[$column] = date('d/m/Y-h:i:s a', $timestamp);
                            } 
                            array_push($data, $row[$column]);
                        }
                    }
                    fputcsv($f, $data, $delimiter); 
                } 
                
                // Devolverse al comienzo del archivo
                fseek($f, 0); 
                
                // Colocar el tipo de archivo y el nombre del archivo en el header
                header('Content-Type: text/csv'); 
                header('Content-Disposition: attachment; filename="' . $filename . '";'); 
                
                // Regresar el archivo
                fpassthru($f); 
                exit;
            }
        }
    }
 
?>