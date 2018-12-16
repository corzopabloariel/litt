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
?>
	<div class="container"> 
		<div class="panel-a col-md-8 col-md-offset-2 col-sm-12 col-sm-offset-0 col-xs-10 col-xs-offset-1">
			<div class="row panel-title">
				<div class="col-sm-3 "></div>
				<div class="col-sm-6" style="border-bottom: 2px solid #769FCD;margin-bottom:20px"><h2 align="center">Productos</h2></div>
				<div class="col-sm-3"></div>
			</div>
			<label class="t-centered">
			    
			    <?php
                            if(isset($_GET['habilitados'])){
                                ?>
                                <a href="productos.php"><span class="cr" style="color: #000"><i class="cr-icon glyphicon glyphicon-ok"></i></span> Mostrar Solo Habilitados</a><?php
                            }else{
                                ?>
                                <a href="productos.php?habilitados"><span class="cr" style="color: #000"><i class="cr-icon glyphicon glyphicon"></i></span> Mostrar Solo Habilitados</a><?php
                            }
                            
                            ?>
			</label>
			<div class="" style="overflow-x: auto;">
		        <table class="table" style="width: 100%">
					<tr style="font-weight: 600; background:#ccc;">
						<td>Nombre</td>
						<td>Plan</td>
						<td>Grupo</td>
						<td>Monto Min.</td>
						<td>Monto Max.</td>
						<td>Plazo Min.</td>
						<td>Plazo Max</td>
						<td>TNA</td>
						<td>Habilitado</td>
					</tr>
                                        
                                    <?php 
                                        if(isset($_GET['habilitados']))
                                            $p = R::findAll("productos","habilitado LIKE ?",[true]);
                                        else
                                            $p = R::findAll("productos");
                                        
                                        foreach($p as $e){
                                    ?>
                                        <tr>
						<td><?php echo $e["designacion"]; ?></td>
						<td><?php echo R::findOne("planes","id LIKE ?",[$e["plan"]])["designacion"]; ?></td>
						<td><?php echo $e["grupo"]; ?></td>
						<td><?php echo $e["monto_minimo"]; ?></td>
						<td><?php echo $e["monto_maximo"]; ?></td>
						<td><?php echo $e["plazo_minimo"]; ?></td>
						<td><?php echo $e["plazo_maximo"]; ?></td>
						<td><?php echo $e["tna"]; ?></td>
						<td>
                                                    <label class="t-centered">
                                                    <input type="checkbox" class="check" value="<?php echo $e["id"]; ?>" <?php if($e["habilitado"]) echo "checked"; ?>>
                                                    <span class="cr">
                                                    <?php if($e["habilitado"]){
                                                        ?><i class="cr-icon glyphicon glyphicon-ok" onclick="return inhabilitarProducto(<?php echo $e["id"]; ?>);"></i></span><?php
                                                    } else{
                                                        ?><i class="cr-icon glyphicon glyphicon-ok"></i></span><?php
                                                    } ?>
                                                    </label>
						</td>
					</tr>
                                    <?php 
                                        } 
                                    ?>
                                        
					<!-- <tr>
						<td>CEDic16 </td>
						<td>CE</td>
						<td>1</td>
						<td>200.00</td>
						<td>2000.00</td>
						<td>2</td>
						<td>4</td>
						<td>84%</td>
						<td>
							<label class="t-centered">
			    				<input type="checkbox" value="">
			    				<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
							</label>
						</td>
					</tr>
					<tr>
						<td>SEDic16</td>
						<td>SE</td>
						<td>2</td>
						<td>200.00</td>
						<td>2000.00</td>
						<td>2</td>
						<td>4</td>
						<td>127%</td>
						<td>
							<label class="t-centered">
			    				<input type="checkbox" value="">
			    				<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
							</label>
						</td>
					</tr> -->
				</table>
			</div>
			<div class="bottom-btns text-center">
				<a href='/litt/ui/financiera/menuPalLitt.php' class="btn btn-primary btn-lg">Volver</a>
                <a href="nuevoProducto.php" class="btn btn-primary btn-lg">Nuevo Producto</a>
                <a class="btn btn-primary btn-lg" onclick="javascript:habilitarProductos();">Habilitar</a>
			</div>
		</div>
	</div>

<script type="text/javascript">
    
    function habilitarProductos(){
	    e = getCheckedBoxes("check");
	    if(e == null){
	    	Lobibox.notify("error", {
                size: 'mini',
                title: 'Error',
                msg: 'No se ha seleccionado ningún producto',
                showClass: 'fadeInDown',
                hideClass: 'fadeUpDown',
                delay: 10000,
                sound: false
            });
            return false;
	    } else {
	    	$.MessageBox({
	            buttonDone  : "Si",
	            buttonFail  : "No",
	            message     : "¿Esta seguro de habilitar los productos seleccionados?"
	        }).done(function(){
		        envio = {};
		        envio['ids'] = [];
		        console.log(e);
		        for(i = 0; i < e.length; ++i) {
		        	envio['ids'][i] = e[i].value;
		        }
		        send("habilitarProductos",envio,function(msg){
		            if(msg.data["exito"]){
		            	Lobibox.notify("success", {
		                    size: 'mini',
		                    msg: 'Productos habilitados correctamente',
		                    showClass: 'fadeInDown',
		                    hideClass: 'fadeUpDown',
		                    delay: 10000,
		                    sound: false
		                });
		                window.retorno = msg;
		                setTimeout(function() {
		                	window.location.href = window.location.href;
		                },10000);
		            }
		        });
	        }).fail(function(){
	        	return false;
	        });
	    }
    }
    
    function inhabilitarProducto(id){
    	$.MessageBox({
            buttonDone  : "Si",
            buttonFail  : "No",
            message     : "¿Esta seguro de deshabilitar el producto seleccionado?"
        }).done(function(){
	        envio = {};
	        envio['id'] = id;
	        send("inhabilitarProducto",envio,function(msg){
	            if(msg.data["exito"]){
	                Lobibox.notify("success", {
	                    size: 'mini',
	                    msg: 'Productos inhabilitados correctamente',
	                    showClass: 'fadeInDown',
	                    hideClass: 'fadeUpDown',
	                    delay: 10000,
	                    sound: false
	                });
	                window.retorno = msg;
	                setTimeout(function() {
	                	window.location.href = window.location.href;
	                },10000);
	                window.retorno = msg;
	                window.location.href = window.location.href;
	            }
	        });
        }).fail(function(){
        	return false;
        });
    }

</script>

</body>
</html>
