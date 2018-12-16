<?php ob_start();

$cuit = $_GET["cuit"];
$cuil = $_GET["cuil"];
$razon_social = $_GET["razon_social"];
$nombre_comercio = $_GET["nombre_comercio"];
$rubro = $_GET["rubro"];
$direccion = $_GET["direccion"];
$telefono_comercio = $_GET["telefono_comercio"];
$telefono_celular = $_GET["telefono_celular"];
$antiguedad = $_GET["antiguedad"];
$Sucursales = $_GET["Sucursales"];
$referencia_num = $_GET["referencia_num"];
$referencia = $_GET["referencia"];
$banco = $_GET["banco"];
$promedio_venta = $_GET["promedio_venta"];
$nombre_titular = $_GET["nombre_titular"];
$direccion_personal = $_GET["direccion_personal"];
$teleono_personal = $_GET["teleono_personal"];
$contacto = $_GET["contacto"];

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
		<h4>Datos para la confección de Legajo Comercial</h4>
		
		<ul>
			<li><strong>Nº Cuit:</strong> <?php echo $cuit ?></li>
			<li><strong>Razón Social:</strong> <?php echo $razon_social ?></li>
			<li><strong>Nombre Comercio:</strong>  <?php echo $nombre_comercio ?></li>
			<li><strong>Rubro del Comercio:</strong> <?php echo $rubro ?></li>
			<li><strong>Dirección comercial:</strong> <?php echo $direccion ?></li>
			<li><strong>Teléfono comercial:</strong> <?php echo $telefono_comercio ?></li>
			<li><strong>Teléfono celular:</strong> <?php echo $telefono_celular ?></li>
			<li><strong>Antigüedad del Comercio:</strong> <?php echo $antiguedad ?></li>
			<li><strong>Sucursales – Localidades de las mismas:</strong> <?php echo $Sucursales ?></li>
			<li><strong>Referencias Comerciales (<?php echo $referencia_num ?>):</strong> <?php echo $Referencia ?></li>
			<li><strong>Bancos con que Opera:</strong> <?php echo $banco ?></li>
			<li><strong>Promedio de venta mensual:</strong> <?php echo $promedio_venta ?></li>
			<li><strong>Nombre y Apellido (Titular):</strong> <?php echo $nombre_titular ?></li>
			<li><strong>Dirección Personal (fotocopia servicio de luz):</strong> <?php echo $direccion_personal ?></li>
			<li><strong>Teléfono personal:</strong> <?php echo $teleono_personal ?></li>
			<li><strong>Por medio de quien se contacto con nosotros:</strong> <?php echo $contacto ?></li>
		</ul>
		<br/><br/><br/><br/>
		<table>
			<tbody>
				<tr>
					<td></td>
					<td>
						<hr/>
						<p><?php echo $nombre_titular ?><br/><?php echo $cuil ?></p>
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

$filename = 'SOLICITUD_DE_ADHESION-'.$nombre_comercio.'-'.date("d_m_Y-H_i").'.pdf';

$dompdf->stream($filename);

?>