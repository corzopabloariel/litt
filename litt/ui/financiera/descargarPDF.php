<?php
include('./header.php');


// me envian la informacion por post, id del credito a imprimir

include_once($_SERVER['DOCUMENT_ROOT'] . '/litt/controller/basic.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/litt/model/database.php');

$id = $_GET['id'];

//$cuerpo = file_get_contents("pdf/solicitud_credito.html");
// recibo por post los datos
/*$p = $_POST;
// reemplazo

foreach($p as $k => $v){
    $mayus = strtoupper($k);
    $cuerpo = str_replace("%" . $mayus . "%", $p[$k], $cuerpo);
}*/

/*
$cuerpo = str_replace("%CAPITAL_APROBADO%",$p['capital_aprobado'],$cuerpo);
$cuerpo = str_replace("%CANTIDAD_CUOTAS%",$p['cantidad_cuotas'],$cuerpo);
$cuerpo = str_replace("%APELLIDO%",$p['apellido'],$cuerpo);
$cuerpo = str_replace("%NOMBRE%",$p['nombre'],$cuerpo);
$cuerpo = str_replace("%DNI%",$p['dni'],$cuerpo);
$cuerpo = str_replace("%FECHA_NACIMIENTO%",$p['fecha_nacimiento'],$cuerpo);
$cuerpo = str_replace("%EMAIL%",$p['email'],$cuerpo);
$cuerpo = str_replace("%TELEFONO_FIJO%",$p['telefono_celular'],$cuerpo);
$cuerpo = str_replace("%DOMICILIO_CALLE%",$p['domicilio_calle'],$cuerpo);
$cuerpo = str_replace("%DOMICILIO_ALTURA%",$p['domicilio_altura'],$cuerpo);
// $cuerpo = str_replace("%DOMICILIO_PISO%",$p[''],$cuerpo);
$cuerpo = str_replace("%DOMICILIO_BARRIO%",$p['domicilio_barrio'],$cuerpo);
$cuerpo = str_replace("%DOMICILIO_LOCALIDAD%",$p['domicilio_localidad'],$cuerpo);
$cuerpo = str_replace("%DOMICILIO_PROVINCIA%",$p['domicilio_provincia'],$cuerpo);
$cuerpo = str_replace("%DOMICILIO_CP%",$p['domicilio_cp'],$cuerpo);
$cuerpo = str_replace("%DOMICILIO_DEPARTAMENTO%",$p['domicilio_departamento'],$cuerpo);
$cuerpo = str_replace("%DOMICILIO_MANZANA%",$p['domicilio_manzana'],$cuerpo);
$cuerpo = str_replace("%LABORAL_EMPRESA%",$p['laboral_empresa'],$cuerpo);
$cuerpo = str_replace("%LABORAL_TELEFONO%",$p['laboral_telefono'],$cuerpo);
$cuerpo = str_replace("%LABORAL_SUELDO%",$p['laboral_sueldo'],$cuerpo);
$cuerpo = str_replace("%LABORAL_CALLE%",$p['laboral_calle'],$cuerpo);
$cuerpo = str_replace("%LABORAL_ALTURA%",$p['laboral_altura'],$cuerpo);
$cuerpo = str_replace("%LABORAL_PISO%",$p['laboral_piso'],$cuerpo);
/*$cuerpo = str_replace("%%",$p[''],$cuerpo);
$cuerpo = str_replace("%%",$p[''],$cuerpo);
$cuerpo = str_replace("%%",$p[''],$cuerpo);*/


// obtengo nombre aleatorio para descarga
/*$file = "pdf/" . $id . "_solicitud.pdf";
file_put_contents($file . ".html", $cuerpo);
exec("xvfb-run wkhtmltopdf ./" . $file . ".html  " . $file);
// $pdf = file_get_contents($file);

/* LOS OTROS REEMPLAZOS DE desarrollo_cuotas.html */
//sleep(3);
/*$cuerpo2 = file_get_contents("pdf/desarrollo_cuotas.html");

$file2 = "pdf/" . $id . "_cuotas.pdf";
file_put_contents($file2 . ".html", $cuerpo2);
exec("xvfb-run wkhtmltopdf ./" . $file2 . ".html  " . $file2);

/*
header('Content-Type: application/pdf');
header('Cache-Control: public, must-revalidate, max-age=0'); // HTTP/1.1
header('Pragma: public');
header('Expires: Sat, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
header('Content-Length: '.strlen($pdf));
header('Content-Disposition: inline; filename="' . $file .'";');
ob_clean(); 
flush(); 
echo $pdf;*/
//echo $cuerpo;

// comando para convertir a pdf
// xvfb-run wkhtmltopdf ./solicitud_credito.html solicitud.pdf



?>
<div class="container"> 
	<div class="panel-a">
        <div class="row panel-title">
            <div class="col-sm-6 col-sm-offset-3" style="border-bottom: 2px solid #769FCD;margin-bottom:20px">
                <?php $c = R::findOne("credito_instancia","id = ?",Array($id));$cliente = R::findOne("clientes","dni = ?",Array($c["dni_cliente"])) ?>
                <h2 align="center">Descargar Formularios<br/>cliente <b><?php echo strtoupper($cliente["apellido"] . ", " . $cliente["nombre"]); ?></b></h2>
            </div>
            <div class="col-sm-3"><img src="/litt/ui/comercio/img/docs.png"></div>
        </div>
        <div class="row">
            
            <div class="col-xs-12" style="overflow-x: auto; padding:0 20px">
				<table class="table t-centered" style="width:80%;font-size: 18px;margin-top:30px">
					<tbody>
                        <tr style="font-weight: 600; background:#ccc;">
    						<td>Archivo</td>
    						<td>Descarga</td>
					    </tr>
                        <tr>
                            <td>Solicitud de Crédito</td>
                            <td><button class="fa fa-print" onclick="sc()"></button></td>
                        </tr>
                        <tr>
                            <td>Desarrollo de Cuota</td>
                            <td><button class="fa fa-print" onclick="desarrollo()"></button></td>
                        </tr>
                        <tr>
                            <td>Términos y Condiciones</td>
                            <td><button class="fa fa-print" onclick="terminos()"></button></td>
                        </tr>
				    </tbody>
                </table>
			</div>
        </div>
		<div class="bottom-btns">
            <a class="btn btn-primary btn-lg cancel-btn" onclick="window.close();" style="color: #FFFFFF;">Salir</a>
		</div>
    </div>
</div>
		
<script>
	function imprimir() {
        sc();
        setTimeout(function() {
            desarrollo();
        },500);
        setTimeout(function() {
            terminos();
        },1000);
    }
    function sc() {
        var id_credito = "<?php echo $id; ?>";
        console.log(id_credito)
        var page = "/litt/ui/financiera/ajax/sc.php?id_credito="+id_credito;
        descargar(page);
    }
    function desarrollo() {
        var id_credito = "<?php echo $id; ?>";
        console.log(id_credito)
        page = "/litt/ui/financiera/ajax/desarrollo.php?id_credito="+id_credito;
        descargar(page);
    }
    function terminos() {
        var id_credito = "<?php echo $id; ?>";
        console.log(id_credito)
        page = "/litt/ui/financiera/ajax/terminos.php?id_credito="+id_credito;
        descargar(page);
    }
    
    function descargar(url) {
        window.onfocus = finalizada;
        document.location = url;
    }
    function finalizada() {
        window.onfocus = vacia;
    }
    function vacia(){}
</script>

</body></html>
