<?php

// MOSTRAR TODOS LOS ERRORES
error_reporting(E_ALL);
ini_set('display_errors', 1);

// BASE DE DATOS
require_once './rb.php';
require_once './toolbox.php';
require_once './query.php';
$db_host = "localhost";
$db_name = "litt";
$db_user = "root";
$db_pass = "kronos";
R::setup('mysql:host=' . $db_host .';dbname=' . $db_name, $db_user, $db_pass);

// agrego funcionalidad para guiones bajo en nombre de bd
R::ext('xdispense', function( $type ){ 
        return R::getRedBean()->dispense( $type ); 
    });

// SESION
if (session_status() == PHP_SESSION_NONE) {
    session_start();
    // arranco el usuario como nulo
    $_SESSION['user'] = NULL; 
}
