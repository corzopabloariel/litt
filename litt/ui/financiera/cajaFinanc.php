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

function fecha($f) {
    $a = substr($f, 0,4);
    $m = substr($f, 4,2);
    $d = substr($f, 6,2);
    $h = substr($f, 8,2);
    $i = substr($f, 10,2);

    return $d."/".$m."/".$a." ".$h.":".$i;
}
?>
<script type="text/javascript">
    $(document).ready(function() { fecha_datepicker(); })
    
    $(".fecha").datepicker().on("change",
        function(ev){
            // quiere decir que eligio una fecha
            window.litt_procesado = true;
            //getRendicionPendiente($("#fecha_rendicion").val());
        });

    function fecha_datepicker(){
        $(".fecha").datepicker({
            dateFormat: 'dd/mm/yy',
            //prevText: '',
            //nextText: '',
            monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
            monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
            dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
            dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Juv', 'Vie', 'Sáb'],
            dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sá'],
            changeMonth: true,
            changeYear: true
        });
    }
</script>
<style type="text/css">
	.ui-resizable-handle.ui-resizable-e{background:red;width:3px;}

.ui-resizable{border:red solid 1px;width:200px}
table td,
table th {
    vertical-align: middle !important;
}
table thead th {
    text-align: center;
}
</style>
<div class="container">
    <div class="panel-a col-md-8 col-md-offset-2 col-sm-12 col-sm-offset-0 col-xs-10 col-xs-offset-1">
        <div class="row"><div class="col-sm-3 "></div><div class="col-sm-6" style="border-bottom: 2px solid #769FCD"><h2 align="center">Caja Financiera</h2></div><div class="col-sm-3"></div></div>
        <form action="cajaFinanc.php" method="POST">
            <div class="row t-centered"> 
                <div class="col-sm-6 col-xs-12"><input class="form-control fecha text-right" type="text" name="desde" id="desde" placeholder="Desde"></div>
                <div class="col-sm-6 col-xs-12"><input class="form-control fecha text-right" type="text" name="hasta" id="hasta" placeholder="Hasta"></div>
            </div>
            <div class="col-xs-12">
                <div class="t-centered margin-v10">
                    <button class="btn btn-primary btn-md" style="font-size:18px; padding: 5px 35px"> Buscar </button>
                </div>
            </div>
        </form>
        <div class="row panel-h-btns">
            <div class="col-xs-6"></div>
            <!-- <div class="col-xs-6"><label><input type="checkbox"><span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Por Situación</label></div>
            <div class="col-xs-6"><label><input type="checkbox"><span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Por Fecha Prox. Liquidación</label></div> -->
        </div>
        <div>
            <table class="table table-striped table-hover" style="width:100%;font-size:13px" id="tabla">
                <thead>
                    <tr style="font-weight: 600; background:#ccc;">
                        <th>Fecha</th>
                        <th>Ingreso/Egreso</th>
                        <th>Tipo Movimiento</th>
                        <th>Entidad</th>
                        <th>Tipo Comprobante</th>
                        <th>Nro Comprobante</th>
                        <th>Monto</th>
                        <th>IVA</th>
                        <th>Detalle</th>
                    </tr>
                </thead>
                <tbody id="t_body">
                    <?php
                    if(isset($_POST["desde"]) && isset($_POST["hasta"])){
                        // son ISO 8601 con horario, les tengo que agregar las horas y minutos
                        list($d,$m,$a) = explode("/", $_POST["desde"]);
                        $desde = $a.$m.$d. "0000";
                        list($d,$m,$a) = explode("/", $_POST["hasta"]);
                        $hasta = $a.$m.$d. "2359";
                        $r = R::findAll("registro_pago","fecha_hora BETWEEN ? AND ? ORDER BY id DESC",[$desde,$hasta]);
                    }else{ 
                        $r = R::findAll("registro_pago","ORDER BY id DESC");
                    }
                    $total = 0;
                    foreach($r as $e){
                        $tipo_movimiento = R::findOne("tipo_movimiento","id LIKE ?",[$e["id_movimiento"]])["nombre"];
                    ?>
                    <tr>
                        <td><?php echo fecha($e["fecha_hora"]); ?></td>
                        <td><?php if($e["ingreso_egreso"]){
                                echo "ingreso"; $total += $e["monto"];
                            } else {
                                echo "egreso"; $total -= $e["monto"];
                                }?></td>
                        <td><?php
                        if(strtoupper($tipo_movimiento) == "RENDICION") echo ($e["ingreso_egreso"]) ? "CUOTA COBRADA" : "CREDITO PAGADO";
                        else echo $tipo_movimiento;
                        ?></td>
                        <td><?php
                        if(strtoupper($tipo_movimiento) == "RENDICION") echo R::findOne("comercios","id LIKE ?",Array($e["id_entidad"]))["nombre"];
                        else
                        echo R::findOne("entidades","id LIKE ?",[$e["id_entidad"]])["denominacion"];
                        ?></td>
                        <td><?php echo R::findOne("tipo_comprobante","id LIKE ?",[$e["id_tipo_comprobante"]])["nombre"]; ?></td>
                        <td><?php echo $e["numero_comprobante"]; ?></td>
                        <td><?php echo ROUND($e["monto"]); ?></td>
                        <td><?php echo ROUND($e["iva"]); ?></td>
                        <td><a target="_blank" href="/litt/ui/financiera/verCaja.php?id=<?php echo $e['id']; ?>">Ver</a></td>
                    </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
        
        <span>
            <?php if($total > 0) { ?>
            <h3 align="center" style="color:green;font-weight:600" class ="total">
                total  $ <span><?php echo ROUND($total); ?></span>
            </h3>
            <?php } else { ?>
            <h3 align="center" style="color:red;font-weight:600" class ="total">
                total  $ <span><?php echo ROUND($total); ?></span>
            </h3>
            <?php } ?>
        </span> 
        <div class="row">
            <div class="col-sm-12 col-xs-12 text-center">
                <a href="/litt/ui/financiera/menuPalLitt.php">
                    <button class="btn btn-primary btn-lg"> Volver </button>
                </a>
                <!-- <button class="btn btn-primary btn-lg"> Imprimir</button> -->
                <a href="nuevoPago.php"><button class="btn btn-primary btn-lg"> Cargar Pagos</button></a>
                <a href="nuevoTipoMovimiento.php"><button class="btn btn-primary btn-lg"> Crear Tipo Movimiento</button></a>
                <a href="nuevaEntidad.php"><button class="btn btn-primary btn-lg"> Crear Entidad</button></a>
                <!--<button class="btn btn-primary btn-lg" onclick="imprimir();"> <i class="fa fa-file-excel-o" aria-hidden="true"></i> </button>-->
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    
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
                {
                    extend: 'csvHtml5',
                    text:      '<i class="fa fa-file-text-o"></i>',
                    exportOptions: {
                        columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]
                    },
                    titleAttr: 'CSV',
                    title: 'caja_financiera'
                },
                {
                    extend: 'excelHtml5',
                    text:      '<i class="fa fa-file-excel-o"></i>',
                    exportOptions: {
                        columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]
                    },
                    titleAttr: 'Excel',
                    title: 'caja_financiera'
                },
                {
                    extend: 'pdfHtml5',
                    text:      '<i class="fa fa-file-pdf-o"></i>',
                    exportOptions: {
                        columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]
                    },
                    download: 'open',
                    titleAttr: 'PDF',
                    title: 'caja_financiera'
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

    function imprimir() {
        var datos = [];

        $("#t_body").find("tr").each(function() {
            var dato = "";
            $(this).find("td").each(function(){
                if($(this).index() != 8) {
                    if(dato != "")
                        dato += "___";
                    dato += $(this).text();
                }
            });
            datos.push(dato);
        });
        console.log((datos))
        var page = "ajax/caja_financiera.php?datos="+(serialize(datos));
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