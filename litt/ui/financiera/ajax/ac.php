<?php ob_start();
date_default_timezone_set('America/Argentina/Buenos_Aires');
setlocale(LC_MONETARY, 'es_AR');
require_once '../../../model/database.php';
require_once('numerosAletras.php');

$Ameses = Array(1 => "Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
$id_comercio = $_GET["id"];

$grupos = "";
$nombre = "";
$nombre_comercio = "";
$minimo = 0;
$maximo = 0;
$plazo_minimo = 0;
$plazo_maximo = 0;

$ggrupos = R::getAll("SELECT CGH.id_grupo,C.nombre,C.nombre_titular
							    	FROM comercios AS C
							        JOIN convenios_grupos_habilitados AS CGH ON (CGH.id_convenio = C.convenio)
							        JOIN productos AS p ON (p.grupo = CGH.id_grupo)
							    WHERE C.id = ?",Array($id_comercio));

foreach ($ggrupos as $row) {
	if(!empty($grupos)) $grupos .= ",";
	$grupos .= $row["id_grupo"];

	$nombre = $row["nombre_titular"];
	$nombre_comercio = $row["nombre"];
}
if(!empty($grupos)){
	$producto = R::getRow("SELECT MAX(monto_maximo) AS monto_maximo,MAX(plazo_maximo) AS plazo_maximo,MIN(monto_minimo) AS monto_minimo,MIN(plazo_minimo) AS plazo_minimo
								    	FROM productos
								    WHERE grupo IN (".$grupos.") AND habilitado = 1");
	
	$minimo = $producto["monto_minimo"];
	$maximo = $producto["monto_maximo"];
	$plazo_minimo = $producto["plazo_minimo"];
	$plazo_maximo = $producto["plazo_maximo"];
	
	$letra_minimo = NumeroALetras::convertir($minimo);
	$letra_maximo = NumeroALetras::convertir($maximo);
	$valor_minimo = "$ ".$minimo." (Pesos ".$letra_minimo.")";
	$valor_maximo = "$ ".$maximo." (Pesos ".$letra_maximo.")";
}
$mes = $Ameses[date("n")];

$otorgamiento = 0;

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
				text-transform: uppercase;
			}
			p strong {
				text-decoration: underline;
			}
			li small {
				color: red;
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
			table td:first-child {
				width: 70%;
				text-align:center;
			}
			table td:last-child {
				width: 30%;
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
		<h4>anexo condiciones</h4>
		
		<p style="text-align: right;">Buenos Aires, <?php echo date("d")." de ".$mes." de ".date("Y"); ?></p><br/>
		<p>Comericio: <?php echo $nombre_comercio; ?></p><br/>
		<p><?php echo $nombre; ?></p><br/>
		<p>De nuestra consideración:</p><br/>
		<p>Por medio del presente y en virtud al “Contrato de Adhesión y Gestión de Cobranza” (clausula sexta) celebrado oportunamente le informamos los planes vigentes para operar nuestro sistema de créditos:</p><br/>
		<ul type="square">
			<li>Monto mínimo: <?php echo $valor_minimo ?></li>
			<li>Monto máximo: <?php echo $valor_maximo ?></li>
			<li>Plazo mínimo: <?php echo $plazo_minimo ?></li>
			<li>Plazo máximo: <?php echo $plazo_maximo ?></li>
			<li>Gasto Otorgamiento: <?php echo $otorgamiento ?></li>
			<li>Comisión según porcentaje de Incobrabilidad (*) de la cartera al momento de la liquidación del crédito:
				<ul type="circle">
					<li>0% a 2% = 1%</li>
					<li>2% a 6%	= 3%</li>
					<li>6% a 10% = 4%</li>
					<li>10% a 14% = 6%</li>
					<li>14% a 17% = 8%</li>
					<li>Más de 17% = Alerta. Revisión comercial.</li>
				</ul>
			</li>
		</ul><br/>
		<p><small><i>(*) Se considera como incobrables los créditos con atraso mayor a 90 días</i></small></p>
		<br/>
		<p>Le recordamos que al vencimiento de cada cuota el cliente tiene 3 días de gracia, durante los cuales el sistema no generará intereses alguno por pago fuera de término.</p>
		<br/>
		<p>Saludos cordiales.</p>
		

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

$filename = 'ANEXO_CONDICIONES-'.$nombre.'-'.date("d_m_Y-H_i").'.pdf';

$dompdf->stream($filename);

?>