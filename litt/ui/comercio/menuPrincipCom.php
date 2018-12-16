<?php
include('./header.php');


if($_SESSION["cron"] == 1) {
    $_SESSION["cron"] = 2;

    echo "<script>log();</script>";
}
?>
<div class="container">
    <center><?php
    if(isset($_GET['mensaje'])){
        echo "<br><br><b>" . $_GET['mensaje'] . "</b>";
    }
    ?>
    </center>
        <div class="menu col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3">
                
                <div class="col-sm-6 col-xs-6 col-md-6">
                    <div>
                        <a href="<?php echo config::$ui_nuevo_credito; ?>">
                        <div class="menu-icon">
                            <img src="img/credito.png">
                            <span>Nuevo Crédito</span>
                        </div>
                        </a>
                    </div>
                </div>
                
                <div class="col-sm-6 col-xs-6 col-md-6">
                    <div>
                        <a href="<?php echo config::$ui_cobrar_cuotas; ?>">
                        <div class="menu-icon">
                            <img src="img/cuotas.png">
                            <span>Cobrar Cuotas</span>
                        </div>
                        </a>
                    </div>
                </div>
                
                <div class="col-sm-6 col-xs-6 col-md-6">
                    <div>
                        <a href="<?php echo config::$ui_rendiciones; ?>">
                        <div class="menu-icon">
                            <img src="img/rendiciones.png">
                            <span>Rendiciones</span>
                        </div>
                        </a>
                    </div>
                </div>
                
                <div class="col-sm-6 col-xs-6 col-md-6">
                    <div>
                        <a href="<?php echo config::$ui_listar_clientes; ?>">
                        <div class="menu-icon">
                            <img src="img/clientes.png">
                            <span>Mis Clientes</span>
                        </div>
                        </a>
                    </div>
                </div>

        </div>
    </div>
    <div class="footer">
        <div class="col-xs-6">
            <a href="calcCuotas.php" style="color: #FFFFFF;" class="btn btn-primary btn-lg"><i class="fas fa-calculator"></i> Cuotas</a>
        </div>
        <div class="col-xs-6 text-right">
            <a href="misDatos.php" style="color: #FFFFFF;" class="btn btn-primary btn-lg">Mis datos</a>
        </div>
    </div>
</body>
</html>