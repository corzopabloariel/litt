<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

setlocale(LC_MONETARY, 'es_AR');

$desde = formato_fecha($_POST["desde"]);
$hasta = formato_fecha($_POST["hasta"]);
function fecha_o($f){
    $anio = substr($f,0,4);
    $mes = substr($f,4,2);
    $dia = substr($f,6,2);
    return $anio . "/". $mes . "/" . $dia;
}
// capital liquidado (RESTA)
$capital_liquidado = 0;
$x = R::findAll("credito_instancia","estado_liquidacion LIKE ?",[1]);
foreach($x as $e) {
	if($e["fecha_liquidacion"] >= $desde && $e["fecha_liquidacion"] <= $hasta) $capital_liquidado += $e["monto"];
}
// cuotas cobradas originales, punitorios
$cuotas_cobradas = 0;
$punitorios = 0;
$x = R::getAll( 'SELECT cuota_original,punitorios,vencimiento,fecha_depago FROM cuotas WHERE abonado = 1 AND vencimiento BETWEEN :desde AND :hasta', array(':desde'=>$desde,':hasta'=>$hasta) );
//$x = R::findAll("cuotas","abonado LIKE ?",[1]);
$dias_gracia = R::findOne("configuraciones","variable LIKE ?",Array("dias_gracia"))["valor"];
$config_punitorios = explode("_", R::findOne("configuraciones","variable LIKE ?",Array("punitorios"))["valor"]);
foreach($x as $e){
    $f_vencimiento = strtotime(fecha_o($e["vencimiento"]));
    $f_pago = strtotime(fecha_o($e["fecha_depago"]));

    $punitorio = 0;
    if(($f_vencimiento + ($dias_gracia*60*60*24)) < $f_pago) {
        foreach ($config_punitorios as $p)
            $punitorio += round($e["{$p}"]);
    }
	
	$cuotas_cobradas += $e["cuota_original"];
	$punitorios += $punitorio;
}

// sueldos (RESTA)
$sueldos = 0;
//$x = R::getAll( 'SELECT monto FROM registro_pago WHERE id_movimiento = 1 AND fecha_comprobante BETWEEN :desde AND :hasta', array(':desde'=>$desde,':hasta'=>$hasta) );
//$x = R::findAll("registro_pago","id_movimiento LIKE ?",[1]); // sueldos
$x = R::getAll('SELECT id FROM tipo_movimiento WHERE id_padre = 1');
$id_mov = "";
foreach($x as $e){
	if($id_mov != "")
		$id_mov .= ",";
    $id_mov .= $e["id"];
}
if(!empty($id_mov)) {
	$x = R::getAll( 'SELECT monto FROM `registro_pago` WHERE id_movimiento IN ('.$id_mov.') AND fecha_comprobante BETWEEN :desde AND :hasta', array(':desde'=>$desde,':hasta'=>$hasta) );
	foreach($x as $e){
		$sueldos += $e["monto"];
	}
}

// muebles (RESTA)
$muebles = 0;
//$x = R::getAll( 'SELECT monto FROM registro_pago WHERE id_movimiento = 5 AND fecha_comprobante BETWEEN :desde AND :hasta', array(':desde'=>$desde,':hasta'=>$hasta) );
$x = R::getAll('SELECT id FROM tipo_movimiento WHERE id_padre = 5');
$id_mov = "";
foreach($x as $e){
	if($id_mov != "")
		$id_mov .= ",";
    $id_mov .= $e["id"];
}
if(!empty($id_mov)) {
	$x = R::getAll( 'SELECT monto FROM `registro_pago` WHERE id_movimiento IN ('.$id_mov.') AND fecha_comprobante BETWEEN :desde AND :hasta', array(':desde'=>$desde,':hasta'=>$hasta) );
	foreach($x as $e){
		$muebles += $e["monto"];
	}
}

// publicidad (RESTA)
$publicidad = 0;
//$x = R::getAll( 'SELECT monto FROM registro_pago WHERE id_movimiento = 4 AND fecha_comprobante BETWEEN :desde AND :hasta', array(':desde'=>$desde,':hasta'=>$hasta) );
$x = R::getAll('SELECT id FROM tipo_movimiento WHERE id_padre = 3');
$id_mov = "";
foreach($x as $e){
	if($id_mov != "")
		$id_mov .= ",";
    $id_mov .= $e["id"];
}
if(!empty($id_mov)) {
	$x = R::getAll( 'SELECT monto FROM `registro_pago` WHERE id_movimiento IN ('.$id_mov.') AND fecha_comprobante BETWEEN :desde AND :hasta', array(':desde'=>$desde,':hasta'=>$hasta) );
	foreach($x as $e){
		$publicidad += $e["monto"];
	}
}

// varios (RESTA)
$varios = 0;
//$x = R::getAll( 'SELECT monto FROM registro_pago WHERE id_movimiento = 6 AND fecha_comprobante BETWEEN :desde AND :hasta', array(':desde'=>$desde,':hasta'=>$hasta) );
$x = R::getAll('SELECT id FROM tipo_movimiento WHERE id_padre = 4');
$id_mov = "";
foreach($x as $e){
	if($id_mov != "")
		$id_mov .= ",";
    $id_mov .= $e["id"];
}
if(!empty($id_mov)) {
	$x = R::getAll( 'SELECT monto FROM `registro_pago` WHERE id_movimiento IN ('.$id_mov.') AND fecha_comprobante BETWEEN :desde AND :hasta', array(':desde'=>$desde,':hasta'=>$hasta) );
	foreach($x as $e){
		$varios += $e["monto"];
	}
}

// cantidad de creeditos liquidados
$x = R::getRow( 'SELECT COUNT(*) AS cantidad FROM credito_instancia WHERE estado_liquidacion = 1 AND fecha_liquidacion BETWEEN :desde AND :hasta', array(':desde'=>$desde,':hasta'=>$hasta) );
$creditos_liquidados = $x["cantidad"];
$x = R::getRow( 'SELECT COUNT(*) AS cantidad FROM credito_instancia WHERE fecha_liquidacion BETWEEN :desde AND :hasta', array(':desde'=>$desde,':hasta'=>$hasta) );
$creditos = $x["cantidad"];

$x = R::getRow( 'SELECT COUNT(*) AS cantidad FROM comercios WHERE fecha_alta BETWEEN :desde AND :hasta', array(':desde'=>$desde,':hasta'=>$hasta) );
$comercios_adheridos = $x["cantidad"];

$colocacion = 0;
$capital_promedio = "?";

$x = R::getAll( 'SELECT * FROM cuotas WHERE estado_mora = 7 AND vencimiento BETWEEN :desde AND :hasta', array(':desde'=>$desde,':hasta'=>$hasta) );
$cantidad_mora = count($x);
$x = R::getAll( 'SELECT * FROM cuotas WHERE vencimiento BETWEEN :desde AND :hasta', array(':desde'=>$desde,':hasta'=>$hasta) );
$total_cuotas = R::count("cuotas");
$cantidad_mora = ($cantidad_mora / $total_cuotas) * 100;

$resultados = $cuotas_cobradas + $punitorios - $capital_liquidado - $sueldos - $muebles - $publicidad - $varios;
$retorno = Array(
					"capital_liquidado" => round($capital_liquidado),
					"cuotas_cobradas" => round($cuotas_cobradas),
					"punitorios" => round($punitorios),
					"sueldos" => round($sueldos),
					"muebles" => round($muebles),
					"publicidad" => round($publicidad),
					"varios" => round($varios),
					"resultados" => round($resultados),
					"creditos_liquidados" => $creditos_liquidados,
					"comercios_adheridos" => $comercios_adheridos,
					"cantidad_mora" => number_format ($cantidad_mora,2,",","."),
					"renta_comercio" => round(($comercios_adheridos == 0 ? 0 : $resultados / $comercios_adheridos)),
					"renta_credito" => round(($creditos == 0 ? 0 : $resultados / $creditos)),
					"colocacion" => round(($comercios_adheridos == 0 ? 0 : $creditos_liquidados / $comercios_adheridos)),
					"capital_promedio" => round(($creditos_liquidados == 0 ? 0 : $capital_liquidado / $creditos_liquidados))
				);
echo json_encode($retorno);

function formato_fecha($fecha) {
	list($d,$m,$a) = explode("/", $fecha);
	return $a.$m.$d;
}
?>