<?php
include('./header.php');
setlocale(LC_MONETARY, 'es_AR');
// traigo el digest realizado por el sistema

// capital liquidado
$capital_liquidado = 0;
$x = R::findAll("credito_instancia","estado_liquidacion LIKE ?",[1]);
foreach($x as $e)
    $capital_liquidado += $e["monto"];
// cuotas cobradas originales, punitorios
$cuotas_cobradas = 0;
$punitorios = 0;
$x = R::findAll("cuotas","abonado LIKE ?",[1]);
foreach($x as $e){
    $cuotas_cobradas += $e["cuota_original"];
    $punitorios += $e["punitorios"];
}
// sueldos
$sueldos = 0;
$x = R::findAll("registro_pago","id_movimiento LIKE ?",[1]); // sueldos
foreach($x as $e){
    $sueldos += $e["monto"];
}
// publicidad
$muebles = 0;
$x = R::findAll("registro_pago","id_movimiento LIKE ?",[5]); // muebles
foreach($x as $e){
    $muebles += $e["monto"];
}
// publicidad
$publicidad = 0;
$x = R::findAll("registro_pago","id_movimiento LIKE ?",[4]); // publicidad
foreach($x as $e){
    $publicidad += $e["monto"];
}
// varios
$varios = 0;
$x = R::findAll("registro_pago","id_movimiento LIKE ?",[6]); // varios
foreach($x as $e){
    $varios += $e["monto"];
}


// cantidad de creeditos liquidados
$creditos_liquidados = R::count("credito_instancia","estado_liquidacion LIKE ?",[1]);
$comercios_adheridos = R::count("comercios");
$colocacion = 0;
$capital_promedio = "?";
$cantidad_mora = R::count("cuotas","estado_mora LIKE ?",[7]);
$total_cuotas = R::count("cuotas");
$cantidad_mora = ($cantidad_mora / $total_cuotas) * 100;

$Ameses = Array(1 => 'Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre');
$meses = '';
foreach ($Ameses as $key => $value) {
	$meses .= '<option value="' . $key . '" ' . (date("n") == $key ? 'selected="selected"' : '') . '>' . $value . ' ' . date("Y") . '</option>';
}

?>
<script>
	$(document).ready(function() {
		DatePicker();
		acumulado("01/01/2000",$('input[name="f_hasta"]').val(),2);
		calcular_meses($("#f_primero").val());
		const Ameses = {1:"Enero",2:"Febrero",3:"Marzo",4:"Abril",5:"Mayo",6:"Junio",7:"Julio",8:"Agosto",9:"Septiembre",10:"Octubre",11:"Noviembre",0:"Diciembre"}
		$("#mes-0 select").on("change",function() {
			var valor = $(this).val();
			var mes = new Date();

			mes.setMonth(valor); //mes
			calcular_meses(mes.getDay()+"/"+mes.getMonth()+"/"+mes.getFullYear());
			mes.setMonth(mes.getMonth() - 1); //mes anterior
			//if(mes.getMonth() == 0) mes.setYear(mes.getFullYear() - 1)
			$("#mes-1").text(Ameses[mes.getMonth()]+" "+((mes.getMonth() == 0) ? mes.getFullYear() - 1 : mes.getFullYear()));
			
			mes.setMonth(mes.getMonth() - 1); //mes anterior
			if(mes.getMonth() == 0) mes.setYear(mes.getFullYear() - 1)
			$("#mes-2").text(Ameses[mes.getMonth()]+" "+mes.getFullYear());
		});
	})
function DatePicker(){
	$(".ppvDatepicker").datepicker({
        dateFormat: 'dd/mm/yy',
        prevText: '<i class="fa fa-chevron-left"></i>',
        nextText: '<i class="fa fa-chevron-right"></i>',
        monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
        monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
        dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
        dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Juv', 'Vie', 'Sáb'],
        dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sá'],
        maxDate: "+0m +0d"
    });
}
function validar_fechas() {
	var desde = $('input[name="f_desde"]').val();
	var hasta = $('input[name="f_hasta"]').val();

	if(desde == "" || hasta == "")
		alert("faltan fechas")
	else
		acumulado(desde,hasta,2);
}
function calcular_meses(primer_dia) {
	console.log(primer_dia)
	$.ajax({
        url: 'ajax/cliente.php',
        type: "post",
        data: {"tipo":"traer_mes","fecha" : primer_dia},
        beforeSend: function() {
        },
        success: function() {
        }
    }).done(function(data){
    	console.log(data)
        var done = JSON.parse(data);
       
        acumulado(done.mes_1_I,done.mes_1_F,4);
        acumulado(done.mes_2_I,done.mes_2_F,3);
        acumulado(done.mes_0_I,done.mes_0_F,5);
    });
}
function acumulado(desde, hasta, columna) {
	$.ajax({
        url: 'ajax/cliente.php',
        type: "post",
        data: {"tipo":"mes","desde":desde,"hasta":hasta},
        beforeSend: function() {
        },
        success: function() {
        }
    }).done(function(data){
    	console.log(data)
        var done = JSON.parse(data);
        $("#capital_liquidado").find("td:nth-child("+columna+")").text(done.capital_liquidado);
        $("#cuotas_cobradas").find("td:nth-child("+columna+")").text(done.cuotas_cobradas);
        $("#punitorios").find("td:nth-child("+columna+")").text(done.punitorios);
        $("#sueldos").find("td:nth-child("+columna+")").text(done.sueldos);
        $("#muebles").find("td:nth-child("+columna+")").text(done.muebles);
        $("#publicidad").find("td:nth-child("+columna+")").text(done.publicidad);
        $("#varios").find("td:nth-child("+columna+")").text(done.varios);

        $("#resultados").find("td:nth-child("+columna+")").text(done.resultados);

        $("#creditos_liquidados").find("td:nth-child("+columna+")").text(done.creditos_liquidados);
        $("#comercios_adheridos").find("td:nth-child("+columna+")").text(done.comercios_adheridos);
        $("#cantidad_mora").find("td:nth-child("+columna+")").text(done.cantidad_mora);
        $("#renta_comercio").find("td:nth-child("+columna+")").text(done.renta_comercio);
        $("#renta_credito").find("td:nth-child("+columna+")").text(done.renta_credito);

        $("#colocacion").find("td:nth-child("+columna+")").text(done.colocacion);
        $("#capital_promedio").find("td:nth-child("+columna+")").text(done.capital_promedio);
    });
}
</script>
<style>
	.select_mes {
		border:none !important;
		padding: 0;
		font-family: inherit;
		background-color: transparent;
		margin: 0 !important;
		display: block;
		width: 100%;
		height: auto !important;
	}
	.tcontable tr td:nth-child(3),
	.tcontable tr td:nth-child(4) {
		background-color: rgba(0,0,0,0.1)
	}
</style>
<div class="container"> 
	<input type="hidden" value="<?php echo date("t/m/Y"); ?>" id="f_ultimo"/>
	<input type="hidden" value="<?php echo date("01/m/Y"); ?>" id="f_primero"/>
	<div class="panel-a">
		<div class="row panel-title">
			<div class="col-sm-6 col-sm-offset-3" style="border-bottom: 2px solid #769FCD;margin-bottom:20px"><h2 align="center">Informe Contable</h2></div>
		</div>
		<div class="row">
			<div class="col-sm-8 col-sm-offset-2">
				<div class="col-xs-4"><h3 align="right">Fecha</h3></div>
				<div class="col-xs-4"><input class="form-control ppvDatepicker" type="text" name="f_desde" placeholder="Desde"></div>
				<div class="col-xs-4"><input class="form-control ppvDatepicker" type="text" name="f_hasta" placeholder="Hasta" value="<?php echo date("d/m/Y") ?>"></div>
			</div>	
		</div>
        
		<div class="row">
			<div class="col-xs-12">
				<div class="t-centered margin-v10">
					<button class="btn btn-primary btn-md" style="font-size:18px; padding: 5px 35px" onclick="validar_fechas()">Consultar</button>
				</div>
			</div>	
		</div>
		
		<div class="col-xs-12" style="overflow-x: auto; padding:0 20px">
			<table class="table tcontable">
				<thead>
					<tr style="font-weight: 600; background:#ccc;">
						<th></th>
						<th>Acumulado</th>
						<th id="mes-2"><?php echo $Ameses[date("n",strtotime("-2 month"))]." ".date("Y",strtotime("-2 month")) ?></th>
						<th id="mes-1"><?php echo $Ameses[date("n",strtotime("-1 month"))]." ".date("Y",strtotime("-1 month")) ?></th>
						<th id="mes-0"><select class="select_mes"><?php echo $meses; ?></select></th>
					</tr>
				</thead>
				<tbody>
					<tr id="capital_liquidado">
						<td style="color:red">Capital Liquidado</td>
						<td><?php echo money_format('%.2n', $capital_liquidado);?> </td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr id="cuotas_cobradas">
						<td style="color:green">Cuotas Orig Cobradas</td>
						<td><?php echo money_format('%.2n', $cuotas_cobradas);?> </td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr id="punitorios">
						<td style="color:green">Punitorios Cobrados</td>
						<td><?php echo money_format('%.2n', $punitorios);?> </td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr id="sueldos">
						<td style="color:red">Gastos Sueldos</td>
						<td><?php echo money_format('%.2n', $sueldos);?> </td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr id="muebles">
						<td style="color:red">Gastos Muebles</td>
						<td><?php echo money_format('%.2n', $muebles);?> </td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr id="publicidad">
						<td style="color:red">Gastos Publicidad</td>
						<td><?php echo money_format('%.2n', $publicidad);?> </td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr id="varios">
						<td style="color:red">Gastos Varios</td>
						<td><?php echo money_format('%.2n', $varios);?> </td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr id="resultados" style="background: #fff960">
						<td>Resultados</td>
						<td><?php echo money_format('%.2n', $capital_liquidado + $cuotas_cobradas + $punitorios + $sueldos + $muebles + $publicidad + $varios);?> </td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr class="blank_row">
	    				<td colspan="5"></td>
					</tr>
					<tr id="creditos_liquidados">
						<td>Creditos Liquidados</td>
						<td><?php echo $creditos_liquidados;?> </td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr id="comercios_adheridos">
						<td>Comercios Adheridos</td>
						<td><?php echo $comercios_adheridos;?> </td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr id="colocacion">
						<td>Colocacion Por Comercio</td>
						<td><?php echo money_format('%.2n', $colocacion);?> </td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr id="capital_promedio">
						<td>Capital Promedio</td>
						<td><?php echo $capital_promedio;?> </td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr id="cantidad_mora">
						<td>% incobrables</td>
						<td><?php echo money_format('%.2n', $cantidad_mora);?> </td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr class="blank_row">
	    				<td colspan="5"></td>
					</tr>
					<tr id="renta_comercio" style="background: #fff960">
						<td>Renta Bruta Por Comercio</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr id="renta_credito" style="background: #fff960">
						<td>Renta Bruta Por Credito</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
				</tbody>
			</table>
		</div>


					<div class="bottom-btns">
						<a href="/litt/ui/financiera/informesComercio.php"><button class="btn btn-primary btn-lg">Salir</button>
                                                </a>
					
						<button class="btn btn-primary btn-lg" onclick="imprimir();"> <i class="fa fa-file-excel-o" aria-hidden="true"></i> </button>

				</div>

				</div>
		</div>
		

</body>
<script type="text/javascript">
	
    function imprimir() {
    	var datos = {};
    	var capital_liquidado = "", cuotas_cobradas = "",punitorios = "", sueldos = "", muebles = "", publicidad = "", varios = "", resultados = "";
    	var creditos_liquidados = "", comercios_adheridos = "", colocacion = "", capital_promedio = "", cantidad_mora = "";
    	var renta_comercio = renta_credito = "";
    	var elementos_1 = ["capital_liquidado","cuotas_cobradas","punitorios","sueldos","muebles","publicidad","varios","resultados"];
    	var elementos_2 = ["creditos_liquidados","comercios_adheridos","colocacion","capital_promedio","cantidad_mora"];
    	var elementos_3 = ["renta_comercio","renta_credito"];
    	var primero = [],segundo = [],tercero = [];
    	var meses = [];
    	meses.push($("#mes-2").text());
    	meses.push($("#mes-1").text());
    	meses.push($("#mes-0 select option:selected").text())

    	for(var i = 0 ; i < elementos_1.length; i++) {
    		$("#"+elementos_1[i]).find("td").each(function() {
	    		if($(this).index() > 0) {
	    			if(eval(elementos_1[i]) != "")
	    				eval(elementos_1[i] + " += " + "'/'");

	    			eval(elementos_1[i] + " += " + "'" + $.trim($(this).text()) + "'");
	    		}
	    	});
	    	primero.push(eval(elementos_1[i]));
    	}

    	for(var i = 0 ; i < elementos_2.length; i++) {
    		$("#"+elementos_2[i]).find("td").each(function() {
	    		if($(this).index() > 0) {
	    			if(eval(elementos_2[i]) != "")
	    				eval(elementos_2[i] + " += " + "'/'");
	    			eval(elementos_2[i] + " += " + "'" + $.trim($(this).text()) + "'");
	    		}
	    	});
	    	segundo.push(eval(elementos_2[i]));
    	}

    	for(var i = 0 ; i < elementos_3.length; i++) {
    		$("#"+elementos_3[i]).find("td").each(function() {
	    		if($(this).index() > 0) {
	    			if(eval(elementos_3[i]) != "")
	    				eval(elementos_3[i] + " += " + "'/'");

	    			eval(elementos_3[i] + " += " + "'" + $.trim($(this).text()) + "'");
	    		}
	    	});
	    	tercero.push(eval(elementos_3[i]));
    	}
    	
        var page = "ajax/informe_contable.php?primero="+(serialize(primero))+"&segundo="+(serialize(segundo))+"&tercero="+(serialize(tercero))+"&meses="+(serialize(meses));
        descargar(page);
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
</html>

