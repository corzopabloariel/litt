<?php
$ARR_CSS = array();
$ARR_CSS[] = "/litt/ui/financiera/css/select2.min.css";
$ARR_CSS[] = "/litt/ui/financiera/css/jquery-ui.css";
$ARR_CSS[] = "/litt/ui/financiera/css/messagebox.css";
$ARR_JS = array();
$ARR_JS[] = "/litt/ui/financiera/js/select2.js";
$ARR_JS[] = "/litt/ui/financiera/js/jquery-ui.js";
$ARR_JS[] = "/litt/ui/financiera/js/messagebox.js";
$ARR_JS[] = "/litt/ui/financiera/js/lobibox.js";
session_start();
include('./header.php');

$id_cuotas = Array();
$nombre = "";
$dni = 0;
?>
	<div class="container"> 
		<div class="panel-b col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2 col-xs-10 col-xs-offset-1">
			<div class="row panel-title">
				<div class="col-sm-6 col-sm-offset-3" style="border-bottom: 2px solid #769FCD; margin-bottom: 20px"><h2 align="center">Cobrar Cuotas</h2></div>
			</div>
			<div class="row">
                <?php
                // busco provisionalmente por dni 

                include_once($_SERVER['DOCUMENT_ROOT'] . '/litt/controller/basic.php');
                include_once($_SERVER['DOCUMENT_ROOT'] . '/litt/model/database.php');

                $sum = 0;
                $dias_gracia = R::findOne("configuraciones","variable LIKE ?",Array("dias_gracia"))["valor"];
                if(isset($_POST)) $_SESSION["cuotas"] = $_POST;
                foreach($_POST as $k => $v){
                    $a = R::load('cuotas', (integer) $v);
                    $a['abonado'] = '1';
                    $a['fecha_depago'] = date("Ymd");
                    if(empty($nombre)) {
                    	$x = R::getRow( 'SELECT nombre,apellido FROM clientes WHERE dni = :dni', array(':dni'=>$a["dni_cliente"]) );
                    	$nombre = $x["apellido"]." ".$x["nombre"];
                    	$dni = $a["dni_cliente"];
                    }
                    if(date("Ymd") - $a['vencimiento'] > $dias_gracia)
                    	$interes = round(floatval($a["compensatorios"]) + floatval($a["punitorios"]) + floatval($a["multa"]));
                    else $interes = 0;
                    $sum += floatval($a['cuota_original'] + $interes);
                    R::store($a);
                }
                ?>   
				<span><h2 align="center" style="font-weight: 600">COBRADO $ <span><?php echo round($sum) ?></span></h2></span>
			</div>

			<div class="row text-center">	
				<div class="col-xs-12 col-ms-6">
					<button disabled id="btn-enviar" class="btn btn-primary btn-lg" onclick="enviar()"><i class="fas fa-at"></i> Enviar Recibo</button>
				</div>
			</div>
			<div class="row col-espacio-t text-center">
				<div class="col-xs-12 col-ms-6">
					<a disabled class="btn btn-primary btn-lg" href="" download="" id="imprimir"><i class="fas fa-print"></i> Imprimir Recibo</a>
					<input type="hidden" id="url_pdf">
				</div>
			</div>
			<div class="row">
				<div class="bottom-btns">
					<a href="<?php echo config::$ui_main_comercio; ?>" style="color: #FFFFFF;" class="btn btn-primary btn-lg">MENU</a>
				</div>
			</div>
		</div>
	</div>
		
	<script>
		var nro_recibo = 0;
		var url_pdf = "";
		$(document).ready(function() {
			imprimir();
		});
	function enviar() {
		var dni = "<?php echo $dni; ?>";
		var file = $("#imprimir").attr("download");
		$.ajax({
			url: 'ajax/cliente.php',
			type: "post",
			data: {"accion":"recibo","url":url_pdf,"recibo":nro_recibo,"file":file},
			beforeSend: function() {
				Lobibox.notify('info', {
	                size: 'mini',
	                msg: 'Enviando información',
	                showClass: 'fadeInDown',
	                hideClass: 'fadeUpDown',
	                delay: 10000,
	                sound: false
	            });
			}
		}).done(function(data){
			//var done = JSON.parse(data);
			console.log(data);
		})
	}
	function imprimir() {
		$("#imprimir").attr("disabled","true");
		var dni = "<?php echo $dni; ?>";
		var nombre = "<?php echo $nombre; ?>";
		var page = "ajax/recibo.php?nombre="+nombre+"&dni="+dni;
		$.ajax({
			url: 'ajax/recibo.php',
			type: "get",
			data: {"nombre":nombre,"dni":dni},
		}).done(function(data){
			var done = JSON.parse(data);
			$("#imprimir,#btn-enviar").removeAttr("disabled");
			$("#imprimir").attr("href",done.href);
			$("#imprimir").attr("download",done.download);
			nro_recibo = done.nro_recibo;
			url_pdf = "../"+done.href;
			console.log(data);
		})
        //descargar(page);
	}
	function descargar(url) {
	    window.onfocus = finalizada;
	    document.location = url;
	}

	function finalizada() {
	    window.onfocus = vacia;
	    // Modificar a partir de aquí
	}
	function vacia(){}
	function serialize(arr) {
		var res = 'a:'+arr.length+':{';
		for(i=0; i<arr.length; i++)
		{
		res += 'i:'+i+';s:'+arr[i].length+':"'+arr[i]+'";';
		}
		res += '}';
		 
		return res;
	}
	</script>
</body>
</html>