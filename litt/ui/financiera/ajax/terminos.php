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
$tem = R::findOne("cuotas","id_credito LIKE ?",Array($id_credito))["tem"];

$monto = $aprobado." (Pesos ".NumeroALetras::convertir($aprobado).")";

$cr = R::findOne("comercios","id LIKE ?",Array($id_comercio));
$comercio = $cr["razon_social"];
$comercio_ubicacion = $cr["domicilio_comercio_calle"]." ".$cr["domicilio_comercio_altura"];

$output = "
<html lang='es'>
  <head>
    <meta charset='utf-8'>
	<style>
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
.borde {
  border:1px solid #000;
  border-radius: 10px;
  padding:20px;
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
  font-size:50pt;
  text-transform:uppercase;
  font-weight: 200
}
div.nombre img {
  height: 50pt;
  display: inline-block;
  margin-top:10px;
  margin-left: 20px;
}
</style>
</head>
<body>
<table class='header'>
	<tr>
		<td style='text-align:center; text-transform:uppercase; background: #eee; font-size:12px'>términos y condiciones de la solicitud de crédito personal</td>
	</tr>
  <tr>
    <td style='text-align: justify; font-size:10px;'>
    <p style='margin:0'>En un todo de acuerdo a los términos de la presente solicitud, el Solicitante (en adelante denominado el “Deudor”) viene a requerir a LITT con domicilio en Mendoza 5735 de la ciudad Autónoma de Buenos Aires (En adelante denominado el “Acreedor”), un crédito personal (en adelante denominado el “Crédito”) por la suma de {$monto} pagadero en {$cuotas} cuotas mensuales y consecutivas de amortización de capital con más el interés compensatorio establecido en la Cláusula 5.</p>
<p style='margin:0'>1. En caso de ser aceptada esta Solicitud por el Acreedor, el Deudor se obliga a: 1.1 Abonar las cuotas mensuales del Crédito, conforme a lo establecido en la Solicitud. 1.2 Comunicar al Acreedor, dentro de las 48 horas de acaecido, todo cambio en su situación patrimonial declarada por el solicitante y/o la de su/s codeudor/es. Asimismo, se obliga a comunicar al Acreedor, dentro de las 48 horas, de todo cambio de domicilio del Deudor y/ o de su/s codeudor/es.</p>
<p style='margin:0'>2. El Deudor declara bajo juramento que el Crédito será destinado a: Consumo Personal.</p>
<p style='margin:0'>3. Queda especialmente aceptado por el Deudor que la forma de reembolso al Acreedor del Crédito se efectuará mediante el pago de las cuotas en el comercio <strong>{$comercio} ubicado en {$comercio_ubicacion}</strong> o la que en el futuro se indique. Orden de Imputación de Pagos. Los pagos que reciba el Acreedor serán imputados en el siguiente orden: 1) intereses punitorios (en caso de existir), 2) intereses compensatorios (en caso de existir) 3) intereses; y 4) capital.</p>
<p style='margin:0'>4. El sistema de amortización del Crédito será el denominado Sistema Francés, conforme al desarrollo de Cuotas Suscripto por el Deudor.</p>
<p style='margin:0'>5. La tasa de interés del crédito será del 10,6 % efectivo mensual, excluido el impuesto al Valor Agregado o cualquier otro impuesto vigente o futuro que, en caso de corresponder, será a cargo del Deudor y se cancelará conjuntamente con cada pago de interés. A partir de la fecha de desembolso del Crédito y hasta su efectivo pago, el Crédito devengará un interés compensatorio vencido pagadero por períodos mensuales, junto con las cuotas de amortización de capital. El inicio del período de reembolso operará el día 42610. Si el día en que fuere exigible algún pago resultará no hábil, ese pago deberá realizarse el día hábil inmediatamente posterior. En dicho período se calcularán intereses sobre el importe que hubiera correspondido abonar si el vencimiento hubiera operado en un día hábil.</p>
<p style='margin:0'>6. El Deudor se compromete a informar al Acreedor su situación frente al IVA y en caso de no hacerlo, el Acreedor la considerará como sujeto no categorizado con todas las consecuencias fiscales emergentes de dicha categoría tributaria.</p>
<p style='margin:0'>7. El Costo Financiero Total asciende al 129 % efectivo anual, calculado por la aplicación de los intereses según cláusula 5 y conceptos a que se refieren las cláusulas 3, 12 y 14 (gastos y comisiones) y 11 (Seguro de Vida).</p>
<p style='margin:0'>8. La falta de pago de cualquiera de las cuotas del Crédito y/o el incumplimiento de cualquiera de las obligaciones establecidas, producirá la mora de pleno derecho y sin necesidad de requerimiento o interpelación previa judicial o extrajudicial al Deudor. Son también supuestos de incumplimiento: 8.1 El uso indebido de los fondos del Crédito que implique modificar el destino declarado o si se constatara la falsedad de cualquiera de las declaraciones efectuadas para la obtención del Crédito. 8.2 La solicitud del Deudor de su concurso preventivo o su quiebra. 8.3 Si se trabara algún embargo o inhibición sobre los bienes del Deudor o mediaren circunstancias que, afectara la solvencia que se tuvo en cuenta al acordar inicialmente el crédito.</p>
<p style='margin:0'>9. La mora en el cumplimiento de cualquiera de las obligaciones asumidas por el Deudor, permitirá al Acreedor declarar la caducidad de todos los plazos y, en consecuencia, exigir la inmediata e íntegra devolución del capital prestado con más sus accesorios. El no pago en término del capital y/o de los servicios de intereses, importará asimismo el devengamiento de intereses punitorios, sin perjuicio de los intereses compensatorios, a una tasa anual vencida equivalente al 50% de los intereses compensatorios detallados en el Art.5. Así también el Acreedor podrá informar al Deudor como moroso en las bases comerciales tales como Veraz, Nosis, RiesgoNet u otras que el Acreedor considere.</p>
<p style='margin:0'>10. El restancia o recibo de recepción de fondos suscripta por el Deudor, será suficiente constancia del otorgamiento y el perfeccionamiento del crédito.</p>
<p style='margin:0'>11. Para la protección del Crédito y sus accesorios el Acreedor podrá constituir, por sí en su carácter de Asegurador o contratando al efecto una compañía aseguradora, un Seguro de Vida para cubrir el riesgo de muerte del Deudor, con efecto cancelatorio del saldo de deuda en concepto de capital teórico que registre el Crédito, el que se mantendrá en vigor durante la totalidad de la vigencia del Crédito, con pago de primas por períodos mensuales y sujeto a las Condiciones Generales y Particulares que el Deudor declara conocer y aceptar en todos sus términos por haber sido informado antes de ahora, copia de las cuales recibe el Deudor en este acto.</p>
<p style='margin:0'>12. Todas las comisiones, gastos, seguros e impuestos que graven el crédito serán a cargo del Deudor, los que podrán ser cobrados por el Acreedor, como así también el importe de todas y cada una de las cuotas según lo estipulado en la cláusula 3 y 4, sin que ello implique en modo alguno novación, espera, ni remisión de la obligación. Serán también a cargo de los deudores todos los gastos, incluyendo los honorarios de los letrados, que se originen por la eventual cobranza judicial o extrajudicial. El Acreedor podrá cobrar al Deudor en el caso que lo decida, una comisión por gestión crediticia y/o gastos de otorgamiento, liquidación del crédito y gastos administrativos mensuales y las comisiones por gestión de cobranza por atraso.
<p style='margin:0'>13. El Deudor suscribe en este acto un Pagaré a la vista sin protesto, extendido a la orden el Acreedor por el monto del crédito a otorgar.</p>
<p style='margin:0'>14. En la presente operación, el plazo se presume establecido en beneficio de ambas partes, dejando a salvo la facultad del Deudor de pre cancelar el Crédito abonando la totalidad de la deuda incluyendo los intereses devengados hasta la fecha de la pre cancelación. En este último caso, el Acreedor tendrá derecho a exigir el pago del nueve por ciento (9%) más IVA del capital adeudado como compensación por cancelación anticipada, compensación que el Deudor expresamente acepta, renunciando en forma expresa e irrevocable a efectuar reclamo alguno en tal sentido. Asimismo, el Deudor deberá hacerse cargo de todos los gastos y costos, inclusive (aunque no limitado a) los impositivos, que dicha pre cancelación originare. A los efectos del ejercicio de esta opción el Deudor deberá comunicar el Acreedor su decisión de cancelar en forma anticipada de manera fehaciente con una anticipación no menor a 10 días de la fecha de pre cancelación, la cual deberá ser una fecha de pago del servicio de amortización e intereses.</p>
<p style='margin:0'>15. El Deudor presta conformidad para que, en cualquier momento, aún con posterioridad al incumplimiento, el Acreedor venda, ceda o transfiera parte o todos los beneficios, acciones, derechos y/o garantías del presente Crédito por cualquiera de los medios previstos en la Ley, adquiriendo el o los cesionarios los mismos beneficios y/o derechos y/o acciones que el Acreedor bajo el presente contrato. De optar por la cesión prevista en los artículos 70 a 72 de la Ley 24.441 (Ley de Fideicomiso), la cesión del Crédito y su garantía podrá hacerse sin notificación al DEUDOR y tendrá validez desde su fecha de formalización, en un todo de acuerdo con lo establecido por el artículo 72 de la Ley de Fideicomiso. Conforme lo previsto en la misma Ley, la cesión tendrá efecto desde la fecha en la que se opere la misma y solo podrán oponerse contra el cesionario las excepciones previstas en el mencionado artículo. No obstante, en el supuesto que la cesión implique modificación de domicilio de pago, el nuevo deberá notificarse en forma fehaciente al DEUDOR. Asimismo, el Deudor presta expresa conformidad para que el Acreedor proporcione a los terceros información referida al suscripto y a las operaciones de crédito que pudiera concertar y el Deudor toma conocimiento y acepta expresamente que en caso de que el Acreedor venda, ceda o transfiera la acreencia y de acuerdo con lo establecido en la Comunicación A 2729 modificatorias y complementarias del BCRA, podrá estar incluido en la Central de Riesgo del BCRA y sujeto a la clasificación de deudores.</p>
<p style='margin:0'>16. La presente Solicitud no implica obligación alguna de aceptación por parte el Acreedor, quien se reserva el derecho de rechazarla a su sólo arbitrio. El Acreedor no asumirá responsabilidad alguna por los gastos en que hubieren incurrido los solicitantes con motivo de la Solicitud.</p>
<p style='margin:0'>17. El Acreedor constituye domicilio en el indicado en el encabezamiento y el Deudor en el declarado en la Solicitud de Crédito Personal, en los que se tendrán por validas todas las notificaciones judiciales o extrajudiciales que se practiquen. Ambas partes acuerdan expresamente que cualquier cuestión sobre el alcance, interpretación y ejecución del Crédito será sometida, a la jurisdicción y competencia de los Tribunales Ordinarios competentes de la Ciudad Autónoma de Buenos Aires con renuncia a cualquier otro fuero o jurisdicción que pudiera corresponderles en la actualidad o en el futuro por cualquier causa.</p>
    </td>
  </tr>
</table>
</body></html>";

$document->load_html($output);

//$document->setPaper('A4', 'landscape');
$document->set_paper(array(0,0,594.75,841.5));//oficio

$document->render();


$document->stream("TERMINOS_Y_CONDCIONES_DE_LA_SOLICITUD_DE_CREDITO_PERSONAL-".$dni."--".date("d_m_Y-H_i").".pdf", array("Attachment"=>1));

function fecha($f) {
    $a = substr($f, 0,4);
    $m = substr($f, 4,2);
    $d = substr($f, 6,2);

    return $d."/".$m."/".$a;
}