<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once '../../../model/database.php';
require_once('dompdf/dompdf_config.inc.php');
require_once('numerosAletras.php');

$document = new DOMPDF();

date_default_timezone_set('America/Argentina/Buenos_Aires');

$id_comercio = $_GET["id"];
$cuit = "";
$razon_social = "";
$nombre_comercio = "";
$rubro = "";
$direccion_comercio = "";
$nombre_titular = "";

$telefono_comercio = "";
$celular_comercio = "";


$Alocalidad = Array();$Aprovincia = Array();

$localidades = R::findAll("localidades");
foreach ($localidades as $localidad) {
  if(!isset($Alocalidad[$localidad["id"]])) $Alocalidad[$localidad["id"]] = $localidad["nombre"];
}

$provincias = R::findAll("provincias");
foreach($provincias as $provincia) {
	if(!isset($Aprovincia[$provincia["id"]])) $Aprovincia[$provincia["id"]] = $provincia["nombre"];
}

$Arubros = Array(2 => "Animales y Mascotas","Arte y Cultura","Bebés","Belleza y Cuidado Personal","Automóviles","Hardware y Software Informático","Descargas","Moda y Complementos","Flores, Regalos y Artesanía","Alimentación y Bebidas","HiFi, Foto y Video","Hogar y Jardìn","Electrodomésticos","Joyería","Lencería y Adultos","mòviles y Telefonía","Servicios","Calzado y Complementos","Deporte y Ocio","Viajes y Turismo");

$comercio = R::findOne("comercios","id LIKE ?",Array($id_comercio));
$nombre_titular = strtoupper($comercio["nombre_titular"]);
$nombre_comercio = strtoupper($comercio["nombre"]);
$razon_social = strtoupper($comercio["razon_social"]);
$rubro = strtoupper($Arubros[$comercio["rubro"]]);
$telefono_comercio = $comercio["telefono_fijo"];
$celular_comercio = $comercio["telefono_celular"];
$cuit = $comercio["cuit"];

$provincia = strtoupper($Aprovincia[$comercio["domicilio_comercio_provincia"]]);
$localidad = strtoupper($Alocalidad[$comercio["domicilio_comercio_localidad"]]);
$direccion_comercio = "{$comercio["domicilio_comercio_calle"]} {$comercio["domicilio_comercio_altura"]} de la localidad de {$localidad}, {$provincia}";

$Adias = Array(0 => "Domingo","Lunes","Martes","miércoles","Jueves","Viernes","Sábado");
$output = "
<html lang='es'>
  <head>
    <meta charset='utf-8'>
	<style>
  body {
    font-size: 12pt;
  }
  hr {
    border: none;
    border-bottom: 1px dotted #000;
    padding-top:40px;
    margin-bottom:40px
  }
  h3 { text-align: center; }
  ul li { padding-bottom: 20px; }
  ul li strong::after { content: ': '; }
  div.header { font-size:20px; text-align:right; }
  div.header img { height:18px; display:inline-block }
  div.firma { position:absolute; bottom: 0px; right: 0px; width:200px; text-align: center; }
  div.firma p { border-top: 1px solid; padding:5px 20px; }
</style></head>
<body>
<div class='header'>
  LITT
  <img src='pluma.png'/>
</div>
<div>
<h3>DATOS PARA LA CONFECCIÓN DE LEGAJO COMERCIAL</h3>
<ul>
<li><strong>N° CUIT</strong> {$cuit}</li>
<li><strong>Razón Social</strong> {$razon_social}</li>
<li><strong>Nombre del Comercio</strong> {$nombre_comercio}</li>
<li><strong>Rubro del Comercio</strong> {$rubro}</li>
<li><strong>Dirección Comercial</strong> {$direccion_comercio}</li>
<li><strong>Teléfono Comercial</strong> {$telefono_comercio}</li>
<li><strong>Teléfono Celular</strong> {$celular_comercio}</li>
<li><strong>Antigüedad del Comercio</strong></li>
<li><strong>Sucursales - Localidades de estas</strong></li>
</ul>
<ul style='padding-top: 48pt'>
<li><strong>Referencias Comerciales (__)</strong></li>
</ul>
<ul style='padding-top: 48pt'>
<li><strong>Bancos con que operan</strong></li>
<li><strong>Promedio de venta mensual</strong></li>
<li><strong>Nombre y Apellido (Titular)</strong> {$nombre_titular}</li>
<li><strong>Dirección Personal <small>(fotocopia servicio de luz)</small></strong></li>
</ul>
<ul style='padding-top: 12pt'>
<li><strong>Teléfono Personal</strong></li>
<li><strong>Por medio de quien se contactó con nosotros</strong></li>
</ul>
<div class='firma'>
<p>{$nombre_titular}</p>
</div>
</div>
</body></html>
";

$document->load_html($output);

//$document->setPaper('A4', 'landscape');
$document->set_paper(array(0,0,594.75,841.5));//oficio

$document->render();


$document->stream("SOLICITUD_DE_ADHESION-".date("d_m_Y-H_i").".pdf", array("Attachment"=>1));