<?php
//error_reporting(E_ALL);
//ini_set('display_errors', '1');
//session_start();
date_default_timezone_set('America/Argentina/Buenos_Aires');
require_once ('PHPExcel.php');
$datos = unserialize($_GET["datos"]);

$inputFileName = 'informe_comercio.xlsx';

$inputFileType = PHPExcel_IOFactory::identify($inputFileName);
$objReader = PHPExcel_IOFactory::createReader($inputFileType);
$objPHPExcel = $objReader->load($inputFileName);

$objPHPExcel->setActiveSheetIndex(0);
$Atotales = array();
$Atotales["cantidad_comercios"] = 0;
$Atotales["credito"] = 0;
$Atotales["monto_invertido"] = 0;
$Atotales["monto_cobrados"] = 0;
$Atotales["monto_adeudados"] = 0;
$Atotales["monto_a_cobrar"] = 0;

$i = 3;
foreach($datos AS $dato) {
	list($categoria,$cantidad_comercios,$credito,$monto_invertido,$monto_cobrados,$monto_adeudados,$monto_a_cobrar) = explode("/",$dato);
	$Atotales["cantidad_comercios"] += intval($cantidad_comercios);
	$Atotales["credito"] += intval($credito);
	$Atotales["monto_invertido"] += intval($monto_invertido);
	$Atotales["monto_cobrados"] += intval($monto_cobrados);
	$Atotales["monto_adeudados"] += intval($monto_adeudados);
	$Atotales["monto_a_cobrar"] += intval($monto_a_cobrar);
	$objPHPExcel->getActiveSheet()
			->setCellValue('A'.$i, $categoria)
			->setCellValue('B'.$i, intval($cantidad_comercios))
			->setCellValue('C'.$i, intval($credito))
			->setCellValue('D'.$i, intval($monto_invertido))
			->setCellValue('E'.$i, intval($monto_cobrados))
			->setCellValue('F'.$i, intval($monto_adeudados))
			->setCellValue('G'.$i, intval($monto_a_cobrar))
			;
	$i ++;
}


$objPHPExcel->getActiveSheet()
			->setCellValue('A'.$i, "Totales")
			->setCellValue('B'.$i, intval($Atotales["cantidad_comercios"]))
			->setCellValue('C'.$i, intval($Atotales["credito"]))
			->setCellValue('D'.$i, intval($Atotales["monto_invertido"]))
			->setCellValue('E'.$i, intval($Atotales["monto_cobrados"]))
			->setCellValue('F'.$i, intval($Atotales["monto_adeudados"]))
			->setCellValue('G'.$i, intval($Atotales["monto_a_cobrar"]))
			;

$objPHPExcel->getActiveSheet()
			->getStyle('A'.$i.":G".$i)
			->applyFromArray(array('font' => array('size' => 12,'bold' => true)));

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Informe-Comercio__'. date("d-m-y_H-i") . '.xlsx"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
?>