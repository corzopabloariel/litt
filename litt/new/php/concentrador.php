<?php

session_start();
require_once './config.php';

header("Content-Type:application/json");


// esta pagina solo funciona si se manda una accion
if(!isset($_GET['accion'])){
    response(400,"No se envio accion",NULL);
    exit();
    }
// si envian una consulta sin el user declarado o siendo NULL, no pueden entrar
/*if(isset($_SESSION['user']) && $_GET['accion'] != "login"){
    if($_SESSION['user'] == NULL){
        response(401,"No tiene permiso para estar aca! logueese (null)",NULL);
        exit();
        }
    }elseif(!isset($_SESSION['user']) && $_GET['accion'] != "login"){
        response(401,"No tiene permiso para estar aca! logueese (no session)",
                ["session" => $_SESSION['user']]);
        exit();
    }*/

$accion = $_GET['accion'];
$p = $_POST;

switch($accion){
    case "login":               login($p); break;
    case "verazScoreMinimo":    getScoreMinimo($p); break;
    case "getUserData":         getUserData($p); break;
    case "existeCliente":       existeCliente($p); break;
    case "getClienteData":      getClienteData($p); break;
    case "getPlanes":           getPlanes($p); break;
    case "logout":              logout($p); break;
    case "crearComercio":       crearComercio($p); break;
    case "cambiarClave":        cambiarClave($p); break;
    case "guardarComercio":     guardarComercio($p); break;
    case "enviarMensaje":       enviarMensaje($p); break;
    case "habilitarProductos":  habilitarProductos($p); break;
    case "inhabilitarProducto": inhabilitarProducto($p); break;
    case "nuevoProducto":       nuevoProducto($p); break;
    case "nuevoConvenio":       nuevoConvenio($p); break;
    case "liquidarOperaciones": liquidarOperaciones($p); break;
    case "guardarCliente":      guardarCliente($p); break;
    case "getRendicionPendient":getRendicionPendient($p); break;
    case "setRendicionPendient":setRendicionPendient($p); break;
    case "nuevoGrupo":          nuevoGrupo($p); break;
    case "habilitar":           habilitar($p); break;
    case "inhabilitar":         inhabilitar($p); break;
    case "nuevoTipoMovimiento": nuevoTipoMovimiento($p); break;
    case "nuevaEntidad":        nuevaEntidad($p); break;
    case "nuevoPago":           nuevoPago($p); break;
    case "crearCliente":        crearCliente($p); break;
    case "crearCredito":        crearCredito($p); break;
    case "crearMail":           crearMail($p); break;
    case "traerMail":           traerMail($p); break;
    case "eliminarMail":        eliminarMail($p); break;
    case "traerMails":          traerMails($p); break;
    }