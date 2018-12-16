<?php 
session_start();
date_default_timezone_set("America/Argentina/Buenos_Aires");

$nombre_archivo = "logs.txt"; 

if($archivo = fopen($nombre_archivo, "a")) {
    fwrite($archivo, date("d m Y H:m:s"). " :: ID USER: ".$_SESSION["id"]." (LOG) - ".php_uname() ."\n");
    fclose($archivo);
}
?>