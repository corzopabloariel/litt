<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once '../../../model/database.php';
require_once('dompdf/dompdf_config.inc.php');
require_once('numerosAletras.php');

$document = new DOMPDF();

date_default_timezone_set('America/Argentina/Buenos_Aires');

$id_credito = $_GET["id_credito"];
$nro_op = $id_credito;
$fecha = date("d/m/Y");
$aprobado = 0;
$id_comercio = 0;

$credito = R::findOne("credito_instancia","id LIKE ?",Array($id_credito));
$aprobado = $credito["monto"];
$cuotas = $credito["cuotas"];
$dni = $credito["dni_cliente"];
$id_comercio = $credito["id_comercio"];

$ccuotas = R::findAll("cuotas","id_credito LIKE ?",Array($id_credito));
$Acuotas = Array();
foreach ($ccuotas as $c) {
  $tem = $c["tem"];
  if(!isset($Acuotas[$c["n_cuota"]])) $Acuotas[$c["n_cuota"]] = Array();

  $Acuotas[$c["n_cuota"]]["vencimiento"] = fecha($c["vencimiento"]);
  $Acuotas[$c["n_cuota"]]["cuota"] = round($c["cuota_original"]);
}
$monto = $aprobado." (Pesos ".NumeroALetras::convertir($aprobado).")";

$cliente = R::findOne("clientes","dni LIKE ?",Array($dni));
$apellido = strtoupper($cliente["apellido"]);
$nombre = strtoupper($cliente["nombre"]);
$fecha_nac = $cliente["fecha_nacimiento"];
$calle_particular = strtoupper($cliente["domicilio_calle"]);
$calle_particular .= $cliente["domicilio_altura"];
$nro_p = $cliente["domicilio_altura"];
$piso_p = $cliente["domicilio_piso"];
$dpt_p = strtoupper($cliente["domicilio_depto"]);
$man_p = strtoupper($cliente["domicilio_manzana"]);
$barrio_particular = $cliente["domicilio_barrio"];
$localidad = strtoupper($cliente["domicilio_localidad"]);
$provincia = strtoupper($cliente["domicilio_provincia"]);
$cp = strtoupper($cliente["domicilio_cpa"]);
$domicilio = $calle_particular." ".$nro_p." ".$piso_p." ".$dpt_p." ".$man_p;

$comercio = R::findOne("comercios","id LIKE ?",Array($id_comercio));
$nombre_comercio = strtoupper($comercio["nombre"]);//nombre de fantasia
$lugar = strtoupper($comercio["domicilio_comercio_calle"]." ".$comercio["domicilio_comercio_altura"]);

$d = date("d");$m = date("m");$a = date("Y");
$Adias = Array(0 => "Domingo","Lunes","Martes","miércoles","Jueves","Viernes","Sábado");
$output = "
<html>
  <head>
      <meta charset='utf-8'>
	<style>
  body {
    font-size: 8pt;
  }
  hr {
    border: none;
    border-bottom: 1px dotted #000;
    padding-top:40px;
    margin-bottom:40px
  }
table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

td, th {
    text-align: left;
    padding: 8px;
    border:1px solid #000
}
td.titulo {
  text-transform: uppercase;
  background: #ccc;
  text-align: center;
}
td.detalle {
  text-transform: uppercase;
}

</style>
</head>
<div style='text-align:right;font-size: 20px;'>LITT
  <img style='height:20px; display: inline-block' src='pluma.png'/>
</div>
<table class='header'>
  <tr>
    <td class='titulo' colspan='8'>condiciones de prestamos personales</td>
  </tr>
  <tr>
    <td class='detalle' style='width:20%'>capital aprobado:</td><td style='width:19.5%'>{$aprobado}</td>
    <td class='detalle' style='width:10%'>cuotas:</td><td style='width:10%'>{$cuotas}</td>
    <td class='detalle' style='width:10%'>tem</td><td style='width:10%'>$tem</td>
    <td class='detalle'>nro op:</td><td>{$nro_op}</td>
  </tr>
</table>
<table class='header' style='margin-top:-1px'>
  <tr>
    <td class='titulo' colspan='4'>datos del cliente</td>
  </tr>
  <tr>
    <td class='detalle' style='width:10%'>apellido:</td>
    <td>{$apellido}</td>
    <td class='detalle' style='width:10%'>nombres:</td>
    <td>{$nombre}</td>
  </tr>
</table>
<table class='header' style='margin-top:-1px'>
  <tr>
    <td class='titulo'>desarrollo de cuotas</td>
  </tr>
  <tr>
    <td>
      <table style='width:45%; margin: 0px auto; margin-top:10px'>
        <tr>
          <td>NRO CUOTA</td>
          <td>FECHA VTO</td>
          <td>CUOTA TOTAL</td>
        </tr>";
        foreach ($Acuotas as $n => $dato) {
        	$output .= "<tr>";
        		$output .= "<td>{$n}</td>";
        		$output .= "<td>{$dato["vencimiento"]}</td>";
        		$output .= "<td>{$dato["cuota"]}</td>";
        	$output .= "</tr>";
        }
$output .= "</table>
      <p><small>*Declaro expresamente aceptar el presente Desarrollo de Cuotas conforme a lo establecido en el Art. 4 de los Términos y Condiciones de la Solicitud del Crédito Personal.</small></p>
    </td>
  </tr>
  <tr>
    <td class='titulo'>pagaré</td>
  </tr>
  <tr>
    <td>
      <table style='border:none !important'>
        <tr>
          <td style='width:10%; border:none'>FECHA:</td>
          <td style='width:70%; border:none'>".date("d/m/Y")."</td>
          <td style='width:10%; border:none'>NRO OP:</td>
          <td style='border:none'>{$nro_op}</td>
        </tr>
      </table>
      <p><small>Por valor recibido PAGARÉ incondicionalmente, A LA VISTA y SIN PROTESTO, a la orden de Christian Ariel Solano, DNI 33.446.852 o a su orden, la suma de {$monto} (Pesos TRES MIL ).<br/>
El importe del presente Pagaré devengará intereses compensatorios a una tasa anual vencida del 134,23 % desde la fecha de su suscripción y hasta el dÍa del pago. Ampliase el plazo para la presentación del presente hasta 5 (cinco) años de su fecha de emisión (Arts. 36 y 103 Decreto Ley 5965/63). En caso de falta de pago del presente Pagaré a su presentación, el importe adeudado devengará adicionalmente un interés punitorio a una tasa anual vencida equivalente al 50 % de los intereses compensatorios. (Art. 52, Dec. 5965/63).
</small></p>

      <table style='border:none !important'>
        <tr>
          <td style='width:20%; border:none; padding:0'>NOMBRE COMPLETO:</td>
          <td style='border:none; padding:0'>{$nombre} {$apellido}</td>
        </tr>
        <tr>
          <td style=' border:none; padding:0'>DOMICILIO:</td>
          <td style='border:none; padding:0'>{$domicilio}</td>
        </tr>
        <tr>
          <td style='border:none; padding:0'>LOCALIDAD:</td>
          <td style='border:none; padding:0; width:30%'>{$localidad}</td>
          <td style='border:none; padding:0; width:10%'>CP:</td>
          <td style='border:none; padding:0; width:10%'>{$cp}</td>
          <td style='border:none; padding:0; width:10%'>PROVINCIA:</td>
          <td style='border:none; padding:0; width:20%'>{$provincia}</td>
        </tr>
      </table>
    </td>
  </tr>
</table>
<table style='margin-top:0'>
  <tr>
    <td style='width:10%'>LUGAR:</td>
    <td style='width70%'>{$lugar}</td>
    <td style='width:10%'>FECHA:</td>
    <td style='width:'>".date("d/m/Y")."</td>
  </tr>
</table>

<hr/>

<table class='header'>
  <tr>
    <td class='titulo' colspan='8'>condiciones de prestamos personales</td>
  </tr>
  <tr>
    <td class='detalle' style='width:20%'>capital aprobado:</td><td style='width:19.5%'>{$aprobado}</td>
    <td class='detalle' style='width:10%'>cuotas:</td><td style='width:10%'>{$cuotas}</td>
    <td class='detalle' style='width:10%'>tem</td><td style='width:10%'>{$tem}</td>
    <td class='detalle'>nro op:</td><td>{$nro_op}</td>
  </tr>
</table>
<table class='header' style='margin-top:-1px'>
  <tr>
    <td class='titulo' colspan='4'>datos del cliente</td>
  </tr>
  <tr>
    <td class='detalle' style='width:10%'>apellido:</td>
    <td>{$apellido}</td>
    <td class='detalle' style='width:10%'>nombres:</td>
    <td>{$nombre}</td>
  </tr>
</table>
<table class='header' style='margin-top:-1px'>
  <tr>
    <td class='titulo'>desarrollo de cuotas</td>
  </tr>
  <tr>
    <td>
      <table style='width:45%; margin: 0px auto; margin-top:10px'>
        <tr>
          <td>NRO CUOTA</td>
          <td>FECHA VTO</td>
          <td>CUOTA TOTAL</td>
        </tr>";
        foreach ($Acuotas as $n => $dato) {
        	$output .= "<tr>";
        		$output .= "<td>{$n}</td>";
        		$output .= "<td>{$dato["vencimiento"]}</td>";
        		$output .= "<td>{$dato["cuota"]}</td>";
        	$output .= "</tr>";
        }
$output .= "</table>
      <div style='text-align:center'>
        <p>COPIA CLIENTE</p>
        <p>LUGAR DE PAGO: {$lugar}</p>
      </div>
    </td>
  </tr>
</html>";

$output .= '</table>';

$document->load_html($output);

//$document->setPaper('A4', 'landscape');
$document->set_paper(array(0,0,594.75,841.5));//oficio

$document->render();


$document->stream("DESARROLLO_DE_CUOTAS-".$dni."--".date("d_m_Y-H_i").".pdf", array("Attachment"=>1));

function fecha($f) {
    $a = substr($f, 0,4);
    $m = substr($f, 4,2);
    $d = substr($f, 6,2);

    return $d."/".$m."/".$a;
}

?>