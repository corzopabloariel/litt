<?php
include('./header.php');
?>
<div class="container"> 
	<div class="panel-b col-md-8 col-md-offset-2 col-sm-12 col-sm-offset-0 col-xs-12"">
		<div class="row panel-title">
			<div class="col-sm-3 "></div>
			<div class="col-sm-6" style="border-bottom: 2px solid #769FCD;margin-bottom:20px"><h2 align="center">Convenios</h2></div>
			<div class="col-sm-3"><img src="img/convenios.png"></div>
		</div>
        <div class="" style="overflow-x: auto;">
		<table class="table" style="width: 100%">
			<tr style="font-weight: 600; background:#ccc;">
                            <td>Nombre</td>
                            <td>Grupos Habilitados</td>
                            <td>Comision</td>
                        </tr>
                        
                        <?php
                            $c = R::findAll("convenios");
                            foreach($c as $e){
                        ?>
			<tr>
                            <td><?php echo $e["nombre"]; ?></td>
                            <td><?php
                                // tengo que traer todos los grupos en los que esta
                                $g = R::find("convenios_grupos_habilitados","id_convenio LIKE ?",[$e["id"]]);
                                foreach($g as $eg)
                                    echo R::findOne("grupos","id LIKE ?",[$eg["id_grupo"]])["nombre"] . ", ";
                            ?></td>
                            <td><?php echo $e["comision"]; ?>%</td>
                        </tr>
                        
                        <?php
                            }
                        ?>
                        <!-- 
                        <tr>
                            <td>Convenio B</td>
                            <td>Grupo 1</td>
                            <td>4%</td>
                        </tr>
                        -->
                        
		</table>
    </div>
		<div class="bottom-btns text-center">
			<a href='/litt/ui/financiera/menuPalLitt.php' class="btn btn-primary btn-lg">Volver</a>
            <a href="nuevoConvenio.php" class="btn btn-primary btn-lg">Nuevo Convenio</a>
		</div>

			
		</div>	
		</div>
		</div>
		

</body>
</html>
