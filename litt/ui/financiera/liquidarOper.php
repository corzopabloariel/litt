<?php
$ARR_CSS = array();
$ARR_CSS[] = "/litt/ui/financiera/css/dataTables.jqueryui.css";
$ARR_CSS[] = "/litt/ui/financiera/css/autoFill.jqueryui.css";
$ARR_CSS[] = "/litt/ui/financiera/css/buttons.dataTables.min.css";
$ARR_JS = array();
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

//, time() + (86400 * 30), "/"

$path_base = $_SERVER['DOCUMENT_ROOT'] ."/litt/ui/comercio/uploads/";
$extension = ".jpg";
$archivos = ["solicitud","desarrollo","dni","servicio","sueldo","terminos"];
$elementos = [];
foreach($archivos as $k)
    $elementos[$k] = $path_base . $k . "_";
?>
<style>
    td,th {
        vertical-align: middle !important;
    }
    th {
        text-align: center;
    }
</style>
<div class="container"> 
	<div class="panel-a col-md-8 col-md-offset-2 col-sm-12 col-sm-offset-0 col-xs-10 col-xs-offset-1">

		<div class="row panel-title">
			<div class="col-sm-3 "></div>
			<div class="col-sm-6" style="border-bottom: 2px solid #769FCD;margin-bottom:20px"><h2 align="center">Liquidar Operaciones</h2></div>
			<div class="col-sm-3"></div>
		</div>
            <form action="liquidarOper.php" method="POST">
		<div class="row"> 
                    <div class="col-xs-12 col-sm-4">
                        <input class="form-control texto-numero" type="tel" name="id"  placeholder="Nro Operacion" value="<?php if(isset($_POST['id'])) echo $_POST['id']; ?>">
                    </div>
                    <div class="col-xs-12 col-sm-4">
                        <select class="form-control" id="comercio" name="comercio">
                            <option value="-1"> Comercios: todos </option>
                            <?php
                                $e = R::findAll("comercios");
                                foreach($e as $r){
                                    if(isset($_POST["comercio"]))
                                        echo "<option value={$r['id']} ".($_POST['comercio'] == $r['id'] ? 'selected' : '').">Comercio: {$r['nombre']}</option>";
                                    else
                                        echo "<option value={$r['id']}>Comercio: {$r['nombre']}</option>";
                                }
                            ?>
                        </select>                       
                    </div>
                    <div class="col-xs-12 col-sm-4">
                        <select class="form-control" name="estado">
                            <option value="-1"> Estado Liquidacion: ambos </option>
                            <?php
                                $e = R::findAll("estado_liquidacion");
                                foreach($e as $r) {
                                    if(isset($_POST["estado"]))
                                        echo "<option value={$r['id']} ".($_POST['estado'] == $r['id'] ? 'selected' : '').">Estado Liquidación: {$r['designacion']}</option>";
                                    else
                                        echo "<option value={$r['id']}>Estado Liquidación: {$r['designacion']}</option>";
                                }
                            ?>
                            
                        </select>
                    </div>
		</div>
            
        <div class="row">
		<div class="col-xs-12">
			<div class="t-centered margin-v10">
				<button type="submit" class="btn btn-primary btn-md" style="font-size:18px; padding: 5px 35px"> Buscar </button>
			</div>
		</div>
        </div>
            </form>
                <?php
                    $c = R::findAll("credito_instancia");
                    if(isset($_POST["estado"])){ $estado = $_POST["estado"]; }
                    if(isset($_POST["id"])){
                        $id = $_POST["id"];
                        if($id != ""){
                            $c = R::find("credito_instancia","id LIKE ?",[$id]); 
                        }else{
                            $comercio = $_POST["comercio"];
                            if($comercio != -1 && $estado == -1) $c = R::find("credito_instancia","id_comercio LIKE ?",[$comercio]);
                            elseif($comercio != -1 && $estado != -1) $c = R::find("credito_instancia","id_comercio LIKE ? and estado_liquidacion LIKE ?",[$comercio,$estado]);
                            elseif($comercio == -1 && $estado != -1) $c = R::find("credito_instancia","estado_liquidacion LIKE ?",[$estado]);
                            else $c = R::findAll("credito_instancia");
                        }
                    }
                ?>
            <div class="row">
			<div class="col-xs-12">
				<table class="table table-striped table-hover" style="width:100%;font-size:13px" id="tabla">
                    <thead>
    					<tr style="font-weight: 600; background:#ccc;">
    						<th>N.º Op</th><th>Nº Cliente</th>
    						<th>DNI</th> <th>Nombre</th>
    						<th>Capital</th><th>Plazo</th>
    						<th>Legajo</th><th>Estado</th>
    					</tr>
                    </thead>
                    <tbody>               
                    <?php
                    foreach($c as $e){
                        $cliente = R::findOne("clientes","dni LIKE ?",[$e["dni_cliente"]]);
                        $estado_liquidacion = R::findOne("estado_liquidacion","id LIKE ?",[$e["estado_liquidacion"]])["designacion"];
                    ?>
					<tr>
						<td><?php echo $e["id"]; ?></td>
                                                <td><?php echo $cliente["id"]; ?></td>
						<td><?php echo $e["dni_cliente"]; ?></td>
                                                <td><?php echo $cliente["apellido"] . ", " . $cliente["nombre"];  ?></td>
						<td><?php echo round($e["monto"]); ?></td>
                                                <td><?php echo $e["cuotas"]; ?></td>
                                                <td><a target="_blank" href="legajo.php?id=<?php echo $e["id"]; ?>"><i class="far fa-file-alt"></i></a></td>
						<td>
                            <label><?php echo $estado_liquidacion; ?>
                            <?php if($e["estado_liquidacion"] == 1){ // si ya se liquido ?>
                                <span class="" style="float:right; margin-left: 10px"><i class="cr-icon glyphicon glyphicon-alert"></i></span>
                            <?php } else {
                                $id = $e["id"];
                                if(file_exists($elementos["solicitud"] . $id . ".jpg") && file_exists($elementos["desarrollo"] . $id . ".jpg") && file_exists($elementos["dni"] . $id . ".jpg") && file_exists($elementos["servicio"] . $id . ".jpg") && file_exists($elementos["sueldo"] . $id . ".jpg") && file_exists($elementos["terminos"] . $id . ".jpg")) {
                                    echo "<input type='hidden' value='{$id}_img'/>";
                                }
                                
                            ?>

                                <input type="checkbox" class="check check_estado" value="<?php echo $e["id"]; ?>">
                            <span class="cr" style="float:right; margin-left: 10px"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                            <?php } ?>
                            </label>
                        </td>
					</tr>
                                    <?php                                    
                                    }
                                    ?>
                                        <!--<tr>
						<td> 1007 </td><td>7</td>
						<td>36506720</td> <td>Yalul,Sofia Yasmin</td>
						<td>$830</td><td>4</td><td><i class="fa fa-file-text-o" aria-hidden="true"></i></td>
						<td><label>Pendiente
				            <input type="checkbox" value="">
				            <span class="cr" style="float:right; margin-left: 10px"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
				        </label></td>
					</tr>-->
                    </tbody>            
				</table>
			</div>
                </div>
			<div class="row">
				<div class="bottom-btns">
					<a href="/litt/ui/financiera/menuPalLitt.php">
                                            <button class="btn btn-primary btn-lg">Volver</button>
                                        </a>
					<button class="btn btn-primary btn-lg" id="liquidar">Liquidar</button>
				</div>
			</div>
		</div>
	</div>
<script type="text/javascript">

    function validarForm() {
        var flag = false; 
        var inputElements = document.getElementsByClassName('check_estado');
        for(var i=0; inputElements[i]; ++i){
              if(inputElements[i].checked){
                   flag = true;
                   break;
              }
        }
        if(flag) {
            document.getElementById("form").submit();
        } else {
            
        }
    }

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
                        columns: [ 0, 1, 2, 3, 4, 5 ]
                    },
                    titleAttr: 'CSV',
                    title: 'liquidar_operaciones'
                },
                {
                    extend: 'excelHtml5',
                    text:      '<i class="fa fa-file-excel-o"></i>',
                    exportOptions: {
                        columns: [ 0, 1, 2, 3, 4, 5 ]
                    },
                    titleAttr: 'Excel',
                    title: 'liquidar_operaciones'
                },
                {
                    extend: 'pdfHtml5',
                    text:      '<i class="fa fa-file-pdf-o"></i>',
                    exportOptions: {
                        columns: [ 0, 1, 2, 3, 4, 5 ]
                    },
                    download: 'open',
                    titleAttr: 'PDF',
                    title: 'liquidar_operaciones'
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
                "zeroRecords":    "No se encontraron registros",
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
    var flag = "";
    $("#liquidar").on("click",function(msg){
        e = getCheckedBoxes("check");
        if(e == null){
            Lobibox.notify("error", {
                size: 'mini',
                title: 'Error',
                msg: 'No se ha seleccionado ninguna operación',
                showClass: 'fadeInDown',
                hideClass: 'fadeUpDown',
                delay: 10000,
                sound: false
            });
            return false;
        }
        ids = [];
        for(i = 0; i < e.length; ++i) {
            var id = e[i].value;
            if($('input[value="'+id+'_img"]').length)
                ids[i] = id;
            else {
                Lobibox.notify("error", {
                    size: 'mini',
                    title: 'Error',
                    msg: 'Debe subir todos los archivos del #'+id,
                    showClass: 'fadeInDown',
                    hideClass: 'fadeUpDown',
                    delay: 10000,
                    sound: false
                });
            }
        }
        if(ids.length > 0) {
            $.MessageBox({
                buttonDone  : "Si",
                buttonFail  : "No",
                message     : "¿Está seguro de liquidar las operaciones seleccionadas?"
            }).done(function(){
                envio = {};
                envio["ids"] = ids;
                send("liquidarOperaciones",envio,function(msg){
                    window.msg = msg;
                    if(msg.data["exito"]){
                        Lobibox.notify("success", {
                            size: 'mini',
                            title: 'Info',
                            msg: 'Las operaciones fueron marcadas como liquidadas exitosamente',
                            delay: 10000,
                            sound: false,
                            onClick: function(){
                                window.location.href = window.location.href;
                            },
                        });
                        recargar();
                    } else {
                        Lobibox.notify("error", {
                            size: 'mini',
                            title: 'Error',
                            msg: 'Hubo un error, reintente o refresque la pagina (<i class="fas fa-sync-alt"></i>)',
                            showClass: 'fadeInDown',
                            hideClass: 'fadeUpDown',
                            delay: false,
                            sound: false,
                            onClick: function(){
                                window.location.href = window.location.href;
                            },
                        });
                    }
                },function(msg){
                    window.msg = msg;
                    Lobibox.notify("error", {
                        size: 'mini',
                        title: 'Error',
                        msg: 'Hubo un error, reintente o refresque la pagina (<i class="fas fa-sync-alt"></i>)',
                        showClass: 'fadeInDown',
                        hideClass: 'fadeUpDown',
                        delay: false,
                        sound: false,
                        onClick: function(){
                            window.location.href = window.location.href;
                        },
                    });
                });
            }).fail(function(){
            });
        }
    });
    function recargar() {
        setTimeout(function() {
            window.location.href = window.location.href;
        },10000);
    }
</script>

</body>
</html>