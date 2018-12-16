<?php

function response($status,$status_message,$data){
    header("HTTP/1.1 ".$status);
    $response['status']=$status;
    $response['status_message']=$status_message;
    $response['data']=$data;
    $json_response = json_encode($response);
    echo $json_response;
}

function checkParamPost($arr){
    // checkea que todos los parametros enviados esten en post, si no, cancela
    // y envia un error
    foreach($arr as $e){
        if(!isset($_POST[$e])){
            response(400,"no se envio el parametro " . $e,NULL);
            exit();
        }
    }
}

/**
 * Obtiene una fila dado una tabla, una columna y su valor
 * @param type $tabla
 * @param type $columna
 * @param type $valor
 * @return type bean [array]
 */
function getValueBD($tabla,$columna,$valor){
    return R::findOne($tabla,$columna . " LIKE ?",array($valor));
}

function pmt($principal,$tasaDeInteres,$plazo){
    $tasaDeInteres = $tasaDeInteres / 100;
    return ($principal/( (1- pow(1+$tasaDeInteres,-$plazo)) / $tasaDeInteres));
}

function diffISO8601($primera,$segunda,$en = "dias"){
    // dadas dos fechas en iso8601, calculo la diferencia entre ambas
    // y la expreso como me digan en $en que puede ser dias o meses (por ahora)
    $a = new DateTime($primera);
    $b = new DateTime($segunda);
    $dif = $a->diff($b);
    if($en == "dias"){
        return $dif->format("%R%a");
    }elseif($en == "meses"){
        return $dif->format("%m");
    }
}