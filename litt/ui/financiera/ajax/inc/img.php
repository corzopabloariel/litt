<?php 
$path_base = $_SERVER['DOCUMENT_ROOT'] ."/litt/ui/comercio/uploads/";
$extension = ".jpg";
$archivos = ["solicitud","desarrollo","dni","servicio","sueldo","terminos"];
$elementos = [];
foreach($archivos as $k)
    $elementos[$k] = $path_base . $k . "_";

$id = $_POST["id"];
$flag = false;

if(file_exists($elementos["solicitud"] . $id . ".jpg") && file_exists($elementos["desarrollo"] . $id . ".jpg") && file_exists($elementos["dni"] . $id . ".jpg") && file_exists($elementos["servicio"] . $id . ".jpg") && file_exists($elementos["sueldo"] . $id . ".jpg") && file_exists($elementos["terminos"] . $id . ".jpg")) {
	$flag = true;
}

echo $flag;
?>