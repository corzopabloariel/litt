<?php
//error_reporting(E_ALL);
//ini_set('display_errors', '1');
//session_start();
date_default_timezone_set('America/Argentina/Buenos_Aires');
require_once ('PHPExcel.php');
$datos = unserialize($_GET["datos"]);

$inputFileName = 'informe_mora.xlsx';

$inputFileType = PHPExcel_IOFactory::identify($inputFileName);
$objReader = PHPExcel_IOFactory::createReader($inputFileType);
$objPHPExcel = $objReader->load($inputFileName);

$objPHPExcel->setActiveSheetIndex(0);

$i = 3;
$Atotales = array();
$Atotales["casos"] = 0;
$Atotales["porcentaje"] = 0;
$Atotales["capital_original"] = 0;
$Atotales["monto_pago"] = 0;
$Atotales["monto_vencido"] = 0;
$Atotales["monto_no_vencido"] = 0;

foreach($datos AS $dato) {
	list($modulo,$casos,$porcentaje,$capital_original,$monto_pago,$monto_vencido,$monto_no_vencido) = explode("/",$dato);
	$Atotales["casos"] += intval($casos);
	$Atotales["capital_original"] += intval($capital_original);
	$Atotales["monto_pago"] += intval($monto_pago);
	$Atotales["monto_vencido"] += intval($monto_vencido);
	$Atotales["monto_no_vencido"] += intval($monto_no_vencido);
	$total += (floatval($interes)+floatval($capital)+floatval($compensatorios)+floatval($punitorios)+floatval($multa));
	$objPHPExcel->getActiveSheet()
			->setCellValue('A'.$i, $modulo)
			->setCellValue('B'.$i, intval($casos))
			->setCellValue('C'.$i, $porcentaje)
			->setCellValue('D'.$i, intval($capital_original))
			->setCellValue('E'.$i, intval($monto_pago))
			->setCellValue('F'.$i, intval($monto_vencido))
			->setCellValue('G'.$i, intval($monto_no_vencido))
			;
	$i ++;
}

$objPHPExcel->getActiveSheet()
			->setCellValue('A'.$i, "Total")
			->setCellValue('B'.$i, intval($Atotales["casos"]))
			->setCellValue('C'.$i, number_format(100,2,",","."))
			->setCellValue('D'.$i, intval($Atotales["capital_original"]))
			->setCellValue('E'.$i, intval($Atotales["monto_pago"]))
			->setCellValue('F'.$i, intval($Atotales["monto_vencido"]))
			->setCellValue('G'.$i, intval($Atotales["monto_no_vencido"]))
			;



$objPHPExcel->getActiveSheet()
			->getStyle('A'.$i.":G".$i)
			->getFill()
			->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
			->getStartColor()
			->setRGB('e7e6e6');
$objPHPExcel->getActiveSheet()
			->getStyle('A'.$i.":G".$i)
			->applyFromArray(array('font' => array('size' => 12,'bold' => true)));

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Informe-de-Mora__'. date("d-m-y_H-i") . '.xlsx"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
?>