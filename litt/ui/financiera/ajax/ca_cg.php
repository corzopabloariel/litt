<?php ob_start();
date_default_timezone_set('America/Argentina/Buenos_Aires');
require_once '../../../model/database.php';
$id_comercio = $_GET["id"];

$Alocalidad = Array();$Aprovincia = Array();
$localidades = R::findAll("localidades");
foreach ($localidades as $l) {
	if(!isset($Alocalidad[$l["id"]])) $Alocalidad[$l["id"]] = $l["nombre"];
}
$provincias = R::findAll("provincias");
foreach ($provincias as $p) {
	if(!isset($Aprovincia[$p["id"]])) $Aprovincia[$p["id"]] = $p["nombre"];
}
$dni = "";
$nombre = "";
$domicilio = "";
$nombre_comercio = "";
$domicilio_comercio = "";

$comercio = R::findOne("comercios","id LIKE ?",Array($id_comercio));
$dni = $comercio["dni_titular"];
$nombre = strtoupper($comercio["nombre_titular"]);
$nombre_comercio = strtoupper($comercio["nombre"]);

$provincia = strtoupper($Aprovincia[$comercio["domicilio_legal_provincia"]]);
$localidad = strtoupper($Alocalidad[$comercio["domicilio_legal_localidad"]]);
$domicilio = "{$comercio["domicilio_legal_calle"]} {$comercio["domicilio_legal_altura"]} de la localidad de {$localidad}, {$provincia}";

$provincia = strtoupper($Aprovincia[$comercio["domicilio_comercio_provincia"]]);
$localidad = strtoupper($Alocalidad[$comercio["domicilio_comercio_localidad"]]);
$domicilio_comercio = "{$comercio["domicilio_comercio_calle"]} {$comercio["domicilio_comercio_altura"]} de la localidad de {$localidad}, {$provincia}";

$Ameses = Array(1 => "Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
$dia = date("d");
$mes = $Ameses[date("n")];
$anio = date("Y");

?>
<html>
	<head>
    	<meta charset="utf-8">
    	<style>
    		html {
    			margin: 0;
    		}
    		body {
    			text-align: justify;
    			font-family: "Times New Roman", Times, serif;
    			font-size: 12pt;
    			margin: 2.5cm 3cm
    		}
    		p,ul,ol {
    			margin: 0px;
			}
			h4 {
				text-align: center;
				text-decoration: underline;
				margin: 0;
				margin-bottom: 11.5px;
			}
			p strong {
				text-decoration: underline;
			}
			div.header {
				position: fixed;
				width: 100%;
				top: 0;
				left: 0;
				padding: 1cm;
				text-align: right;
				font-size: 22px;
			}
				div.header img {
					height: 20pt;
					margin-left: 10px;
				}

			div.footer {
				position: fixed;
				width: 100%;
				bottom: 10%;
				left: 0;
				padding: 1cm;
				text-align: left;
				font-size: 22px;
			}
				div.footer img {
					height: 20pt;
					margin-right: 10px;
				}
			table {
				width: 100%;
			}
			table td {
				width: 50%;
				text-align:center;
			}
    	</style>
    </head>
	<body>
		<div class="header">
			LITT
			<img src="pluma.png" />
		</div>
		<div class="footer">
			<img src="pluma.png" />
			wwww.litt.com.ar
		</div>
		<h4>CONTRATO DE ADHESIÓN Y GESTIÓN DE COBRANZA</h4>
		<p>En la ciudad de San Miguel del Monte, provincia de Buenos Aires a los <?php echo $dia; ?> días del mes de <?php echo $mes; ?> de <?php echo $anio; ?>, entre la firma LITT, representada en este acto por el sr. Christian Ariel Solano, DNI: 33.446.852 en adelante denominada “La Empresa”, y por la otra, <?php echo $nombre; ?>, con DNI: <?php echo $dni; ?>, con domicilio en calle <?php echo $domicilio; ?>, titular del comercio que gira bajo el nombre de fantasía “<?php echo $nombre_comercio; ?>”, sito en la calle <?php echo $domicilio_comercio; ?>, en adelante “El Comercio”, convienen celebrar el presente contrato, el cual se rige por las siguientes cláusulas y condiciones: ------</p>
		<p><strong>PRIMERA. Documentación:</strong> El Comercio se compromete y obliga a atender las compras y/o servicios que realicen las personas adheridas al sistema de créditos de La Empresa, otorgándole a sus clientes el crédito solicitado, cumpliendo con los siguientes requisitos:
		</p>
		<ol type="a">
			<li>Presentación de la <stron>copia del recibo de haberes</stron>, del período inmediato anterior a la fecha de la solicitud en el cual conste una antigüedad no menos a 3 (tres) meses en la relación laboral. Junto con dicha copia deberá acompañarse indefectiblemente el original de la misma para su cotejo, quedando constancia de ello en la copia mencionada con firma y aclaración del cotejante acompañando la leyenda “visto original”. El recibo deberá contener todos los requisitos formales impuestos por las normativas vigentes (membrete, sello y firma del empleador).-----</li>
			<li><stron>Copia simple de su DNI</stron>, en el cual conste la totalidad de los datos personales, fotografía del interesado y su radicación domiciliaria. <stron>No serán válidas otras formas de acreditación de identidad</stron> (por ejemplo: carnet de conducir, carnets de asociados de clubes, etc). Las copias que presentare también deberán ser cotejadas con su original al momento de agregarlas, quedando debida constancia en la fotocopia mencionada.------</li>
			<li><stron>Copia del último servicio con su comprobante de pago (Luz, gas, teléfono fijo, Resumen de Tarjeta de Crédito, ABL, Agua, Cable)</stron>. La fecha del “próximo vencimiento” deberá ser posterior a la fecha de otorgamiento del crédito. El mismo será cotejado con su original de acuerdo al sistema descripto en el punto a) de esta clausula y no deberá registrar deuda a la fecha de solicitud de crédito.-----</li>
			<li>El domicilio deberá ser detallado con total precisión, de modo que permita ubicar y/o notificar al adherido por cualquier medio epistolar, indicando el nombre completo de la calle y numero donde se domiciliare el adherente, indicar un teléfono fijo propio o de algún pariente, como asi también la mención del barrio y manzana y otros datos en el caso de que no pudiere individualizarse el domicilio de manera convencional.-----</li>
			<li>Deberá presentar dos referencias personales con sus teléfonos de contacto.</li>
		</ol>
		<p><strong>SEGUNDA. Formularios:</strong> El comercio se compromete a imprimir y hacer firmar por los clientes con su aclaración y nro de DNI los siguientes formularios pertenecientes al legajo de cada crédito:</p>
		<ul type="square">
			<li>Solicitud de crédito</li>
			<li>Desarrollo de cuotas + pagaré</li>
		</ul>
		<p>Cualquier crédito otorgado sin la previsión mencionada anteriormente será considerado nulo, pudiendo La Empresa rechazar el pago del mismo al Comercio.----</p>
		<br/>
		<p><strong>TERCERA. Datos de clientes:</strong> El Comercio se compromete a volcar en el sistema la mayor cantidad de datos que pudiera suministrar para la mayor seguridad y cumplimiento del crédito.----</p>
		<p><strong>CUARTA. Aceptación del crédito:</strong> Será requisito indispensable, para que La Empresa acepte el crédito y pueda pagarlo, que El Comercio suba al sistema la foto o scan de toda la documentación y formularios firmados por el cliente con el correspondiente sello del “visto original” con la firma del cotejante.-----</p>
		<p><strong>QUINTA. Guarda del Legajo:</strong> El Comercio deberá mantener la guarda del legajo original firmado hasta que La Empresa lo disponga. La pérdida, extravio o destrucción de esta documentación es responsabilidad exclusiva de El Comercio. En dicho caso La Empresa se encontrará obligada a descontar a aquel, los créditos que no hubieran cancelado los adherentes, a excepción que en plazo de cinco (5) días de cominicada la pérdida, extravío o destrucción, El Comercio reponga la documentación que cumpla con los requisitos para acceder al crédito. El no envio de la documentación por parte del Comercio a La Empresa cuando esta la requiera será causal de rescisión del presente contrato sin obligación por parte de La Empresa de preavisar la ruprura de la relación.-----</p>
		<p><strong>SEXTA. Condiciones:</strong> El crédito otorgado por El Comercio será pagadero según las condiciones vigentes que se detallen en el “Anexo Condiciones” o las que haya comunicado posteriormente La Empresa de manera fehaciente. Los mismos no podrán ser anulados, luego de realizada la subida del legajo completo para la Aceptación del crédito según lo indicado en la clausula cuarta.-----</p>
		<p><strong>SEPTIMA. Cantidad de créditos vigentes por cliente:</strong> Los adherentes al sistema de La Empresa solo podrán contraer un máximo de tres (3) créditos activos. Dicha cantidad de créditos activos por persona adherida podrá ser modificada por La Empresa previo aviso fehaciente al Comercio.</p>
		<p><strong>OCTAVA. Modificaciones de Condiciones:</strong> Cualquier modificación de los planes de créditos, requisitos para su otorgamiento, cantidad de cuotas, ampliación o reducción de montos mínimos y/o máximos como asi también los días de presentación y pago y los descuentos que disponga La Empresa solo serán validas si La Empresa comunica al Comercio de modo fehaciente las mismas, debiendo este aplicar las nuevas normas desde la recepción de dichas modificaciones.-----</p>
		<p><strong>NOVENA. Créditos irregulares:</strong> El otorgamiento de créditos por parte del comercio en contraposición a los planes y condiciones informadas por La Empresa al Comercio, y a los requisitos y formas que surgen del presente contrato, no serán abonados al Comercio. La Empresa intimará al Comercio a que subsane los vicios que contengan las solicitudes de adhesión y/o se abstenga de seguir otorgando créditos irregulares. De persistir dicha conducta luego de la intimación, será causal suficiente de rescisión del presente contrato sin obligación alguna de preavisar por parte de La Empresa, siendo El Comercio responsable por los daños y perjuicios que este proceder ocasionare, tanto frente a La Empresa como frente a los terceros adherentes.-----</p>
		<p><strong>DECIMA. Créditos Irregulares pagados:</strong> Para el supuesto caso que La Empresa haya efectuado el pago del crédito al Comercio, que resulte irregular de acuerdo a la clausula anterior, la primera podrá deducir dicho pago de los montos de las futuras presentaciones que realizare El Comercio; cualquier fuese el tiempo transcurrido entre el otorgamiento del crédito y la detección de dicha irregularidad por parte de La Empresa.</p>
		<p><strong>DECIMO PRIMERA. Gestión crediticia:</strong> El Comercio destinará dentro de su local comercial un espacio físico para la promoción del sistema, otorgamiento de créditos y cobranzas del mismo. El personal utilizado con ese fin será a exclusivo cargo del Comercio, no teniendo vinculación laboral alguna ni de ninguna otra índole con La Empresa.----</p>
		<p><strong>DECIMO SEGUNDA. Cobranza:</strong> El Comercio percibirá el importe de las cuotas abonadas por los adherentes al sistema, otorgando los recibos, impresos o via email, que emitirá por el sistema de La Empresa como único instrumento valido para esa operación.</p>
		<p><strong>DECIMO TERCERA. Rendiciones:</strong> El Comercio tendrá disponible en el sistema un módulo “Rendiciones” en donde se detallarán todas las cuotas cobradas pendientes de rendición a La Empresa y todos los créditos aceptados por la Empresa pendientes de pago al Comercio. Las rendiciones se harán semanalmente o con la frecuencia que ambas partes acuerden. Ambas partes tendrán hasta un máximo de 30 días para realizar la rendición pendiente. </p>
		<p><strong>DECIMO CUARTA. Comisión:</strong> La Empresa pagará los créditos aceptados al Comercio por el monto del capital descontando la comisión en concepto de retribución por los servicios financieros prestados. La comisión podrá ser variable según el % de Incobrables que contenga la cartera del comercio. La comisión acordada con el comercio se detalla en el “Anexo Condiciones”.</p>
		<p><strong>DECIMO QUINTA. Alto porcentaje de Incobrabilidad:</strong> En caso de que el % de Incobrables (Atraso mayor a 90 dias) alcance el 17% (diecisiete por ciento) de la cartera, la Empresa podrá suspender la operatoria con El Comercio hasta tanto disminuya el porcentaje.</p>
		<p><strong>DECIMO SEXTA. Renovación contrato:</strong> El contrato se renovará automáticamente cada año calendario contado a partir de la firma del presente, salvo que alguna de las partes comunique su voluntad de no renovar la relación contractual. El Comercio deberá comunicar a La Empresa con una anticipación no menor a noventa (90) días su decisión de no continuar con la relación contractual.------</p>
		<p><strong>DECIMO SEPTIMA. Rescisión contrato:</strong> En caso de producirse la rescisión, por cualquier motivo, y por parte del Comercio, este se obliga a remitir a La Empresa, juntamente con la comunicación de su voluntad de rescindir, el importe de las cobranzas realizadas desde la última Rendición; la papelería obrante en su poder y la documentación de los legajos de los adherentes que aun no hayan cancelado totalmente su crédito. Del mismo modo y para el caso que la rescisión se opere por voluntad de La Empresa, esta se compromete a cancelar las liquidaciones remitidas con anterioridad por El Comercio y que hubieran quedado pendientes a la fecha de finalización o rescisión del presente contrato. Todo ello bajo la condición de producida esta situación, El Comercio haya remitido a La Empresa la totalidad de la documentación, papelería e importes antes descriptos.-----</p>
		<p><strong>DECIMO OCTAVA. Modificación de operatoria:</strong> La Empresa esta facultada para modificar la operatoria de cobranza mencionada en las clausulas precedentes; cambiar el domicilio y lugar de pago de cuotas y tomar cualquier decisión tendiente a asegurar el efectivo cumplimiento de las normas contenidas en este contrato. En tal caso, La Empresa debe comunicar al Comercio en forma fehaciente su decisión, debiendo este adoptar y dar cumplimiento de la misma en forma inmediata, a parti del momento de recibir la notificación. La falta de cumplimiento de las instrucciones recibidas, producirá la nulidad absoluta de todas las operaciones realizadas con posterioridad por El Comercio en nombre de La Empresa que no respeten las modificaciones informadas, responsabilizándose ante esta, y los adherentes al sistema de las dificultades y diferencias que pudieran producirse.-</p>
		<p><strong>DECIMO NOVENA. Notificación de cambios:</strong> El Comercio se obliga a comunicar de modo fehaciente a La Empresa todo cambio de domicilio comercial y/o real del titular del mismo, que se produzca durante el tiempo de vigencia de este contrato, dentro de las setenta y dos (72) horas de producido. También debe comunicar por medio fehaciente cualquier cambio de la razón social, nombre de fantasía, numero de CUIT, conformación de la sociedad y/o rubros con que opera, en el término antes citado. En caso que tal información no sea notificada en el modo indicado, La Empresa podrá rescindir el presente contrato sin necesidad de aviso bastando solo notificación fehaciente de ello.---</p>
		<p><strong>VIGÉSIMO. Cese de actividades:</strong> En caso de cierre o cese de actividades del Comercio, sea este temporal o definitivo, debe comunicarlo a La Empresa en forma fehaciente y con no menos de noventa (90) días de antelación. Durante este periodo El Comercio debe abstenerse de otorgar nuevos créditos. El incumplimiento de esta clausula obliga automáticamente al Comercio, como fiador solidario y principal pagador, por los saldos pendientes e impagos de cada uno de los créditos por el otorgados dentro del plazo citado, al momento de la resolución del contrato.-----</p>
		<p><strong>VIGÉSIMO PRIMERA. Compensación:</strong> En caso de rescisión del presente, podrá La Empresa aplicar una compensación, descontando del dinero debido al Comercio en concepto de presentaciones de vales el monto del saldo en caja que se encuentre en El Comercio proveniente de cobranzas del sistema.----</p>
		<br>
		<p>En prueba de conformidad y a un solo efecto se firman dos ejemplares de un mismo tenor.</p>
		<br/><br/><br/><br/><br/><br/>
		<table>
			<tbody>
				<tr>
					<td><p>LITT</p></td>
					<td>
						<p><?php echo $nombre_comercio ?><br/><?php echo $nombre ?></p>
						<p><small>(Firma y Aclaración)</small></p>
					</td>
				</tr>
			</tbody>
		</table>

		<script type="text/php">
		if (isset($pdf))
		{
		$font = Font_Metrics::get_font("Times New Roman", "bold");
		$pdf->page_text(533, 746, "{PAGE_NUM} de {PAGE_COUNT}", $font, 14, array(0, 0, 0));
		}
		</script>
	</body>
</html>

<?php
require_once('dompdf/dompdf_config.inc.php');

$dompdf = new DOMPDF('P','mm','A4');
$dompdf->load_html(ob_get_clean());
$dompdf->render();

//$pdf = $dompdf->output();
$filename = 'CONTRATO_DE_ADHESION_Y_GESTION_DE_COBRANZA-'. str_replace(" ", "_", $nombre) .'-'.date("d_m_Y-H_i").'.pdf';

$dompdf->stream($filename);

//$output = $dompdf->output();
//file_put_contents('filename.pdf', $output);

?>