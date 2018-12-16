<?php
include('./header.php');


function fecha($f) {
    $a = substr($f, 0,4);
    $m = substr($f, 4,2);
    $d = substr($f, 6,2);

    return $d."/".$m."/".$a;
}

?>
	<div class="container"> 
            <form action="cobrarCuota4.php" method="POST">
		<div class="panel-a col-md-8 col-md-offset-2 col-sm-12 col-sm-offset-0 col-xs-10 col-xs-offset-1">
			<div class="row panel-title">
				<div class="col-sm-6 col-sm-offset-3 col-xs-12" style="border-bottom: 2px solid #769FCD; margin-bottom: 20px"><h2 align="center">Cobrar Cuotas</h2></div>
			</div>
			<div class="col-xs-12" style="overflow-x: auto; padding:0">
				<table class="table" style="width: 100%">
					<thead> 
						<tr style="font-weight: 600; background:#ccc;">
							<th>Nro Op</th>
							<th>Nro Cuota</th>
							<th>Fe Vto.</th>
							<th>Monto</th>
						</tr>
                    </thead>
                    <tbody>
                        <?php
                        // busco provisionalmente por dni 
                        
                        include_once($_SERVER['DOCUMENT_ROOT'] . '/litt/controller/basic.php');
                        include_once($_SERVER['DOCUMENT_ROOT'] . '/litt/model/database.php');

                        // var_dump($_POST);
                        $total = 0;
                        $dias_gracia = R::findOne("configuraciones","variable LIKE ?",Array("dias_gracia"))["valor"];
                        foreach($_POST as $k => $v){
                            $a = R::findOne('cuotas','id LIKE ?',array($v));
                            if(date("Ymd") - $a['vencimiento'] > $dias_gracia)
                            	$punitorio = round($a['compensatorios'] + $a['punitorios'] + $a['multa']);
                            else $punitorio = 0;
                            $total += round($a['cuota_original'] + $punitorio);
                        ?>
						<tr>
	                        <input type="hidden" name="<?php echo $a['id']; ?>" value="<?php echo $a['id']; ?>" />
							<td><?php echo $a['id_credito']; ?></td>
							<td><?php echo $a['n_cuota']; ?></td>
							<td><?php echo fecha($a['vencimiento']); ?></td>
							<td><?php echo round($a['cuota_original'] + $punitorio);?></td>
						</tr>
                        <?php } ?>
					</tbody>
				</table>
			</div>
			<div class="row t-centered">
				<h2 align="center">$<span><?php echo $total; ?></span></h2>
			</div>

			<div class="bottom-btns">
				<div class="btn-group">
	                <a href="<?php echo config::$ui_main_comercio; ?>" style="color: #FFFFFF;" class="btn btn-danger btn-lg">MENU</a>
					<button style="margin: 0" class="btn btn-success btn-lg">ACEPTAR</button>
				</div>
			</div>
            </form>
	</div>
</div>
		

</body>
</html>