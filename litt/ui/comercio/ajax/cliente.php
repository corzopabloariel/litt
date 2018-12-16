<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once '../../../model/database.php';
require("phpmailer/class.phpmailer.php");
$accion = $_POST["accion"];

switch($accion) {
	case "mail":
		include_once("inc/mail.php");
	break;
	case "mail-masivo":
		include_once("inc/mails.php");
	break;
	case "recibo":
		include_once("inc/recibo.php");
}
?>