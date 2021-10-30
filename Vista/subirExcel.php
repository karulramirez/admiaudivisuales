<?php

$directorio = './';
$subir_archivo = $directorio.basename($_FILES['subir_archivo']['name']);

if (move_uploaded_file($_FILES['subir_archivo']['tmp_name'], $subir_archivo)) {
      echo "El archivo es válido y se cargó correctamente.<br><br>";
	   echo"<a href='".$subir_archivo."' target='_blank'></a>";
    } else {
       echo "La subida ha fallado";
    }
    
    $dbhost = 'localhost:3306';
    $dbname = 'gh';
    $dbchar = 'utf8';
    $dbuser = 'root';
    $dbpass = '';
    $pdo = new PDO(
      "mysql:host=$dbhost;charset=$dbchar;dbname=$dbname",
      $dbuser, $dbpass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
      ]
    );
    
    // (B) PHPSPREADSHEET TO LOAD EXCEL FILE
    require "../vendor/autoload.php";
    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
    $spreadsheet = $reader->load($subir_archivo);
    $worksheet = $spreadsheet->getActiveSheet();
    
    // (C) READ DATA + IMPORT
    $sql = "INSERT INTO `equipos` (`sn`, `ct`, `modelo`, `observaciones`, `disponible` ) VALUES (?, ?, ?, ?, ?)";
    foreach ($worksheet->getRowIterator() as $row) {
      // (C1) FETCH DATA FROM WORKSHEET
      $cellIterator = $row->getCellIterator();
      $cellIterator->setIterateOnlyExistingCells(false);
      $data = [];
      foreach ($cellIterator as $cell) { $data[] = $cell->getValue(); }
    
      // (C2) INSERT INTO DATABASE
      print_r($data);
      try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute($data);
        echo "OK <br>";
      } catch (Exception $ex) { echo $ex->getMessage() . "<br>"; }
      $stmt = null;
    }
    
    // (D) CLOSE DATABASE CONNECTION
    if ($stmt !== null) { $stmt = null; }
    if ($pdo !== null) { $pdo = null; }
    