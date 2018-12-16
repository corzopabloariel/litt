<?php
include('./header.php');

if($_SESSION["cron"] == 1) {
    $_SESSION["cron"] = 2;
    echo "<script>cron();</script>";

    echo "<script>log();</script>";
}
?>
	<div class="container">
		<div class="menu col-xs-12 col-sm-10 col-sm-offset-1 col-md-10 col-md-offset-1 col-lg-10 col-lg-offset-1">
			<div class="col-sm-4 col-xs-6">
				<div>
                    <div class="menu-icon">
                        <a href="/litt/ui/financiera/altaComercio.php">
                            <img src="img/comercio.png"><span>Alta Comercio</span>
                        </a>
                    </div>
                </div>
			</div>
			<div class="col-sm-4 col-xs-6">
				<div>
                                    <div class="menu-icon">
                                        <a href="/litt/ui/financiera/comAdheridos.php">
                                        <img src="img/comercios.png"><span>Comercios Adheridos</span>
                                        </a>
                                    </div>
                                </div>
			</div>
			<div class="col-sm-4 col-xs-6">
				<div>
                                    <div class="menu-icon">
                                        <a href="/litt/ui/financiera/liquidarOper.php">
                                        <img src="img/liquidar.png"><span>Liquidar Operaciones</span>
                                        </a>
                                    </div>
                                </div>
			</div>
			<div class="col-sm-4 col-xs-6">
				<div>
                                    <div class="menu-icon">
                                        <a href="/litt/ui/financiera/rendiciones.php">
                                        <img src="img/rendiciones.png">
                                        <span>Rendiciones</span>
                                        </a>
                                    </div>
                                </div>
			</div>
			<div class="col-sm-4 col-xs-6">
				<div>
                                    <div class="menu-icon">
                                        <a href="/litt/ui/financiera/productos.php">
                                        <img src="img/productos.png"><span>Productos</span>
                                        </a>
                                    </div>
                                </div>
			</div>
			<div class="col-sm-4 col-xs-6">
				<div>
                                    <div class="menu-icon">
                                        <a href="/litt/ui/financiera/convenios.php">
                                        <img src="img/convenios.png"><span>Convenios</span>
                                        </a>
                                    </div>
                                </div>
			</div>
			<div class="col-sm-4 col-xs-6">
                            <div>
                                <div class="menu-icon">
                                    <a href="/litt/ui/financiera/clientes.php">
                                    <img src="img/clientes.png"><span>Clientes</span>
                                    </a>
                                </div>
                            </div>
			</div>
			<div class="col-sm-4 col-xs-6">
				<div>
                                    <div class="menu-icon">
                                        <a href="/litt/ui/financiera/informes.php">
                                        <img src="img/informes.png"><span>Informes</span>
                                        </a>
                                    </div>
                                </div>
			</div>
			<div class="col-sm-4 col-xs-6">
				<div>
                                    <div class="menu-icon">
                                        <a href="/litt/ui/financiera/cajaFinanc.php">
                                        <img src="img/caja.png"><span>Caja</span>
                                        </a>
                                    </div>
                                </div>
			</div>
		</div>
	</div>
</body>
</html>