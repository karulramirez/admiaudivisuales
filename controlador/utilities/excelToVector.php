<?php 
    return function($ruta){
        $file = fopen($ruta, "r");
        $data = array();
        $keysVector = fgetcsv($file);
        if($keysVector[0] == 'sep=,')
            $keysVector = fgetcsv($file);
        while(! feof($file)) {
            $tmp = fgetcsv($file);
            $tmp2 = [];
            if($tmp){
                if (!is_null($tmp[0])) {
                    for ($i = 0; $i < count($keysVector); $i++){
                        $key = $keysVector[$i];
                        if ($key) $tmp2[$key] = $tmp[$i];
                    }
                    array_push($data, $tmp2);
                }
            }
        }
        fclose($file);
        return $data;
    }

?>