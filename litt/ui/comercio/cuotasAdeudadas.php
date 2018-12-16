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
include('./header.php');

function fecha($f) {
    $a = substr($f, 0,4);
    $m = substr($f, 4,2);
    $d = substr($f, 6,2);

    return $d."/".$m."/".$a;
}

?>
<style type="text/css" media="screen">
    td,th {
        vertical-align: middle !important;
        text-align: center !important;
    }
</style>
	<div class="container"> 
		<div class="panel-a col-md-8 col-md-offset-2 col-sm-12 col-sm-offset-0 col-xs-10 col-xs-offset-1">
            <form action="cobrarCuotas3.php" method="POST" id="form" onsubmit="event.preventDefault(); validarForm();">
			<div class="row panel-title">
				<div class="col-sm-3 "></div>
				<div class="col-sm-6" style="border-bottom: 2px solid #769FCD; margin-bottom: 20px"><h2 align="center">Cuotas Adeudadas</h2></div>
				<div class="col-sm-3"></div>
			</div>
			<div class="" style="overflow-x: auto;">
				<table class="table" style="width: 100%">
                    <script>
                        total = 0;
                    </script>
                    <thead>
    					<tr style="font-weight: 600; background:#ccc;">
    						<th>Nro OP</th>
    						<th>Cuota</th>
    						<th>Fe Vto.</th>
    						<th>Cuota Orig</th>
    						<th>Punitorios</th>
    						<th>Cuota Total</th>
    						<th>Estado</th>
    						<th></th>
    					</tr>
                    </thead>
                    <tbody>
                        <?php
                        // busco provisionalmente por dni 
                        
                        include_once($_SERVER['DOCUMENT_ROOT'] . '/litt/controller/basic.php');
                        include_once($_SERVER['DOCUMENT_ROOT'] . '/litt/model/database.php');

                        $in = 0;
                        $arr = [];
                        /**
                         * DIAS DE GRACIA
                         */
                        $dias_gracia = R::findOne("configuraciones","variable LIKE ?",Array("dias_gracia"))["valor"];
                        if(isset($_POST["n_op"])){
                        if($_POST["n_op"] != "")
                            $arr = R::find('cuotas','id_credito LIKE ? AND id_comercio = ?',array($_POST['n_op'],$_SESSION["id_comercio"]));
                        elseif($_POST["dni"] != "")
                            $arr = R::find('cuotas','dni_cliente LIKE ? AND id_comercio = ?',array($_POST['dni'],$_SESSION["id_comercio"]));
                        else
                            echo "NO ha ingresado un dato valido";
                        // envio el id, total es el unico dato que envio
                        $total = 0;
                        foreach($arr as $a){
                            if($a['abonado'] != '1'){
                                $in = 1;
                                if(date("Ymd") - $a['vencimiento'] > $dias_gracia)
                                    $punitorio = round($a['compensatorios'] + $a['punitorios'] + $a['multa']);
                                else $punitorio = 0;
                        ?>
                        <tr>
                            <td><?php echo $a['id_credito'];?></td>
                            <td><?php echo $a['n_cuota'];?></td>
                            <td><?php echo fecha($a['vencimiento']);?></td>
                            <td><?php echo round($a['cuota_original']);?></td>
                            <td><?php echo $punitorio; ?></td>
                            <td><?php echo round($a['cuota_original'] + $punitorio); ?></td>
                            <?php 
                            if($a['estado'] == '0') $estado = "no vencida";
                            else $estado = "vencida"; ?>
                            <td><?php echo $estado;?></td>
                            <td><label><input class="check_estado" name="<?php echo $a['id']; ?>" value="<?php echo $a['id']; ?>" data-credito="<?php echo $a['id_credito']; ?>" type="checkbox" onclick="javascript:
                                if(this.checked) total += <?php echo $a['cuota_original'] + $punitorio; ?>;
                                else total -=  <?php echo $a['cuota_original'] + $punitorio; ?>;
                            document.getElementById('total').innerText = Math.round(total);"><span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span></label></td>
                        </tr>
                    <?php $total += $a['cuota_original'] + $a['compensatorios'] + $a['punitorios'] + $a['multa']; }}} ?>
					</tbody>
				</table>
			</div>
			<div class="row t-centered">
				<h2 align="center">Total a cobrar</h2>
				<h2 align="center">$<span id="total">0</span></h2>
			</div>

			<div class="bottom-btns">
                <div class="btn-group">
                    <a href="<?php echo config::$ui_cobrar_cuotas; ?>" class="btn btn-primary btn-lg">C. CUOTA</a>
                    <?php if($in != 0) { ?>
                        <button style="margin:0" class="btn btn-success btn-lg">COBRAR</button>
                    <?php } ?>
                </div>
			</div>
                    </form>
	</div>
</div>
		
<script>
    function validarForm() {
        var flag = false,flag_cuota = true;
        var creditos = [];
        $(".check_estado").each(function() {
            if(creditos["_"+$(this).data("credito")] == null) creditos["_"+$(this).data("credito")] = [];
            
            if($(this).is(":checked")) {
                creditos["_"+$(this).data("credito")].push({
	            	'cuota': $(this).val(),
	            	'estado': true,
	            });
                flag = true;
            } else {
            	creditos["_"+$(this).data("credito")].push({
	            	'cuota': $(this).val(),
	            	'estado': false,
	            });
            }
        });
        for (var credito in creditos) {
            var i = 1;
            var aux = "";
            for(var cuota in creditos[credito]) {
            	if(aux == "") aux = cuota
            	if(creditos[credito][cuota].estado) {
            		if(creditos[credito][aux].estado) {
	            		aux = "";
	            		i++;
	            	} else i = -1;
            	}
            }
            if(i == -1) {
            	flag_cuota = false;

	            Lobibox.notify("error", {
	                size: 'mini',
	                title: 'Error',
	                msg: 'Cuota anterior del crédito <strong>#'+credito.replace("_","")+'</strong> pendiente de pago',
	                showClass: 'fadeInDown',
	                hideClass: 'fadeUpDown',
	                delay: 10000,
	                sound: false
	            });
            }
        }
        if(flag) {
        	if(flag_cuota)
            	document.getElementById("form").submit();
        } else {
            Lobibox.notify("error", {
                size: 'mini',
                title: 'Error',
                msg: 'No se ha seleccionado ninguna cuota',
                showClass: 'fadeInDown',
                hideClass: 'fadeUpDown',
                delay: 10000,
                sound: false
            });
        }
    }
</script>
</body>
</html>