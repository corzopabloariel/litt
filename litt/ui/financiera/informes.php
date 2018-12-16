<?php
include('./header.php');
?>
<div class="container"> 
    <div class="panel-c col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">

        <div class="row panel-title">
            <div class="col-sm-6 col-sm-offset-3" style="border-bottom: 2px solid #769FCD;margin-bottom:20px"><h2 align="center">Informes</h2></div>
            <div class="col-sm-3"><img src="img/informes.png"></div>
        </div>

        <div class="text-center">
            <a href="informeMora.php"><button class="btn btn-primary btn-cd">Mora</button></a>
            <a href="informesComercio.php"><button class="btn btn-primary btn-cd">Comercios</button></a>
            <a href="informeContable.php"><button class="btn btn-primary btn-cd">Contable</button></a>
        </div>
        <div class="bottom-btns text-center">
            <a href="./crefile.php" class="btn btn-success btn-lg"><img src="img/xls-w.png" width="50px" style="margin-bottom:6px"><br/>Exportar Crefile</a>
            <a href="./cuofile.php" class="btn btn-success btn-lg col-espacio-t"><img src="img/xls-w.png" width="50px" style="margin-bottom:6px"><br/>Exportar Cuofile</a>
        </div>
        <div class="text-center col-espacio-t">
            <a href='/litt/ui/financiera/menuPalLitt.php' class="btn btn-primary btn-lg">Volver</a>
        </div>

    </div>
</div>

</body>
</html>