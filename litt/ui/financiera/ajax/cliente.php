<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/litt/controller/basic.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/litt/new/php/toolbox.php');
setlocale(LC_MONETARY, 'es_AR');
$tipo = $_POST["tipo"];

switch ($tipo) {
	case 'mes':
		include_once("inc/mes.php");
	break;
	case 'traer_mes':
		include_once("inc/traer_mes.php");
	break;
	case 'buscar':
		include_once("inc/buscar.php");
	break;
	case 'imagenes':
		include_once("inc/img.php");
	break;
}