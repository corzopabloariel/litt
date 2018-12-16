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
$id_comercio = 0;

$credito = R::findOne("credito_instancia","id LIKE ?",Array($id_credito));

$monto = $credito["monto"];
$plazo = $credito["cuotas"];
$dni = $credito["dni_cliente"];
$id_comercio = $credito["id_comercio"];
$tem = R::findOne("cuotas","id_credito LIKE ?",Array($id_credito))["tem"];

$suma = $monto." (Pesos ".NumeroALetras::convertir($monto).")";

$cliente = R::findOne("clientes","dni LIKE ?",Array($dni));
$apellido = $cliente["apellido"];
$nombre = $cliente["nombre"];
$nac = $cliente["fecha_nacimiento"];
$mail = $cliente["mail"];
$telefono_fijo = $cliente["telefono_fijo"];
$celular = $cliente["telefono_celular"];
$calle_particular = $cliente["domicilio_calle"];
$nro_p = $cliente["domicilio_altura"];//NUMERO
$piso_p = $cliente["domicilio_piso"];
$dpt_p = $cliente["domicilio_depto"];;
$man_p = $cliente["domicilio_manzana"];;
$barrio_particular = $cliente["domicilio_barrio"];;
$localidad_p = $cliente["domicilio_localidad"];
$provincia_p = $cliente["domicilio_provincia"];
$cp_p = $cliente["domicilio_cpa"];
$empresa = $cliente["empleo_empresa"];
$tel_emp = $cliente["empleo_telefono"];
$sueldo = $cliente["empleo_sueldo"];
$calle_empresa = $cliente["empleo_calle"];
$nro_e = $cliente["empleo_altura"];//NUMERO
$piso_e = $cliente["empleo_piso"];
$dpt_emp = $cliente["empleo_depto"];
$man_emp = $cliente["empleo_manzana"];
$barrio_empresa = $cliente["empleo_barrio"];
$localidad_e = $cliente["empleo_localidad"];
$provincia_e = $cliente["empleo_provincia"];
$cp_e = $cliente["empleo_cpa"];
$ref_nombre = $cliente["referido_nombre"];
$ref_pare = $cliente["referido_parentesco"];
$ref_telefono = $cliente["referido_telefono_fijo"];
$ref_celular = $cliente["referido_telefono_celular"];
$nombre_completo = $nombre." ".$apellido;
$domicilio = $calle_particular." ".$nro_p." ".$piso_p." ".$dpt_p." ".$man_p;

$comercio = R::findOne("comercios","id LIKE ?",Array($id_comercio));
$nombre_comercio = $comercio["razon_social"];
$ubicacion_comercio = $comercio["domicilio_comercio_calle"]." ".$comercio["domicilio_comercio_altura"];

$output = "
<html lang='es'>
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
    padding: 6px;
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
<body>
<h2 style='text-align:center; text-transform: uppercase; margin:0'>solicitud de crédito personal</h2>
<div style='text-align:right; padding-bottom: 5px; font-size:20px; line-height: 20px'>
  LITT
  <img style='height:18px; display: inline-block' src='pluma.png'/>
</div>
<table class='header'>
  <tr>
    <td class='titulo' colspan='6'>condiciones de prestamos personales</td>
  </tr>
  <tr>
    <td class='detalle' style='width:24%'>capital aprobado:</td><td style='width:12%'>{$monto}</td>
    <td class='detalle' style='width:24%'>plazo aprobado (meses):</td><td style='width:20%'>{$plazo}</td>
    <td class='detalle' style='width:10%'>tem</td><td style='width:10%'>{$tem}</td>
  </tr>
</table>

<table class='header' style='margin-top:-1px'>
  <tr>
    <td class='titulo' colspan='6'>datos del cliente</td>
  </tr>
  <tr>
    <td class='detalle' style='width:12%'>apellido:</td>
    <td colspan='2'>{$apellido}</td>
    <td class='detalle' style='width:12%'>nombres:</td>
    <td colspan='2'>{$nombre}</td>
  </tr>
  <tr>
    <td class='detalle' style='width:12%'>dni:</td><td style='width:24%'>{$dni}</td>
    <td class='detalle' style='width:12%'>fecha nac:</td><td>{$nac}</td>
    <td class='detalle' style='width:6%'>mail:</td><td style='34%'>{$mail}</td>
  </tr>
  <tr>
    <td class='detalle' style='width:10%'>TEL FIJO:</td>
    <td colspan='2'>{$telefono_fijo}</td>
    <td class='detalle' style='width:10%'>celular:</td>
    <td colspan='2'>{$celular}</td>
  </tr>
</table>
<table class='header' style='margin-top:-1px'>
  <tr>
    <td colspan='6' class='titulo'>domicilio particular</td>
  </tr>
  <tr>
    <td class='detalle' style='width:12%'>calle:</td>
    <td style='width:36%'>{$calle_particular}</td>
    <td class='detalle' style='width:12%'>nro:</td>
    <td style='width:10%'>{$nro_p}</td>
    <td class='detalle' style='width:10%'>piso:</td>
    <td style='width:20%'>{$piso_p}</td>
  </tr>
</table>
<table class='header' style='margin-top:0px'>
  <tr>
    <td class='detalle' style='width:12%'>depto:</td>
    <td style='width:12%'>{$dpt_p}</td>
    <td class='detalle' style='width:12%'>manzana:</td>
    <td style='width:12%'>{$man_p}</td>
    <td class='detalle' style='width:12%'>barrio:</td>
    <td style='width:40%'>{$barrio_particular}</td>
  </tr>
</table>
<table>
  <tr>
    <td class='detalle' style='width:12%'>localidad:</td>
    <td style='width:24%'>{$localidad_p}</td>
    <td class='detalle' style='width:12%'>provincia:</td>
    <td style='width:32%'>{$provincia_p}</td>
    <td class='detalle' style='width:10%'>cp:</td>
    <td style='width:auto'>{$cp_p}</td>
  </tr>
</table>

<table class='header' style='margin-top:-1px'>
  <tr>
    <td colspan='6' class='titulo'>domicilio laboral</td>
  </tr>
  <tr>
    <td class='detalle' style='width:12%'>empresa:</td>
    <td style='width:36%'>{$empresa}</td>
    <td class='detalle' style='width:12%'>tel:</td>
    <td style='width:20%'>{$tel_emp}</td>
    <td class='detalle' style='width:10%'>sueldo:</td>
    <td style='width:10%'>{$sueldo}</td>
  </tr>
</table>
<table class='header' style='margin-top:0px'>
  <tr>
    <td class='detalle' style='width:12%'>calle:</td>
    <td style='width:36%'>{$calle_empresa}</td>
    <td class='detalle' style='width:12%'>nro:</td>
    <td style='width:10%'>{$nro_e}</td>
    <td class='detalle' style='width:10%'>piso:</td>
    <td style='width:20%'>{$piso_e}</td>
  </tr>
</table>
<table class='header' style='margin-top:0px'>
  <tr>
    <td class='detalle' style='width:12%'>depto:</td>
    <td style='width:12%'>{$dpt_emp}</td>
    <td class='detalle' style='width:12%'>manzana:</td>
    <td style='width:12%'>{$man_emp}</td>
    <td class='detalle' style='width:12%'>barrio:</td>

    <td style='width:40%'>{$barrio_empresa}</td>
  </tr>
</table>
<table>
  <tr>
    <td class='detalle' style='width:12%'>localidad:</td>
    <td style='width:24%'>{$localidad_e}</td>
    <td class='detalle' style='width:12%'>provincia:</td>
    <td style='width:32%'>{$provincia_e}</td>
    <td class='detalle' style='width:10%'>cp:</td>
    <td style='width:auto'>{$cp_e}</td>
  </tr>
</table>

<table class='header' style='margin-top:-1px'>
  <tr>
    <td colspan='4' class='titulo'>referncias personales (debe ser un 3°)</td>
  </tr>
  <tr>
    <td class='detalle' style='width:20%'>nombre completo:</td>
    <td style='width:40%'>{$ref_nombre}</td>
    <td class='detalle' style='width:20%'>parentesco:</td>
    <td style='width:20%'>{$ref_pare}</td>
  </tr>
</table>
<table>
  <tr>
    <td class='detalle' style='width:12%'>tel fijo:</td>
    <td style='width:auto'>{$ref_telefono}</td>
    <td class='detalle' style='width:12%'>celular:</td>
    <td style='width:40%'>{$ref_celular}</td>
  </tr>
</table>

<table class='header' style='margin-top:-1px'>
  <tr>
    <td class='titulo'>constancia de recepción de fondos e instrucción de pago irrevocable</td>
  </tr>
</table>
<table style='margin-top:0'>
  <tr>
    <td class='detalle' style='width:12%; border-right:none; border-bottom: none'>FECHA:</td>
    <td style='width:68%; border-right:none; border-bottom: none; border-left: none;'>{$fecha}</td>
    <td class='detalle' style='width:10%; border-right:none; border-bottom: none; border-left: none;'>nro op:</td>
    <td style='width:10%; border-bottom: none; border-left: none;'>{$nro_op}</td>
  </tr>
</table>
<table style='margin-top:-2px'>
  <tr>
    <td class='detalle' style='width:20%; border-top: none; border-right:none; border-bottom: none'>nombre completo:</td>
    <td style='width:80%; border-top: none; border-bottom: none; border-left: none;'>{$nombre_completo}</td>
  </tr>
</table>
<table style='margin-top:-2px'>
  <tr>
    <td class='detalle' style='width:12%; border-top: none; border-right:none; border-bottom: none'>domicilio:</td>
    <td style='width:88%; border-top: none; border-bottom: none; border-left: none;'>{$domicilio}</td>
  </tr>
</table>
<table style='margin-top:-2px'>
  <tr>
    <td class='detalle' style='width:12%; border-top: none; border-right:none; border-bottom: none'>localidad:</td>
    <td style='width:auto; border-top: none; border-bottom: none; border-left: none; border-right: none;'>{$localidad_p}</td>

    <td class='detalle' style='width:6%; border-right: none; border-top: none; border-left:none; border-bottom: none'>CP:</td>
    <td style='width:12%; border-top: none; border-right: none; border-bottom: none; border-left: none;'>{$cp_p}</td>

    <td class='detalle' style='width:12%; border-right: none; border-top: none; border-left:none; border-bottom: none'>provincia:</td>
    <td style='width:28%; border-top: none; border-bottom: none; border-left: none;'>{$provincia_p}</td>
  </tr>
  <tr>
    <td colspan='6' style='border-top: none; font-size:12px; line-height: 14px; text-align: justify'>
      <p style='margin:0'>Recibí de LITT la suma de {$suma} en concepto de desembolso del préstamo personal, sirviendo el presente de suficiente recibo y carta de pago.</p>
      <p style='margin:0'>Por La presente instruyo a LITT de manera irrevocable para que por mi cuenta y orden transfieran la suma correspondiente al crédito otorgado con menos los gastos y comisiones que fueron pactados a favor del comercio {$nombre_comercio} ubicado en {$ubicacion_comercio}.</p>
      <table style='margin-top:40px;'>
        <tr>
          <td style='border:none; width:25%'><p style='text-align:center; border-top:1px solid;padding:10px'>Firma Solicitante</p></td>
          <td style='border:none; width:50%; padding:0 20px'><p style='text-align:center; border-top:1px solid;padding:10px 20px;'>Aclaración</p></td>
          <td style='border:none; width:25%'><p style='text-align:center; border-top:1px solid;padding:10px;'>DNI</p></td>
        </tr>
      </table>
    </td>
  </tr>
</table>
<table style='margin-top:0px'>
  <tr>
    <td class='detalle' style='width:12%;'>lugar:</td>
    <td style='width:58%;'>{$ubicacion_comercio}</td>
    <td class='detalle' style='width:10%;'>fecha:</td>
    <td style='width:20%;'>{$fecha}</td>
  </tr>
  <tr>
    <td colspan='4'>
      <p style='margin:0; font-size:12px; line-height: 14px; text-align: justify'>Declaro expresamente que cumplida esta instrucción por la empresa LITT, no tendré derecho a reclamo alguno por el destino de los fondos. Asimismo, declaro expresamente conocer y aceptar que LITT es una empresa dedicada a la gestión de créditos y el hecho de que transfiera los fondos del crédito otorgado a una empresa o comercio, es bajo mi precisa instrucción y exclusiva responsabilidad, no teniendo LITT ninguna responsabilidad ni vinculación con las transacciones que se efectuaran entre el beneficiario de la instrucción de pago y el solicitante del crédito. Por lo expuesto, declaro expresamente que no podré oponer al fiel cumplimiento del pago de cuotas y demás obligaciones previstas los Términos y Condiciones de la Solicitud de Crédito, cualquier incumplimiento, reclamo o compensación que surja de las relaciones comerciales y/o jurídicas que mantenga con el Beneficiario o Destinatario de la Instrucción de Pago o Transferencia.</p>
    </td>
  </tr>
</table>
</body></html>
";

$document->load_html($output);

//$document->setPaper('A4', 'landscape');
$document->set_paper(array(0,0,594.75,841.5));//oficio

$document->render();


$document->stream("SOLICITUD_DE_CREDITO_PERSONAL-".$dni."--".date("d_m_Y-H_i").".pdf", array("Attachment"=>1));

function fecha($f) {
    $a = substr($f, 0,4);
    $m = substr($f, 4,2);
    $d = substr($f, 6,2);

    return $d."/".$m."/".$a;
}