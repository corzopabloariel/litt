<?php 

if(isset($_POST["user"])) {
	$dato = $_POST["user"];
	$x = R::find("user","user LIKE ?",array($dato));
	echo (count($x) > 0 ? false : true);
}
if(isset($_POST["nombre"])) {
	$dato = $_POST["nombre"];
	$x = R::find("comercios","nombre LIKE ?",array($dato));
	echo (count($x) > 0 ? false : true);
}
if(isset($_POST["razon_social"])) {
	$dato = $_POST["razon_social"];
	$x = R::find("comercios","razon_social LIKE ?",array($dato));
	echo (count($x) > 0 ? false : true);
}
if(isset($_POST["cuit"])) {
	$dato = $_POST["cuit"];
	$x = R::find("comercios","cuit LIKE ?",array($dato));
	echo (count($x) > 0 ? false : true);
}
if(isset($_POST["mail"])) {
	$dato = $_POST["mail"];
	$x = R::find("comercios","mail LIKE ?",array($dato));
	echo (count($x) > 0 ? false : true);
}
?>