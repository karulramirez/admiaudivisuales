<?php
    return function ($file) {
        $errors= array();
        $file_name = $file['name'];
        // $file_size = $_FILES['image']['size'];
        $file_tmp = $file['tmp_name'];
        $file_type = $file['type'];
        $tmp = explode('.', $file['name']);
        $file_ext= strtolower(end($tmp));
        // Extenciones
        $expensions= array("csv");
    
        if(in_array($file_ext,$expensions)=== false){
            $errors[]="Solo se permite extensiones csv.";
        }
    
        if(empty($errors)==true) {
            // Si quieres dejarlo permanente: 
            // move_uploaded_file($file_tmp,"../files/".$file_name);
            
            // retorna la ruta donde se encuentra
            return $file_tmp;
        }else{
            // print_r($errors);
            return null;
        }
    }
?>