<?php
include('./header.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

function fecha($f) {
    $a = substr($f, 0,4);
    $m = substr($f, 4,2);
    $d = substr($f, 6,2);

    return $d."/".$m."/".$a;
}
?>
<style type="text/css">
    .select2-container--default .select2-selection--single {
        padding: 5px 8px !important;
        height: auto !important;
        border: 2px solid #41719c;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        top: 8px !important;
    }
    .select2-container--default .select2-selection--single .select2-selection__rendered,
    input[type="text"],textarea, select {
        text-transform: uppercase;
    }
    .row {
        margin:0;
    }
</style>
		<div class="container"> 
		<div class="panel-a col-md-8 col-md-offset-2 col-sm-12 col-sm-offset-0 col-xs-10 col-xs-offset-1">
			<div class="row panel-title">
				<div class="col-sm-3 "></div>
				<div class="col-sm-6" style="border-bottom: 2px solid #769FCD;margin-bottom:20px"><h2 align="center">Historial de Rendiciones</h2></div>
				<div class="col-sm-3"><img src="img/rendiciones.png"></div>
			</div>
            <div class="row" style="padding-top: 10px;">
        		<div class="" style="overflow-x: auto;">
        			<table class="table" style="width: 100%">
                        <thead>
            				<tr style="font-weight: 600; background:#ccc;">
            					<th class="text-center">Nº</th>
            					<th class="text-center">Resultado</th>
            					<th class="text-center">Monto</th>
            					<th class="text-center">Estado</th>
            					<th class="text-center">Fecha</th>
            					<th class="text-center">Ver</th>
            				</tr>
                        </thead>
                        <tbody id="t_body">
                            <?php
                            $c = R::find("rendiciones", "id_comercio = ?", [$_SESSION['id_comercio']]);
                            foreach($c as $e){
                                $com = R::findOne("comercios","id LIKE ?",[$e["id_comercio"]]);
                            ?>
                            <tr>
            					<td><?php echo $e["id"]; ?></td>
            					<td>
                                    <?php
                                        if($e["monto_cuota"] > $e["monto_credito"])
                                            echo "A COBRAR";
                                        else
                                            echo "A PAGAR";
                                    ?>
                                </td>
            					<td><?php
                                        if($e["monto_cuota"] > $e["monto_credito"])
                                            echo ROUND($e["monto_cuota"] - $e["monto_credito"]);
                                        else
                                            echo ROUND($e["monto_credito"] - $e["monto_cuota"]);
                                    ?>
                                </td>
            					<td>Rendido</td>
                                <td><?php echo fecha($e["fecha_creacion"]); ?></td>
                                <td>
                                    <a href="detalleRendicion.php?id=<?php echo $e["id"]; ?>" class="btn btn-default btn-xs">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php 
                            }
                            ?>
                        </tbody>
        			</table>
        		</div>
                <div class="row">
                    <div class="bottom-btns">
                        <a class="btn btn-warning btn-lg" href="<?php echo config::$ui_rendiciones; ?>">RENDICIONES</a>
                    </div>
                </div>
            </div>
		<!--<div class="row">
			<div class="bottom-btns bottom-btns-3">
				<button class="btn btn-primary btn-lg">Anular rendicion</button>
				<button class="btn btn-primary btn-lg">Marcar rendicion</button>
				<button class="btn btn-primary btn-lg" onclick="imprimir();"><i class="fa fa-print" aria-hidden="true"></i> Imprimir</button>
			</div>
			<div class="bottom-btns">
				<a href="/litt/ui/financiera/menuPalLitt.php" class="btn btn-primary btn-lg" style="margin:0">Volver</a>
			</div>
		</div>-->
</div>
</div>
<script>
    
    function imprimir() {
        var datos = [];

        $("#t_body").find("tr").each(function() {
            var dato = "";
            $(this).find("td").each(function(){
                if($(this).index() < 7) {
                    if(dato != "")
                        dato += "___";
                    dato += $.trim($(this).text());
                }
            });
            datos.push(dato);
        });
        console.log(serialize(datos))
        var page = "ajax/rendiciones.php?datos="+(serialize(datos));
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
</body>
</html>