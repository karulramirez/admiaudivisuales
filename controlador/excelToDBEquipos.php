<?php 

    // si existe el archivo
    if(isset($_FILES['csvFile'])){
        $uploadFile = require("utilities/uploadFile.php");
        $excelToVector = require("utilities/excelToVector.php");

        $file = $_FILES['csvFile'];
        $dbTable = "equipos"; // nombre de la tabla a descargar

        // sube el archivo y retorna la ruta temporal
        $ruta = $uploadFile($file);
        if($ruta) {
            // convierte el archivo excel temporal a un vector.
            $vector = $excelToVector($ruta);
            if($vector) {
                // conexión a la base de datos
                $dbHost = 'localhost:3306'; // host
                $dbUser = 'root'; // usuario
                $dbPass = ''; // contraseña de la bd
                $dbName = 'gh'; // nombre de la base de datos

                $mysqli = new mysqli($dbHost, $dbUser, $dbPass, $dbName);
                if ($mysqli->connect_errno) {
                    echo "Falló la conexión a MySQL: (" . $mysqli->connect_errno . ") <\br>" . $mysqli->connect_error;
                }

                $errors = array();

                for ($i = 0; $i < count($vector); $i++) {
                    $sql = "INSERT INTO `".$dbTable."` SET ";
                    $keyVector = array_keys($vector[$i]); 
                    $numMaxKey = count($keyVector);
                    
                    for ($j = 0; $j < $numMaxKey; $j++){
                        $key = $keyVector[$j];
                        $sql .= "`".$key."` = \"".$vector[$i][$key]."\"";
                        // si es el ultimo entonces no coloca la coma
                        if($j != $numMaxKey - 1){
                            $sql .= ", ";
                        }
                    }
                    if (!$mysqli->query($sql)) {
                        $temp = [$i, $mysqli->error];
                        array_push($errors, $temp);
                    }
                }

                // imprimir errores de mysql: 
               /* for ($i = 0; $i < count($errors); $i++){
                    print("mysql error: [".$errors[$i][0]."] ". $errors[$i][1]);
                    echo '<br>';
                }
                if(count($errors) == 0) {
                    print_r("No se ha encontraro errores y se ha subido a la BD.");
                } */

            } else print_r("No se pudo abrir archivo. <br>");
        } else print_r("No se ha podido subir el archivo. <br>");
    }
?>