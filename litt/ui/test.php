<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);


$dif = round((20180201 - 20180101) / (60*60*24*30)); // dias diferencia 
var_dump($dif);

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

echo diffISO8601("20180101", "20180310", "meses");
/*
header('Content-type: application/excel');
$filename = 'filename.xls';
header('Content-Disposition: attachment; filename='.$filename);

$data = '<html xmlns:x="urn:schemas-microsoft-com:office:excel">
<head>
    <!--[if gte mso 9]>
    <xml>
        <x:ExcelWorkbook>
            <x:ExcelWorksheets>
                <x:ExcelWorksheet>
                    <x:Name>Sheet 1</x:Name>
                    <x:WorksheetOptions>
                        <x:Print>
                            <x:ValidPrinterInfo/>
                        </x:Print>
                    </x:WorksheetOptions>
                </x:ExcelWorksheet>
            </x:ExcelWorksheets>
        </x:ExcelWorkbook>
    </xml>
    <![endif]-->
</head>

<body>
   <table><tr><td>Cell 1</td><td>Cell 2</td></tr></table>
</body></html>';

echo $data; */

/*
header ( "Content-type: application/vnd.ms-excel" );
header ( "Content-Disposition: attachment; filename=foo_bar.xls" );

header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=abc.xls");  //File name extension was wrong
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private",false);

echo "<table><tr><th>Header1</th></tr><tr><td>value1</td></tr></table>"; */
/*require_once '../model/database.php';


//echo date('YmdHi') . " - " . date('H:i');
$c = R::find("EstaTablaNoExiste");
var_dump(R::dump($c));
*/
/*$creditos = R::findALl("credito_instancia","liquidado_litt LIKE ? and rendida LIKE ? and fecha_liquidacion <= ?",[1,0,"20180208"]);
foreach($creditos as $c){
    echo $c["producto_designacion"] . "<br>";
}*/

/*$c = R::findAll("cuotas");
foreach($c as $e){
    $d = $e["fecha_depago"];
    // 01/01/2017
    // 0123456789
    $nd = substr($d,6,4) . substr($d,3,2) . substr($d,0,2);
    echo $nd . "<br>";
    $e["fecha_depago"] = $nd;
    R::store($e);
}*/

/*
 * CREACION DE ID_COMERCIO EN LAS CUOTAS
$r = R::findAll("credito_instancia");
foreach($r as $e){
    $id = $e["id"];
    $c = R::findAll("cuotas","id_credito LIKE ?",[$id]);
    foreach($c as $cc){
        $cc["id_comercio"] = $e["id_comercio"];
        R::store($cc);
    }
}*/

/* ELIMINACION DE CUOTAS HUERFANAS
$c = R::findAll("cuotas");
foreach($c as $e){
    $i = R::findOne("credito_instancia","id LIKE ?",[$e["id_credito"]]);
    if(!$i){
        echo "cuota con id " . $i["id"] . " eliminada";
        R::trash($e);
    }
}*/

/* include_once($_SERVER['DOCUMENT_ROOT'] . '/litt/controller/basic.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/litt/model/database.php');
phpinfo(); */ 
// echo date("d/m/Y");  

/*echo cambios;
function pmt($apr, $term, $loan) {
  $term = $term * 12;
  $apr = $apr / 1200;
  $amount = $apr * -$loan * pow((1 + $apr), $term) / (1 - pow((1 + $apr), $term));
  return number_format($amount, 2);
}


function pmt_($interest, $months, $loan) {
       $months = $months;
       $interest = $interest / 1200;
       $amount = $interest * -$loan * pow((1 + $interest), $months) / (1 - pow((1 + $interest), $months));
       return number_format($amount, 2);
    }
echo PMT(10.60,3,1300);
*/
/*
$ret = R::findOne("credito_instancia","dni_cliente LIKE ? ORDER BY id DESC LIMIT 0,1",array("34983117"));
// divido el precio por la cantidad de cuotas
$valor_cuota = 10 / 6;
// var_dump($ret);
$i = 0;
$c = R::dispense('cuotas');
$c->id_credito = $ret['id'];
$c->n_cuota = $i + 1;
$c->cuota_original = $valor_cuota;
$c->punitorios = 1;
$t = date("d/m/Y", strtotime("+" . ($i + 1) . " month"));
$c->vencimiento = $t;
$c->estado = '0';
$c->dni_cliente = "34983117";
echo "por lo menos llego aca";
R::store($c);*/

/*$a = R::dispense("user");
$a->user = "usuario";
$a->pass = "hashmd5";
$a->level = 0;
R::store($a);*/

/*$ret = R::findOne("credito_instancia","dni_cliente LIKE ? ORDER BY id DESC LIMIT 0,1",array("34983117"));
// traigo la columna de los id
echo json_encode($ret);

/*$t = date("d/m/Y", strtotime("+2 month"));
var_dump($t);*/