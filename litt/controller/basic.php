<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include_once($_SERVER['DOCUMENT_ROOT'] . '/litt/model/database.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/litt/controller/NumberToLetterConverter.php');
// include_once('../model/database.php');

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function redireccionar($url){
    header('Location: ' . $url);
}

function quitarInyeccion($arr){
    // dado un array, le quita todas las comillas
    global $mdb;
    $ret = array();
    foreach($arr as $k => $v)
        $ret[mysqli_real_escape_string($mdb,$k)] = mysqli_real_escape_string($mdb,$v);
    return $ret;
}

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function validarUser($permitidos){
    // en el header de cada pantalla se define quien puede estar
    // $permitidos define quienes pueden usar esta pantalla
    foreach($permitidos as $e){
        if($e == $_SESSION['lvl'])
            return true;
    }
    return false;
}


class config{
    public static $ui_main_comercio = "/litt/ui/comercio/menuPrincipCom.php";
    public static $ui_nuevo_credito = "/litt/ui/comercio/cliente/controlador/controller.php?nuevoCredito";
    public static $ui_listar_clientes = "/litt/ui/comercio/cliente/controlador/controller.php?listarClientes";
    public static $ui_confirmacion_nuevo_credito = "/litt/ui/comercio/cliente/vista/alta_2_resultadoCarga.php";
    public static $ui_login = "/litt/ui/loginLitt.php";
    public static $controller_login = "/litt/controller/login.php";
    public static $ui_cobrar_cuotas = "/litt/ui/comercio/cobrarCuotas.php";
    public static $ui_rendiciones = "/litt/ui/comercio/rendiciones.php";
    public static $ui_detalles = "/litt/ui/comercio/detalleAPagar.php";
    public static $ui_historial = "/litt/ui/comercio/historial.php";
}
class config_financiera{
    public static $ui_listar_clientes = "/litt/ui/financiera/cliente/controlador/controller.php?listarClientes";
    public static $ui_main_financiera = "/litt/ui/financiera/menuPalLitt.php";
}
