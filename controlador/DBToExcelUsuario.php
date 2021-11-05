<?php

    if(isset($_POST['descargar'])){
        // conexión a la base de datos
        $dbHost = 'localhost:3306'; // host
        $dbUser = 'root'; // usuario
        $dbPass = ''; // contraseña de la bd
        $dbName = 'gh'; // nombre de la base de datos

        $dbTable = "usuario"; // tabla a modificar (importar)

        $mysqli = new mysqli($dbHost, $dbUser, $dbPass, $dbName);

        // Traer los elemenos de la base de datos
        $query = $mysqli->query("SELECT * FROM ".$dbTable); 
        if (!$query) {
            print_r($mysqli->error);
        }
        // traer los nombre de las columnas
        $queryColumns = $mysqli->query("SELECT Column_Name FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = '".$dbTable."' AND TABLE_SCHEMA = '".$dbName."';");
        if (!$queryColumns) {
            print_r($mysqli->error);
        }
        $columns = array();
        while($column = $queryColumns->fetch_row()) {
            array_push($columns, $column[0]);
        }

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
                for($i = 0; $i < count($columns)-1; $i++){
                    $column = $columns[$i];
                    
                    /*hacer un omitir clave*/
                   // if($column == 'clave'){
                   
                   // }
                   
                    if(isset($row[$column])) {
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
 
?>