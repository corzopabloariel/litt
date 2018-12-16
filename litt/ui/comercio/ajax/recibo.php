<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', '1');
require_once '../../../model/database.php';
require_once 'dompdf/autoload.inc.php';
date_default_timezone_set('America/Argentina/Buenos_Aires');
require_once('numerosAletras.php');

use Dompdf\Dompdf;

//initialize dompdf class

$document = new Dompdf();
$nombre = strtoupper($_GET["nombre"]);
$dni = $_GET["dni"];

$datos = 0;
if(!isset($_GET["otorgamiento"]))
  $datos = $_SESSION["cuotas"];
else {
  $id_credito = $_GET["id_credito"];
  $credito = R::findOne("credito_instancia","id LIKE ?",Array($id_credito));
  $credito["gasto_otorgamiento"] = 1;//Gasto generado
  R::store($credito);
}

$d = date("d");$m = date("m");$a = date("Y");
$Adias = Array(0 => "Domingo","Lunes","Martes","miércoles","Jueves","Viernes","Sábado");
$id_recibo = 0;
$id_comercio = 0;
$id_cliente = 0;
$domicilio = "";
$total = 0;
$Adetalles = Array();
$cant_cuotas = count($datos);
/*REDBEANS*/
$cliente = R::findOne("clientes","dni LIKE ?",Array($dni));
if(empty($cliente["domicilio_calle"]) && empty($cliente["domicilio_altura"]) && empty($cliente["domicilio_depto"]))
  $domicilio = "";
else
  $domicilio = "{$cliente["domicilio_calle"]} {$cliente["domicilio_altura"]}, {$cliente["domicilio_depto"]} {$cliente["domicilio_piso"]}, {$cliente["domicilio_manzana"]}, {$cliente["domicilio_localidad"]} - {$cliente["domicilio_barrio"]}";
$domicilio = strtoupper($domicilio);
//--------------------
$recibo = R::dispense("recibos");
$recibo["id_user"] = $_SESSION["id"];
$recibo["id_cliente"] = $cliente["id"];
$recibo["fecha"] = date("Ymd");
if(!isset($_GET["otorgamiento"]))
  $recibo["cant_cuotas"] = $cant_cuotas;
else {
  $recibo["cant_cuotas"] = 0;
  $recibo["gasto_otorgamiento"] = 1;
}
$id_recibo = R::store($recibo);
//--------------------
if(!isset($_GET["otorgamiento"])) {
  $dias_gracia = R::findOne("configuraciones","variable LIKE ?",Array("dias_gracia"))["valor"];
  foreach($datos as $k => $id_cuota){
    $cuota = R::findOne("cuotas","id LIKE ?",Array($id_cuota));
    $id_comercio = $cuota["id_comercio"];
    if(date("Ymd") - $cuota['vencimiento'] > $dias_gracia)
      $interes = round(floatval($cuota["compensatorios"]) + floatval($cuota["punitorios"]) + floatval($cuota["multa"]));
    else $interes = 0;
    
    $subtotal = round(floatval($cuota["cuota_original"]) + $interes);
    $total += $subtotal;
    $Adetalles[] = Array(
            "nro_op" => $cuota["id_credito"],
            "nro_cuota" => $cuota["n_cuota"],
            "vencimiento" => fecha($cuota["vencimiento"]),
            "monto_cuota" => round($cuota["cuota_original"]),
            "interes" => $interes,
            "total" => $subtotal);
    $cuota["id_recibo"] = $id_recibo;
    R::store($cuota);
  }
  //--------------------
} else {
  $id_comercio = $_GET["id_comercio"];
  $config = R::findOne("configuraciones","variable LIKE ?",Array("gastos_otorgamiento"));
  $total = $config["valor"];
}
$recibo["id_comercio"] = $id_comercio;
$recibo["monto"] = $total;
R::store($recibo);
$monto = NumeroALetras::convertir($total);
$nro_recibo = R::findOne("recibos","id LIKE ?",Array($id_recibo))["id"];
$output = "
	<style>
  * {
  margin:0;
  padding:0;
}
body {
  text-align: justify;
  font-size: 12pt;
  margin: 2.5cm 1.5cm
}
table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
    border: 1px solid #000;
}

td, th {
    text-align: left;
    padding: 8px;
    vertical-align: top;
}
.borde {
  padding:20px;
}
.fecha {
  padding:20px 0;
  border-left:1px solid #000;
  text-align:center;
}
.borde.no {
  padding:0;
}
.header table td {
  padding:0;
}
h3.nombre {
  margin: 0;
  margin-bottom: 10px;
  text-align: center;
  font-size:18pt;
  text-transform: uppercase;
}
div.nombre {
  font-size:35pt;
  text-transform:uppercase;
  font-weight: 200;
  text-align: center
}
div.nombre img {
  height: 35pt;
  display: inline-block;
  margin-top:10px;
  margin-left: 20px;
}
div.tipo-recibo {
  border: 1px solid #000;
  text-align: center;
  margin-top:20px;
  padding:15px;
  font-size:20pt;
  position: absolute;
  top: 50px;
  right: -27px;
  background: #fff;
}
p.dato {
  padding-left: 10px;
  padding-top:5px
}
p.dato span {
  font-weight:bold;
  text-align: right;
  margin-right: 10px;
  margin-top: 4px;
  display: inline-block;
  width:70px;
}
p.dato span::after {
  content: ':'
}
table table {
  border: none;
}
table.lista tbody td,
table.lista tfoot td {
  padding:8px 5px !important;
  vertical-align: middle !important;
  text-align: center
}
table.lista tbody td:last-child {
  text-align: center;
}
</style>
<table class='header'>
	<tr>
    <td style='width:50%;padding-top:0; position: relative; border-right: 1px solid #000;border-bottom: 1px solid #000'>
      <div class='borde nombre'>
        
      </div>
      <p style='text-align:center'></p>
      <p style='text-align:center'></p>
      <div class='tipo-recibo'>
        X
      </div>
    </td>
    <td style='width:50%;padding-top:0;border-bottom: 1px solid #000'>
      <div class='borde'>
        <h3 class='nombre'>recibo</h3>
        <p class='dato'><span>N°</span>{$nro_recibo}</p>
        <p class='dato'><span>Fecha</span>{$d} / {$m} / {$a}</p>
      </div>
    </td>
	</tr>
  <tr>
    <td colspan='2'>
      <div class='borde'>
          <p><strong>Apellido y Nombre / Razón Social:</strong> {$nombre}</p>
          <p style='padding-top:10px'><strong>Domicilio:</strong> {$domicilio}</p>
          <table style='padding-top:10px;'>
          <tr>
          <td style='width:50%'><p><strong>I.V.A.:</strong></td>
          <td style='width:50%;'><p><strong>C.U.I.T. / DNI:</strong> {$dni}</td>
          </tr>
          </table>
      </div>
    </td>
  </tr>
  <tr>
    <td colspan='2' style='padding:0'>
      <table class='lista'>
        <thead>
          <tr>";
          if(!isset($_GET["otorgamiento"]))
            $output .= "<th style='width:10%; border-top:1px solid #000; border-bottom:1px solid #000; text-align: center'>Nro Op</th>
            <th style='width:10%; border-top:1px solid #000; border-bottom:1px solid #000; text-align: center'>Nro cuota</th>
            <th style='width:20%; border-top:1px solid #000; border-bottom:1px solid #000; text-align: center'>Fecha vto</th>
            <th style='width:20%; border-top:1px solid #000; border-bottom:1px solid #000; text-align: center'>Monto cuota</th>
            <th style='width:10%; border-top:1px solid #000; border-bottom:1px solid #000; text-align: center'>Interes</th>
            <th style='width:20%; border:1px solid #000; border-right: none; text-align: center'>Subtotal</th>";
          else
            $output .= "<th style='width:80%; border-top:1px solid #000; border-bottom:1px solid #000; text-align: center'>Detalle</th>
            <th style='width:20%; border:1px solid #000; border-right: none; text-align: center'>Total</th>";
          $output .= "</tr>
        </thead>
        <tbody>";
        if(!isset($_GET["otorgamiento"])) {
          foreach ($Adetalles as $d) {
          	$output .= "<tr>";
          		$output .= "<td>{$d["nro_op"]}</td>";
          		$output .= "<td>{$d["nro_cuota"]}</td>";
          		$output .= "<td>{$d["vencimiento"]}</td>";
          		$output .= "<td>{$d["monto_cuota"]}</td>";
          		$output .= "<td>{$d["interes"]}</td>";
          		$output .= "<td>{$d["total"]}</td>";
          	$output .= "</tr>";
          }
          $output .= "</tbody>
        <tfoot>
          <tr>
            <td style='text-align:right; border-top: 1px solid #000' colspan='5'><strong>TOTAL:</strong></td>
            <td style='text-align:center; border-top: 1px solid #000'>{$total}</td>
          </tr>
        </tfoot>
      </table>";
        } else {
          $output .= "<tr>";
            $output .= "<td>Gastos de Otorgamiento</td>";
            $output .= "<td>{$total}</td>";
          $output .= "</tr>";

          $output .= "</tbody></table>";
        }
$output .= "<h3 style='padding:20px'><strong>Recibo de pago por la suma de:</strong> PESOS {$monto}</h3>

      <h3 style='padding:20px; text-align:right'><strong>Firma y Aclaración</strong></h3>
    </td>
  </tr>
</table>
";
/*

*/
$output .= '</table>';

$document->loadHtml($output);

$document->setPaper('A4', 'portrait');

$document->render();

$pdf_out = $document->output();
$fecha = date("d_m_Y-H_i");
if(!isset($_GET["otorgamiento"])) {
  $filename = "recibos/{$id_comercio}-recibo-{$dni}-{$fecha}.pdf";
  $download = "{$id_comercio}-recibo-{$dni}-{$fecha}.pdf";
}
else {
  $filename = "recibos/{$id_comercio}-gasto_otorgamiento-recibo-{$dni}-{$fecha}.pdf";
  $download = "{$id_comercio}-gasto_otorgamiento-recibo-{$dni}-{$fecha}.pdf";
}
//$document->stream("Recibo-".$dni."--".date("d_m_Y-H_i"), array("Attachment"=>1));
$resultado = json_encode(
        Array(
          "href" => $filename,
          "download" => $download,
          "url" => "/litt/ui/comercio/{$filename}",
          "nro_recibo" => $nro_recibo
        )
      );


echo $resultado;

file_put_contents("../{$filename}", $pdf_out);

function fecha($f) {
    $a = substr($f, 0,4);
    $m = substr($f, 4,2);
    $d = substr($f, 6,2);

    return $d."/".$m."/".$a;
}
?>