<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once('../model/database.php');
include_once('./basic.php');

// var_dump($_POST);
function login($user,$pass){
    $u = R::findOne("user","user LIKE ? and pass LIKE ?",[$user,md5($pass)]);
    return $u;
    /*
    $ret = query_ret('select * from user where'
            . ' user = "' . filtro($user) . '" and'
            . ' pass = "' . md5($pass) . '"');
    var_dump($ret->num_rows);
    $login = $ret->num_rows > 0;
    var_dump($login);
    $ret = $ret->fetch_array(MYSQLI_ASSOC);
    
    
    return array(
        "login" => $login,
        "lvl" => $ret['level'],
        "id" => $ret['id']
        );
     */
}



// LOGUEO
if(isset($_POST['user']) && isset($_POST['pass'])){
    // var_dump(login($_POST['user'], $_POST['pass']));
    $r = login($_POST['user'], $_POST['pass']);
    // var_dump($r);
    if($r){
        if(!empty($r["id_comercio"])) {//NULL es financiera
            $com = R::findOne("comercios","id LIKE ?",[$r["id_comercio"]]);
            // var_dump($com);
            if($com["habilitado"]){
                if (session_status() == PHP_SESSION_NONE) {
                    session_start();
                }
                $_SESSION['user'] = $r['user'];
                $_SESSION['lvl'] = $r['level'];
                $_SESSION['id'] = $r['id'];
                $_SESSION['cron'] = 1;
                $_SESSION['id_comercio'] = $r['id_comercio'];
                if(validarUser([0,1,2])){
                    redireccionar(config_financiera::$ui_main_financiera);
                }elseif(validarUser([0,3,4])){
                    redireccionar(config::$ui_main_comercio);
                }
            } echo "Aviso: comercio inhabilitado, contacte con Litt"; // redireccionar(config::$ui_login . "?comercio_inhabilitado");
        } else {
            $_SESSION['user'] = $r['user'];
            $_SESSION['lvl'] = $r['level'];
            $_SESSION['id'] = $r['id'];
            $_SESSION['cron'] = 1;
            $_SESSION['id_comercio'] = 0;
            redireccionar(config_financiera::$ui_main_financiera);  
        } 
    }
    else
        redireccionar(config::$ui_login . "?fail");
}
// DESLOGUEO
if(isset($_GET['logout'])){
    unset($_SESSION["user"]);
    session_destroy();
    redireccionar(config::$ui_login);
}

