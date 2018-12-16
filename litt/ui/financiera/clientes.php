<?php
$ARR_CSS = array();
$ARR_CSS[] = "/litt/ui/financiera/css/select2.min.css";
$ARR_CSS[] = "/litt/ui/financiera/css/dataTables.jqueryui.css";
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
?>
<style type="text/css">
    .select2-container--default .select2-selection--single,
    .select2-container--default.select2-container--focus .select2-selection--multiple,
    .select2-container--default .select2-selection--multiple {
        padding: 5px 8px !important;
        height: auto !important;
        border: 2px solid #41719c;
    }
    .select2-container--default input {
        height: auto !important
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        top: 8px !important;
    }
    .select2-container--default .select2-selection--single .select2-selection__rendered,
    input[type="text"],textarea, select {
        text-transform: uppercase;
    }
    td {
        vertical-align: middle !important;
    }
</style>
<div class="container"> 
    <div class="panel-a col-md-8 col-md-offset-2 col-sm-12 col-sm-offset-0 col-xs-10 col-xs-offset-1">

            <div class="row panel-title">
                    <div class="col-sm-6 col-sm-offset-3" style="border-bottom: 2px solid #769FCD;margin-bottom:20px"><h2 align="center">Clientes</h2></div>
                    <div class="col-sm-3"></div>
            </div>

            <form action="clientes.php" method="POST" id="buscador">
                <div class="row" style="">
                    <div class="col-sm-9 col-xs-12 col-espacio-b">
                        <select name="keyword" id="" style="width: 100%">
                            <option value=""></option>
                            <?php
                            $clientes = R::findAll("clientes");
                            foreach ($clientes as $cliente) {
                                if(isset($_POST["keyword"]))
                                    echo "<option " . ($_POST["keyword"] == $cliente["dni"] ? 'selected' : '') . " value='{$cliente["dni"]}'>{$cliente["id"]} - {$cliente["apellido"]}, {$cliente["nombre"]} ({$cliente["dni"]})</option>";
                                else
                                    echo "<option value='{$cliente["dni"]}'>{$cliente["id"]} - {$cliente["apellido"]}, {$cliente["nombre"]} ({$cliente["dni"]})</option>";
                            }
                            ?>
                        </select>
                        <script>
                            $("select[name='keyword']").select2({
                                placeholder: 'NRO, DNI O NOMBRE DE CLIENTE',
                                allowClear: true,
                                width: 'resolve',
                            })
                        </script>
                    </div>
                    <div class="col-sm-3 col-xs-12">
                        <select class="form-control" name="modulo" style="width: 100%">
                            <option value=""></option>
                            <?php 
                            $mod = R::findAll("estado_mora");
                            foreach ($mod as $m) {
                            	if(isset($_POST["modulo"]))
                            		echo "<option " . ($_POST["modulo"] == $m["id"] ? 'selected' : '') . " value='{$m["id"]}'>{$m["designacion"]}</option>";
                            	else
	                                echo "<option value='{$m["id"]}'>{$m["designacion"]}</option>";
                            }
                            ?>
                        </select>
                        <script>
                            $("select[name='modulo']").select2({
                                placeholder: 'MODULO',
                                allowClear: true,
                                width: 'resolve',
                            })
                        </script>
                    </div>
                </div>
                <div class="row col-espacio-t">
                    <div class="col-xs-12">
                        <select class="js-example-basic-multiple js-states form-control" name="comercio" style="width: 100%">
                            <option></option>
                            <?php 
                            $comercios = R::findAll("comercios");
                            foreach ($comercios as $comercio) {
                                if(isset($_POST["comercio"]))
                                    echo "<option " . ($_POST["comercio"] == $comercio["id"] ? 'selected' : '') . " value='{$comercio["id"]}'>{$comercio["nombre"]}</option>";
                                else
                                    echo "<option value='{$comercio["id"]}'>{$comercio["nombre"]}</option>";
                            }
                            ?>
                        </select>
                        <script>
                            $("select[name='comercio']").select2({
                                placeholder: 'COMERCIO',
                                allowClear: true,
                                width: 'resolve',
                            })
                        </script>
                    </div>
                </div>
                <div class="col-xs-12">
                        <div class="t-centered margin-v10">
                                <button class="btn btn-primary btn-md" style="font-size:18px; padding: 5px 35px">Buscar</button>
                        </div>
                </div>
            </form>

            <form action="operaciones.php" method="post" id="form" onsubmit="event.preventDefault(); validarForm();">
            <div class="">
                <table class="table table-striped table-hover" style="width:100%;" id="tabla">
                    <thead>
                        <tr style="font-weight: 600; background:#ccc;">
                            <th class="text-center">Nro. Cliente</th>
                            <th class="text-center">Nombre Completo</th>
                            <th class="text-center">Créditos Cancelados</th>
                            <th class="text-center">Créditos Vigentes</th>
                            <th class="text-center">Módulo</th>
                            <th class="text-center">Max. Atraso</th>
                            <th class="text-center">Datos</th>
                        </tr>
                    </thead>
                    <tbody id="tbody">
                <?php
                    $Aclientes = Array();
                    if(isset($_POST["comercio"]) && !empty($_POST["comercio"])) {
                        //echo count($_POST["comercio"]);
                        $cuotas_canceladas = R::findAll("cuotas","id_comercio = ?",Array($_POST["comercio"]));

                        foreach ($cuotas_canceladas as $cu) {
                            if(!in_array($cu["dni_cliente"], $Aclientes)) $Aclientes[] = $cu["dni_cliente"];
                        }
                        $clientes = "";
                        foreach ($Aclientes as $c) {
                            if(!empty($clientes)) $clientes .= ",";
                            $clientes .= $c;
                        }
                        if($clientes != "") {
                            if(isset($_POST["keyword"]) && !empty($_POST["keyword"]))
                                $c = R::getAll( 'SELECT C.id,C.nombre,C.apellido,C.dni,GROUP_CONCAT(DISTINCT CU.id_comercio) AS comercios,C.credito_vigente,C.estado_mora,C.atraso_historico FROM clientes AS C JOIN cuotas AS CU ON (CU.dni_cliente = C.dni) WHERE C.dni IN (' . $clientes . ') ' . (empty($_POST["modulo"]) ? '' : 'AND C.estado_mora = '.$_POST["modulo"].' ') . 'AND dni = ? GROUP BY C.dni',Array($_POST["keyword"]) );
                            else
                                $c = R::getAll( 'SELECT C.id,C.nombre,C.apellido,C.dni,GROUP_CONCAT(DISTINCT CU.id_comercio) AS comercios,C.credito_vigente,C.estado_mora,C.atraso_historico FROM clientes AS C JOIN cuotas AS CU ON (CU.dni_cliente = C.dni) WHERE C.dni IN (' . $clientes . ') ' . (empty($_POST["modulo"]) ? '' : 'AND C.estado_mora = '.$_POST["modulo"].' ') . 'GROUP BY C.dni' );
                        } else $c = Array();
                    } elseif(isset($_POST["keyword"]) && !empty($_POST["keyword"])) {
                        $c = R::getAll( 'SELECT C.id,C.nombre,C.apellido,C.dni,GROUP_CONCAT(DISTINCT CU.id_comercio) AS comercios,C.credito_vigente,C.estado_mora,C.atraso_historico FROM `clientes` AS C JOIN cuotas AS CU ON (CU.dni_cliente = C.dni) WHERE C.dni = ? ' . (empty($_POST["modulo"]) ? '' : 'AND C.estado_mora = '.$_POST["modulo"].' ') . 'GROUP BY C.dni',Array($_POST["keyword"]) );
                    } elseif(isset($_POST["modulo"]) && !empty($_POST["modulo"])) {
                        $c = R::getAll( 'SELECT C.id,C.nombre,C.apellido,C.dni,GROUP_CONCAT(DISTINCT CU.id_comercio) AS comercios,C.credito_vigente,C.estado_mora,C.atraso_historico FROM `clientes` AS C JOIN cuotas AS CU ON (CU.dni_cliente = C.dni) WHERE C.estado_mora = ? GROUP BY C.dni',Array($_POST["modulo"]) );
                    } else
                        $c = R::getAll( 'SELECT C.id,C.nombre,C.apellido,C.dni,GROUP_CONCAT(DISTINCT CU.id_comercio) AS comercios,C.credito_vigente,C.estado_mora,C.atraso_historico FROM `clientes` AS C JOIN cuotas AS CU ON (CU.dni_cliente = C.dni) GROUP BY C.dni' );
                    
                    foreach ($c as $u){
                        $Aempresas = Array();
                        $empresas = "";
                        $cuotas_canceladas = R::findAll("cuotas","dni_cliente = ?",Array($u["dni"]));
                        foreach ($cuotas_canceladas as $cu) {
                            if(!in_array($cu["id_comercio"], $Aempresas)) $Aempresas[] = $cu["id_comercio"];
                        }
                        foreach ($Aempresas as $e) {
                            if(!empty($empresas))
                                $empresas .= ' ';
                            $empresas .= "data-empresa-{$e}";
                        }
                ?>
                            <tr data-id="<?php echo $u["id"]; ?>" <?php echo $empresas; ?>>
                                    <td><?php echo $u["id"]; ?></td>
                                    <td><?php echo strtoupper($u["apellido"] . ", " . $u["nombre"]); ?></td>
                                    <td>
                                        <?php
                                        $total = 0;
                                        if(isset($_POST["comercio"]) && !empty($_POST["comercio"])) {
                                            $cuotas_canceladas = R::getAll("SELECT MIN(cu.abonado) AS creditos_cancelados FROM credito_instancia AS ci JOIN cuotas AS cu ON (ci.id = cu.id_credito) WHERE ci.dni_cliente = ? AND ci.abonado = 1 AND ci.id_comercio = ? GROUP BY ci.dni_cliente,ci.id",Array($u["dni"],$_POST["comercio"]));
                                        }
                                        else {
                                            $cuotas_canceladas = R::getAll("SELECT MIN(cu.abonado) AS creditos_cancelados FROM credito_instancia AS ci JOIN cuotas AS cu ON (ci.id = cu.id_credito) WHERE ci.dni_cliente = ? GROUP BY ci.dni_cliente,ci.id",Array($u["dni"]));
                                        }
                                        foreach ($cuotas_canceladas as $c) {
                                            $total += $c["creditos_cancelados"];
                                        }
                                        echo $total;
                                        ?>
                                    </td>
                                    <td><?php echo $u["credito_vigente"] ?></td>
                                    <td><?php 
                                    $j = R::findOne('estado_mora','id LIKE ?', array($u['estado_mora']));
                                    echo $j['designacion'];
                                    ?></td>
                                    <td><?php
                                    $cuo = R::findAll("cuotas","abonado LIKE ? AND dni_cliente LIKE ?",[0,$u["dni"]]);
                                    $max_dif = 0;
                                        foreach($cuo as $c){
                                            // reviso cada vencimiento y en base a eso determino el estado
                                            $t = strtotime($c["vencimiento"]); // vencimiento mas viejo no abonado
                                            $n = time(); // hoy
                                            $dif = round(($n - $t) / (60*60*24)); // dias diferencia 

                                            if($max_dif < $dif) $max_dif = $dif;
                                        }
                                        echo $max_dif;
                                    ?></td>
                                    <td>
                                        <a class="btn btn-default btn-xs" href="datosCliente.php?id=<?php echo $u["id"]; ?>"><i class="fas fa-eye"></i></a>
                                        <label class="btn btn-link btn-xs">
                                            <input type="checkbox" class="check_estado" name="<?php echo $u["id"]; ?>" value="<?php echo $u["id"]; ?>">
                                            <span class="cr" style="margin:0;"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                        </label>
                                    </td>
                            </tr>
                <?php } ?>
                            <!-- <tr>
                                    <td>0047</td>
                                    <td>Perez Juan</td>
                                    <td>0</td>
                                    <td>1</td>
                                    <td>Normal</td>
                                    <td>0</td>
                                    <td>
                                            <label>Ver
                                        <input type="checkbox" value="">
                                        <span class="cr" style="float:right; margin-left: 10px"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                    </label>
                                    </td>
                            </tr> -->
                        </tbody>
                    </table>
            </div>

            <div class="bottom-btns botom-btns3 text-center">
                    <a href='/litt/ui/financiera/menuPalLitt.php' class="btn btn-primary btn-lg">Volver</a>
                    <button type="submit" class="btn btn-primary btn-lg" id="operaciones">Ver operaciones</button>
                    <!-- <button class="btn btn-primary btn-lg">Impresora</button> -->
            </div>
        </form>


    </div>
    </div>	
    </div>
    </div>
		

</body>
<script>
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
            Lobibox.notify("error", {
                size: 'mini',
                title: 'Error',
                msg: 'No se ha seleccionado ninguna operación',
                showClass: 'fadeInDown',
                hideClass: 'fadeUpDown',
                delay: 10000,
                sound: false
            });
        }
    }
	$(document).ready( function () {
	    $('#tabla').DataTable({
	    	"ordering": false,
	    	"searching": false,
            dom: 'Bfrtip',
            "scrollX":true,
            lengthMenu: [
                [ 10, 25, 50, -1 ],
                [ '10', '25', '50', 'Todos' ],
            ],
            buttons: [
                {
                    extend: "pageLength",
                    text:   '10 Filas'
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
				"zeroRecords":    "No se encontraron comercios",
				"paginate": {
					"next":       "Siguiente",
					"previous":   "Anterior"
				},					
			}
	    });
	} );
    
    /*$("#buscador").submit(function(e) {
        e.preventDefault();
        var id = $('*[name="keyword"]').val();
        var comercio = $('*[name="comercio"]').val();

        if(id != "") {
            $("#tbody").find("tr").hide();
            $("#tbody").find('tr[data-id="' + id + '"]').show()
        } else {
            $("#tbody").find("tr").show();
        }
        console.log(comercio)

        return false;
    })*/
</script>
</html>
