<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

$fecha = formato_fecha($_POST["fecha"]);

$mes_0_I = date("01/m/Y",strtotime($fecha));
$mes_0_F = date("t/m/Y",strtotime($fecha));

$mes_1_I = date("01/m/Y",strtotime($fecha.' - 1 month'));
$mes_1_F = date("t/m/Y",strtotime($fecha.' - 1 month'));

$mes_2_I = date("01/m/Y",strtotime($fecha.' - 2 month'));
$mes_2_F = date("t/m/Y",strtotime($fecha.' - 2 month'));


$retorno = Array(
				"mes_0_I" => $mes_0_I,
				"mes_0_F" => $mes_0_F,
				"mes_1_I" => $mes_1_I,
				"mes_1_F" => $mes_1_F,
				"mes_2_I" => $mes_2_I,
				"mes_2_F" => $mes_2_F
				);
echo json_encode($retorno);

function formato_fecha($fecha) {
	list($d,$m,$a) = explode("/", $fecha);
	return $a."/".$m."/".$d;
}