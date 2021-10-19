<?php

define('HOST','localhost');
define('USER','root');
define('PASS','');
define('gh','gh');
define('CHARSET_gh','utf8');


define('TABLAS',array(
"admin" => "administrador",
"devolucion" => "devolucion"
)); 

define('EXPREG',array(
    "email" => "/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/",
    "number" => "/^[0-9]+$/",
    "letras"=>"/^[a-zA-ZÀ-ÖØ-öø-ÿ]+(\s?[a-zA-ZÀ-ÖØ-öø-ÿ]+)*$/",
    "alfanumSE"=>"/^([^\s*.]+)+$/"));

?>

<!--!>