<?php 
error_reporting(E_ALL);
ini_set('display_errors', '1');

$comercio = $_POST["comercio"];
$carpeta = 'documentos/'.$comercio;
if (!file_exists($carpeta)) {
    mkdir($carpeta, 755, true);
}
?>