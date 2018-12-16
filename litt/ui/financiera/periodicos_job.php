<?php
date_default_timezone_set("America/Argentina/Buenos_Aires");
/* TAREAS QUE SE EJECUTAN PERIODICAMENTE 
 */

require_once($_SERVER['DOCUMENT_ROOT'] . '/litt/controller/basic.php');

function actualizarEstadoMoraDeComercio(){
    // se fija si esta activo el comercio
    $com = R::findAll("comercios");
    foreach($com as $c){
        $ci = R::findOne("credito_instancia","id_comercio LIKE ? ORDER BY fecha_liquidacion DESC",[$c["id"]]);
        if($ci["fecha_liquidacion"] != NULL && $ci["fecha_liquidacion"] != 0){
            
            $t = strtotime($ci["fecha_liquidacion"]); // ultima liquidacion
            $n = time(); // hoy
            $dif = round(($n - $t) / (60*60*24)); // dias diferencia
            // echo $dif;
            
            if($dif >= 180) $c["estado"] = 0; // no activa
            elseif($dif >= 90) $c["estado"] = 3; // no activ hoy
            elseif($dif >= 30) $c["estado"] = 2; // semiactiva
            else $c["estado"] = 1; // activa
            
            R::store($c);
        }
    }
}

function actualizarEstadoCliente() {
    $cli = R::getAll("SELECT dni_cliente,MAX(estado_mora) AS estado FROM `credito_instancia` GROUP BY dni_cliente");

    foreach ($cli as $c) {
        $cliente = R::findOne("clientes","dni LIKE ?",Array($c["dni_cliente"]));
        $cliente["estado_mora"] = $c["estado"];
        R::store($cliente);
    }
}///buscar el estado de credito del cliente y cambiar el "estado" del cliente en la columna estado_mora ("cliente")

function actualizarEstadoMoraCuota(){
    /* basado en el vencimiento de la peor (mas vieja) cuota no abonada
    id 2) normal			atraso < 1
    id 3) premora		1 < atraso < 31
    id 4) mora			32 < atraso < 61
    id 5) extrajudicial         62 < atraso < 90
    id 7) incobrable            90 < atraso */
    // traigo todos los comercios
    $cuo = R::findAll("cuotas","abonado LIKE ?",[0]);
    foreach($cuo as $c){
        // reviso cada vencimiento y en base a eso determino el estado
        $t = strtotime($c["vencimiento"]); // vencimiento mas viejo no abonado
        //$t = substr($t, 0,8);
        $n = time(); // hoy

        //$n = date("Ymd");
        $dif = round(($n - $t) / (60*60*24)); // dias diferencia 
        //$dif = $n - $t; // dias diferencia 20180314 -20180313

        // COMPENSATORIOS = cuota * (Tna/365) * días de atraso
        if($dif > 0) {
            $c["compensatorios"] = round($c["cuota_original"] * (($c["tna"] / 100) / 365) * $dif,2);
            $c["punitorios"] = round($c["compensatorios"] * .5,2);
        }
        /*
        Multa día 45= creo que era el 6% de la cuota
        Multa día 90= creo que era el 9% de la cuota
        Multa día 180= creo que era el 12% de la cuota
        */
        $multa = 0;
        if($dif >= 45 && $dif < 90) $multa = .06;
        elseif($dif >= 90 && $dif < 180) $multa = .09;
        elseif($dif >= 180) $multa = .12;

        $c["multa"] = $c["cuota_original"] * $multa;

        if($dif > 90) { $c["estado_mora"] = 7; $c["estado"] = 1; } // incobrable
        elseif($dif > 62) { $c["estado_mora"] = 5; $c["estado"] = 1; } // extrajudicial
        elseif($dif > 31) { $c["estado_mora"] = 4; $c["estado"] = 1; } // mora
        elseif($dif > 1) { $c["estado_mora"] = 3; $c["estado"] = 1; } // premora
        elseif($dif <= 1) { $c["estado_mora"] = 2; $c["estado"] = 0; } // normal
        R::store($c);
    }
}

function actualizarEstadoMoraCredito(){
    $cred = R::findAll("credito_instancia");
    foreach($cred as $c){
        $cuo = R::findOne("cuotas","id_credito LIKE ? ORDER BY estado_mora DESC",[$c["id"]]);
        // seteo el estado de la peor cuota a cada credito
        $c["estado_mora"] = $cuo["estado_mora"];
        R::store($c);
    }
}

function actualizarCategoriaComercio(){
    /* basado en el vencimiento de la peor (mas vieja) cuota no abonada
     1 Excelente < 2% incobrable
     2 Buena < 6% incobrable
     3 Normal < 10% incobrable
     4 Mala < 14% incobrable
     5 Muy Mala < 17% incobrable
     6 Alerta Fraude >= 17% */
    $com = R::findAll("comercios");
    foreach($com as $c){
        // traigo de cada comercio sus creditos
        $cred = R::findAll("credito_instancia","id_comercio LIKE ?",[$c["id"]]);
        // el numero de creditos totales
        $total_cred = R::count("credito_instancia","id_comercio LIKE ?",[$c["id"]]);
        // y sobre cada uno de sus creditos sacar si tiene una cuota en incobrable
        $incobrable = 0;
        foreach($cred as $cr){
            // obtengo el que tenga estado de mora incobrable
            $cuo = R::findOne("cuotas","id_credito LIKE ? AND estado_mora LIKE ?",[$cr["id"],7]);
            if($cuo) $incobrable += 1; // le sumo un incobrable
        }
        // saco sobre el porcentaje total de los creditos dados cuantos son incobrables
        if($incobrable != 0 || $total_cred != 0){
            $porcentaje_incobrable = ($incobrable / $total_cred) * 100;
            if($porcentaje_incobrable < 2) $c["id_categoria"] = 1; // Excelente
            elseif($porcentaje_incobrable < 6) $c["id_categoria"] = 2; // Buena
            elseif($porcentaje_incobrable < 10) $c["id_categoria"] = 3; // Normal
            elseif($porcentaje_incobrable < 14) $c["id_categoria"] = 4; // Mala
            elseif($porcentaje_incobrable < 17) $c["id_categoria"] = 5; // Muy Mala
            elseif($porcentaje_incobrable >= 17) $c["id_categoria"] = 6; // Alerta Fraude
        } else { $c["id_categoria"] = 1; }
        R::store($c);
    }
}

// llamados a las funciones de cron

actualizarEstadoMoraCuota();
actualizarEstadoMoraCredito();
actualizarEstadoCliente();
actualizarEstadoMoraDeComercio();
actualizarCategoriaComercio();

$nombre_archivo = "cron.txt"; 
if($archivo = fopen($nombre_archivo, "a")) {
    fwrite($archivo, date("d m Y H:m:s") ."\n");
    fclose($archivo);
}