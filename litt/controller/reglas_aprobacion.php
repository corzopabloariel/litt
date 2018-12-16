<?php

include_once('basic.php');
include_once('../model/database.php');

error_reporting(E_ALL);
ini_set('display_errors', 1);

function calculate_age($dob = ''){
    if(!empty($dob)){
    $date_array = explode('/',$dob);
    if(isset($date_array[0]) && isset($date_array[1]) && isset($date_array[2])){
    $h = 18;
    $i = 11;
    $s = 00;
    $d = $date_array[0];
    $m = $date_array[1];
    $y = $date_array[2];
    $dob = date("Y-m-d",mktime($h,$i,$s,$m,$d,$y));
    }else{
    $dob = date('Y-m-d',time());
    }
    }else{
    $dob = date('Y-m-d',time());
    }
    $datetime1 = new DateTime($dob);
    $datetime2 = new DateTime(date('Y-m-d',time()));
    $interval = $datetime2->diff($datetime1); #'%y years %m months and %d days'
    $age = $interval->format('%y');
    return $age;
}



if(isset($_POST['dni'])){
    $dni = $_POST['dni'];
    // me fijo si el dni cumple
    // PSEUDO REGLA DE APROBACION
    /*if($dni > 38000000){
        $url = config::$ui_confirmacion_nuevo_credito . "?estado=rechazado&mensaje=edad insuficiente";
        $url .= '&dni=' . $_POST["dni"] . '&nombre=' . $_POST["nombre"] . ' ' . $_POST["apellido"];
        redireccionar($url);
    }*/
    if(calculate_age($_POST['fecha_nacimiento']) < 18){
            $url = config::$ui_confirmacion_nuevo_credito . "?estado=rechazado&mensaje=edad insuficiente";
            $url .= '&dni=' . $_POST["dni"] . '&nombre=' . $_POST["nombre"] . ' ' . $_POST["apellido"];
            redireccionar($url);
    }
    elseif (empty($_POST['nombre']) || empty($_POST['apellido']) || empty($_POST['score'])) {
        $url = config::$ui_confirmacion_nuevo_credito . "?estado=rechazado&mensaje=algun campo importante vacio";
        $url .= '&dni=' . $_POST["dni"] . '&nombre=' . $_POST["nombre"] . ' ' . $_POST["apellido"];
        redireccionar($url);
    }
    elseif ($_POST['score'] <= 550) {
        $url = config::$ui_confirmacion_nuevo_credito . "?estado=rechazado&mensaje=score insuficiente";
        $url .= '&dni=' . $_POST["dni"] . '&nombre=' . $_POST["nombre"] . ' ' . $_POST["apellido"];
        redireccionar($url);
    }
    else {
        $q = "select * from clientes where dni = '" . filtro($dni) . "'";
        $ret = query_ret($q); 
        if($ret->num_rows > 0){
            $ret = $ret->fetch_assoc();
            // esta, lo traigo y se lo muestro
            if(($ret['credito_vigente'] < 3) & ($ret['atraso_historico'] < 90) & ($ret['estado_moral'] < 4)){
                redireccionar(config::$ui_confirmacion_nuevo_credito . 
                        '?estado=aceptado&mensaje=entro por que hay filas&dni=' . $ret["dni"] . '&nombre=' . $ret["nombre"] . ' ' . $ret["apellido"]);
            } else {
                $msg = "";
                if($ret['credito_vigente'] > 3)
                    $msg .= "<br>- Cliente con al menos 3 creditos vigentes";
                if($ret['atraso_historico'] >= 90)
                    $msg .= "<br>- Cliente con antecedentes de morosidad grave LITT";
                if($ret['situacion_actual'] == 'atraso')
                    $msg .= "<br>- Cliente con cuenta vigente con LITT";
                var_dump($ret);
                redireccionar(config::$ui_confirmacion_nuevo_credito . 
                        '?estado=rechazado&mensaje=' . $msg . '&dni=l' . $ret["dni"] . '&nombre=' . $ret["nombre"] . ' ' . $ret["apellido"]);
            }
        }
        else {
            $query = "INSERT INTO `litt`.`clientes` "
                    . "(`nombre`, `apellido`, `dni`,`fecha_nacimiento`, "
                    . "`credito_vigente`, `atraso_historico`, `estado_mora`) "
                    . "VALUES ('" . $_POST['nombre'] . "', "
                    . "'" . $_POST['apellido'] . "', "
                    . "'" . $_POST['dni'] . "', "
                    . "'" . $_POST['fecha_nacimiento'] . "', "
                    . "'1', "
                    . "1,"
                    . "2)";
            query_noret($query);
            redireccionar(config::$ui_confirmacion_nuevo_credito . 
                    '?estado=aceptado&mensaje=nuevo guardado&dni=' . $_POST["dni"] . '&nombre=' . $_POST["nombre"] . ' ' . $_POST["apellido"]);
        }
    }
}

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

