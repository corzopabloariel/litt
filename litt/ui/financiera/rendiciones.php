<?php
$ARR_CSS = array();
$ARR_CSS[] = "/litt/ui/financiera/css/select2.min.css";
$ARR_CSS[] = "/litt/ui/financiera/css/dataTables.jqueryui.css";
$ARR_CSS[] = "/litt/ui/financiera/css/autoFill.jqueryui.css";
$ARR_CSS[] = "/litt/ui/financiera/css/buttons.dataTables.min.css";
$ARR_JS = array();
$ARR_JS[] = "/litt/ui/financiera/js/select2.js";
$ARR_JS[] = "/litt/ui/financiera/js/jquery.dataTables.min.js";
$ARR_JS[] = "/litt/ui/financiera/js/dataTables.autoFill.min.js";
$ARR_JS[] = "/litt/ui/financiera/js/dataTables.buttons.min.js";
$ARR_JS[] = "/litt/ui/financiera/js/buttons.flash.min.js";
$ARR_JS[] = "/litt/ui/financiera/js/jszip.min.js";
$ARR_JS[] = "/litt/ui/financiera/js/pdfmake.min.js";
$ARR_JS[] = "/litt/ui/financiera/js/vfs_fonts.js";
$ARR_JS[] = "/litt/ui/financiera/js/buttons.html5.min.js";
$ARR_JS[] = "/litt/ui/financiera/js/buttons.print.min.js";
include('./header.php');

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
    td, th { vertical-align: middle !important; }
    th { text-align: center; }
</style>
		<div class="container"> 
		<div class="panel-a col-md-8 col-md-offset-2 col-sm-12 col-sm-offset-0 col-xs-10 col-xs-offset-1">
			<div class="row panel-title">
				<div class="col-sm-3 "></div>
				<div class="col-sm-6" style="border-bottom: 2px solid #769FCD;margin-bottom:20px"><h2 align="center">Rendiciones</h2></div>
				<div class="col-sm-3"><img src="img/rendiciones.png"></div>
			</div>

        <form action="rendiciones.php" method="POST">
    		<div class="row" style="padding-top: 5px;">
    			<div class="col-sm-8 col-xs-12">
                    <select name="keyword" style="width: 100%">
                        <option value=""></option>
                    <?php
                    $c = R::findAll("comercios");
                    foreach($c as $e){
                        if(isset($_POST["keyword"]))
                            echo "<option value='{$e["id"]}' ".($_POST["keyword"] == $e["id"] ? "selected" : "").">({$e["id"]}) {$e["nombre"]}</option>";
                        else
                            echo "<option value='{$e["id"]}'>({$e["id"]}) {$e["nombre"]}</option>";
                    }
                    ?>
                    </select>
                    <script>
                        $("select[name='keyword']").select2({
                            placeholder: 'NRO O NOMBRE DE COMERCIO',
                            allowClear: true,
                            width: 'resolve',
                        });
                    </script>
                </div>
    			<div class="col-sm-4 col-xs-12 col-espacio-t">
                    <?php $Aestados = Array(1 => "Todos","Rendido","Pendiente") ?>
                    <select class="form-control" name="estado" style="width: 100%">
                    <?php
                    foreach ($Aestados as $key => $value) {
                        if(isset($_POST["estado"]))
                            echo "<option value='{$key}' ".($_POST["estado"] == $key ? "selected" : "").">{$value}</option>";
                        else
                            echo "<option value='{$key}'>{$value}</option>";
                    }
                    ?>         
                    </select>
                    <script>
                        $("select[name='estado']").select2({
                            placeholder: 'Estado',
                            width: 'resolve',
                        });
                    </script>
                </div>
    		</div>
    		<div class="col-xs-12">
    			<div class="t-centered margin-v10">
    				<button type="submit" class="btn btn-primary btn-md" style="font-size:18px; padding: 5px 35px"> Buscar </button>
    			</div>
    		</div>
        </form>
		<div class="">
			<table class="table table-striped table-hover" style="width:100%;" id="tabla">
                <thead>
    				<tr style="font-weight: 600; background:#ccc;">
    					<th>Id Comercio</th>
                        <th>Nombre Comercio</th>
    					<th>Nº</th>
    					<th>Resultado</th>
    					<th>Monto</th>
    					<th>Estado</th>
    					<th>Fecha</th>
    					<th>Ver</th>
                        <th>Rendicion</th>
    				</tr>
                </thead>
                <tbody id="t_body">
                    <?php
                    
                    // traigo comercio por comercio
                    $flag = false;
                    if(isset($_POST["keyword"])) {
                        if($_POST["estado"] == 1 || $_POST["estado"] == 3) {
                            $flag = true;
                            if (!empty($_POST["keyword"]))
                                $c = R::find("comercios", "id = ?", [$_POST['keyword']]);
                            else
                                $c = R::findAll("comercios");
                        }
                    } else {
                        $flag = true;
                        $c = R::findAll("comercios");
                    }
                    if($flag) {
                    foreach($c as $e){
                        // primero traigo las cuotas que el comercio ya recibio pago
                        // las NO rendidas, ABONADAS y de ESTE COMERCIO
                        $cuotas = R::findAll("cuotas","rendida LIKE ? and abonado LIKE ? and id_comercio LIKE ?",[0,1,$e["id"]]);
                        $cuotas_abonadas = 0;
                        foreach($cuotas as $ec)
                            $cuotas_abonadas += $ec["cuota_original"] + $ec["punitorios"];
                        // traigo el porcentaje de comision del comercio
                        $comision_convenio = R::findOne("convenio","id LIKE ?",[$e["convenio"]])["comision"];
                        // traigo los creditos a pagar al comercio
                        // los LIQUIDADOS y no RENDIDOS
                        $creditos = R::findALl("credito_instancia","liquidado_litt LIKE ? and rendida LIKE ? and id_comercio LIKE ?",[1,0,$e["id"]]);
                        $creditos_liquidados = 0;
                        foreach($creditos as $ecc){
                            $monto = $ecc["monto"] - (($ecc["monto"] /100) * $comision_convenio);
                            $creditos_liquidados += $monto;
                        }
                    ?>
    				<tr>
    					<td><?php echo $e["id"]; ?></td>
    					<td><?php echo $e["nombre"]; ?></td>
    					<td>No asignado</td>
    					<td><?php
                                if($cuotas_abonadas > $creditos_liquidados)
                                    echo "A COBRAR";
                                else
                                    echo "A PAGAR";
                            ?>
                        </td>
    					<td>
                            <?php
                                if($cuotas_abonadas > $creditos_liquidados)
                                    echo ROUND($cuotas_abonadas - $creditos_liquidados);
                                else
                                    echo ROUND($creditos_liquidados - $cuotas_abonadas);
                            ?>
                        </td>
    					<td>Pendiente</td>
    					<td>No asignado</td>
                        <td>
                            <label>
                                <del>
                                    Ver
                                </del>
                            </label>
                        </td>
                        <td>
                            <label>
                                <a href="marcarRendicion.php?id=<?php echo $e["id"]; ?>">
                                marcar
                                </a>
                            </label>
                        </td>
                    </tr>
                    <?php
                        }
                    }
                    $flag = false;
                    if(isset($_POST["keyword"])) {
                        if($_POST["estado"] == 1 || $_POST["estado"] == 2) {
                            $flag = true;
                            if (!empty($_POST["keyword"]))
                                $c = R::find("rendiciones", "id_comercio = ?", [$_POST['keyword']]);
                            else
                                $c = R::findAll("rendiciones");
                        }
                    } else {
                        $flag = true;
                        $c = R::findAll("rendiciones");
                    }
                    if($flag) {
                    foreach($c as $e){
                        $com = R::findOne("comercios","id LIKE ?",[$e["id_comercio"]]);
                    ?>
                    <tr>
    					<td><?php echo $e["id_comercio"]; ?></td>
    					<td><?php echo $com["nombre"]; ?></td>
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
                            <label>
                                <a href="detalleRendicion.php?id=<?php echo $e["id"]; ?>">
                                    Ver
                                </a>
                            </label>
                        </td>
                        <td>
                            <label>
                                <del>
                                    marcar
                                </del>
                            </label>
                        </td>
                    </tr>
                    <?php 
                        }
                    }
                    ?>
                </tbody>
			</table>
		</div>

		<div class="row">
			<div class="bottom-btns bottom-btns-3">
				<!-- <button class="btn btn-primary btn-lg">Anular rendicion</button> -->
				<!-- <button class="btn btn-primary btn-lg">Marcar rendicion</button> -->
				<!--<button class="btn btn-primary btn-lg" onclick="imprimir();"><i class="fa fa-print" aria-hidden="true"></i> Imprimir</button>-->
			</div>
			<div class="bottom-btns">
				<a href="/litt/ui/financiera/menuPalLitt.php" class="btn btn-primary btn-lg" style="margin:0">Volver</a>
			</div>
		</div>
</div>
</div>
<script>
    $(document).ready( function () {
        $('#tabla').DataTable({
            "ordering": false,
            "searching": false,
            dom: 'Bfrtip',
            "scrollX": true,
            lengthMenu: [
                [ 10, 25, 50, -1 ],
                [ '10', '25', '50', 'Todos' ],
            ],
            buttons: [
                {
                    extend: "pageLength",
                    text:   '10 Filas'
                },
                {
                    extend: 'csvHtml5',
                    text:      '<i class="fa fa-file-text-o"></i>',
                    exportOptions: {
                        columns: [ 0, 1, 2, 3, 4, 5, 6 ]
                    },
                    titleAttr: 'CSV',
                    title: 'rendiciones'
                },
                {
                    extend: 'excelHtml5',
                    text:      '<i class="fa fa-file-excel-o"></i>',
                    exportOptions: {
                        columns: [ 0, 1, 2, 3, 4, 5, 6 ]
                    },
                    titleAttr: 'Excel',
                    title: 'rendiciones'
                },
                {
                    extend: 'pdfHtml5',
                    text:      '<i class="fa fa-file-pdf-o"></i>',
                    exportOptions: {
                        columns: [ 0, 1, 2, 3, 4, 5, 6 ]
                    },
                    download: 'open',
                    titleAttr: 'PDF',
                    title: 'rendiciones'
                },
            ],
            "language":{
                buttons: {
                    pageLength: {
                        _: "%d filas",
                        '-1': "Todo"
                    }
                },
                "lengthMenu": "_MENU_ registros por página",
                "info": "Página _PAGE_ de _PAGES_ - _MAX_ registros",
                "infoEmpty": "No hay registros disponibles",
                "infoFiltered": "(filtrada de _MAX_ registros)",
                "loadingRecords": "Cargando...",
                "processing":     "Procesando...",
                "search": "Buscar:",
                "zeroRecords":    "No se encontraron rendiciones",
                "paginate": {
                    "next":       "Siguiente",
                    "previous":   "Anterior"
                },
                "oPaginate": {
                    "sFirst":    "Primero",
                    "sLast":     "Último",
                    "sNext":     "Siguiente",
                    "sPrevious": "Anterior"
                },                
            }
        });
    } );
    
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