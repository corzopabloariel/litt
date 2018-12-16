<?php
//error_reporting(E_ALL);
//ini_set('display_errors', '1');
//session_start();
date_default_timezone_set('America/Argentina/Buenos_Aires');
require_once ('PHPExcel.php');
$primero = unserialize($_GET["primero"]);
$segundo = unserialize($_GET["segundo"]);
$tercero = unserialize($_GET["tercero"]);
$meses = unserialize($_GET["meses"]);

$inputFileName = 'informe_contable.xlsx';

$inputFileType = PHPExcel_IOFactory::identify($inputFileName);
$objReader = PHPExcel_IOFactory::createReader($inputFileType);
$objPHPExcel = $objReader->load($inputFileName);

$objPHPExcel->setActiveSheetIndex(0);

$Aletras = Array(0 => "C","D","E","F","G","H");
$i = 0;
foreach($meses AS $mes) {
	$objPHPExcel->getActiveSheet()
			->setCellValue($Aletras[$i].'2', $mes)
			;
	$i ++;
}


$i = 3;

foreach($primero AS $dato) {
	list($acumulado,$mes_3,$mes_2,$mes_1) = explode("/",$dato);
	$objPHPExcel->getActiveSheet()
			->setCellValue('B'.$i, intval($acumulado))
			->setCellValue('C'.$i, intval($mes_3))
			->setCellValue('D'.$i, intval($mes_2))
			->setCellValue('E'.$i, intval($mes_1))
			;
	$i ++;
}
$i++;
foreach($segundo AS $dato) {
	list($acumulado,$mes_3,$mes_2,$mes_1) = explode("/",$dato);
	$objPHPExcel->getActiveSheet()
			->setCellValue('B'.$i, ($acumulado))
			->setCellValue('C'.$i, ($mes_3))
			->setCellValue('D'.$i, ($mes_2))
			->setCellValue('E'.$i, ($mes_1))
			;
	$i ++;
}
$i++;
foreach($tercero AS $dato) {
	list($acumulado,$mes_3,$mes_2,$mes_1) = explode("/",$dato);
	$objPHPExcel->getActiveSheet()
			->setCellValue('B'.$i, intval($acumulado))
			->setCellValue('C'.$i, intval($mes_3))
			->setCellValue('D'.$i, intval($mes_2))
			->setCellValue('E'.$i, intval($mes_1))
			;
	$i ++;
}
/*
$objPHPExcel->getActiveSheet()
			->setCellValue('B'.$i, "Total")
			->setCellValue('C'.$i, intval($Atotales["casos"]))
			->setCellValue('D'.$i, number_format(100,2,",","."))
			->setCellValue('E'.$i, intval($Atotales["capital_original"]))
			->setCellValue('F'.$i, intval($Atotales["monto_pago"]))
			->setCellValue('G'.$i, intval($Atotales["monto_vencido"]))
			->setCellValue('H'.$i, intval($Atotales["monto_no_vencido"]))
			;



$objPHPExcel->getActiveSheet()
			->getStyle('B'.$i.":H".$i)
			->getFill()
			->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
			->getStartColor()
			->setRGB('e7e6e6');

$objPHPExcel->getActiveSheet()
			->getStyle('B'.$i.":H".$i)
			->applyFromArray(array('font' => array('size' => 12,'bold' => true)));*/

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Informe-Contable__'. date("d-m-y_H-i") . '.xlsx"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
?>