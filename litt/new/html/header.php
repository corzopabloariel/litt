<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/litt/controller/basic.php');

?>
<header>
    <div class="col-xs-3 col-sm-6 logo">
        <a href="/litt/ui/comercio/menuPrincipCom.php" onclick="return confirm('esta seguro de abandonar la pagina? perdera todos los datos no guardados');">
            <img src="/litt/ui/comercio/img/logo.png"/>
        </a>
    </div>
		<div class="col-xs-9 col-sm-6 user"><span class="user-name">
                        <?php echo $_SESSION['user']; ?>
                        <i class="fa fa-caret-down user-options" aria-hidden="true"></i></span></div>
		<div class="user-panel">
			<span class="user-pass">Cambiar Contraseña</span>
                        <span class="logout"><a href="<?php echo config::$controller_login; ?>?logout">Cerrar Sesión</a></span>
                </div>
</header>

<!-- <header>
    <div class="col-xs-3 col-sm-6 logo">
        <a href="/litt/ui/comercio/menuPrincipCom.php" onclick="return confirm('esta seguro de abandonar la pagina? perdera todos los datos no guardados');">
            <img src="/litt/ui/comercio/img/logo.png"/>
        </a>
    </div>
    <div class="col-xs-9 col-sm-6 user"><span class="user-name">
        usuario
        <i class="fa fa-caret-down user-options" aria-hidden="true"></i></span></div>
    <div class="user-panel">
        <span class="user-pass">Cambiar Contraseña</span>
        <span class="logout"><a href="">Cerrar Sesión</a></span>
    </div>
</header> -->