<?php
include('./header.php');
$com = R::findOne("comercios","id LIKE ?",[$_SESSION["id_comercio"]]);
$comision = R::findOne("convenios","id LIKE ?",[$com["convenio"]])["comision"];
?>
	<div class="container"> 
		<div class="panel-a col-md-8 col-md-offset-2 col-sm-12 col-sm-offset-0 col-xs-10 col-xs-offset-1">
			<div class="row panel-title">
				<div class="col-sm-6 col-sm-offset-3" style="border-bottom: 2px solid #769FCD;margin-bottom:20px"><h2 align="center">Rendiciones</h2></div>
				<div class="col-sm-3"><img style="width:40%" src="img/rendiciones.png"></div>
			</div>
            <?php $r = R::findAll("rendiciones","id_comercio LIKE ?",array($_SESSION["id_comercio"])); $proxima = count($r) + 1; ?>
			<div class="col-xs-12"><h4 align="center">Próxima Rendición # <span><?php echo $proxima ?></span></h4></div>
				<table class="table" style="width: 100%">
					<tr style="font-weight: 600; background:#ccc;">
                        <td>Créditos liquidados a cobrar</td>
                    </tr>
                    <?php
                    
                    include_once($_SERVER['DOCUMENT_ROOT'] . '/litt/controller/basic.php');
                    include_once($_SERVER['DOCUMENT_ROOT'] . '/litt/model/database.php');

                    $in = 0;
                    $arr = R::find('credito_instancia','rendido = 0 AND id_comercio = ? AND liquidado_litt = 1',array($_SESSION["id_comercio"]));
                    // envio el id, total es el unico dato que envio
                    $total_credito = count($arr);
                    $total_liquidado = 0;
                    $total_noliquidado = 0;
                    $otorgamiento = R::findOne("configuraciones","variable LIKE ?",Array("gastos_otorgamiento"))["valor"];
                    foreach($arr as $a){
                        // si esta liquidado entonces liquidado_litt = 1
                        $total_liquidado += $a["monto"] - (($a["monto"] /100) * $comision) - $otorgamiento;
                    }
                    ?>
					<tr>
                        <td> <?php echo "{$total_credito} -- $ ".number_format($total_liquidado,0,',','.'); ?></td>
                    </tr>
				</table>

				<table class="table" style="width: 100%">
					<tr style="font-weight: 600; background:#ccc;">
                        <td>Cuotas cobradas a rendir </td>
                    </tr>
                    <?php
                    $dias_gracia = R::findOne("configuraciones","variable LIKE ?",Array("dias_gracia"))["valor"];
                    $arr = R::findAll('cuotas',"rendida = ? AND id_comercio = ? AND abonado = 1",array(0,$_SESSION["id_comercio"]));
                    $total_cuotas = count($arr);
                    $total_cobrado = 0;
                    $total_arecibir = 0;
                    foreach($arr as $a){
                        if($a['fecha_depago'] - $a['vencimiento'] > $dias_gracia)
                            $punitorio = round($a['compensatorios'] + $a['punitorios'] + $a['multa']);
                        else $punitorio = 0;
                        $total_cobrado += round($a["cuota_original"] + $punitorio);
                    }
                    ?>
					<tr>
                        <td><?php echo "{$total_cuotas} -- $ ".number_format($total_cobrado,0,',','.'); ?></td>
                    </tr>

				</table>
                <span>
                    <?php
                        //$arr = R::find('cuotas','abonado LIKE 0');
                        if($total_liquidado > $total_cobrado){
                            ?>
                            <h3 align="center" style="color:green;font-weight:600">
                            <?php echo "A COBRAR $ " . number_format(($total_liquidado - $total_cobrado),0,',','.');
                        }
                        else {
                            ?>
                            <h3 align="center" style="color:blue;font-weight:600">
                            <?php echo "A PAGAR $ " . number_format(($total_cobrado - $total_liquidado),0,',','.');
                        }
                    ?>
                	</h3>
                </span>
				<div class="bottom-btns bottom-btns-3 text-center">	
                    <div class="btn-group">
                        <a href="<?php echo config::$ui_main_comercio; ?>" class="btn btn-primary btn-lg">MENU</a>
                        <a href="<?php echo config::$ui_detalles; ?>" style="padding-left: 10px; padding-right: 10px;" class="btn btn-success btn-lg">DETALLE</a>
                        <a href="<?php echo config::$ui_historial; ?>" title="Historial" class="btn btn-warning btn-lg">HISTORIAL</a>
                    </div>
				</div>



		
</div>
</div>
<script>
    $(document).ready(function() {
      credito_getScoreMinimo();  
    })
    function credito_getScoreMinimo(){
        console.log("D")
        send("verazScoreMinimo",null,function(msg){window.litt_verazScoreMinimo = msg.data['score']; },function(e){console.log(e)});
    }
</script>
</body>
</html>
