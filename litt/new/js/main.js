// configs del sitio
url_query_local = "/litt/new/php/concentrador.php";
url_littMain = "main.html";

/*
 * NOTACIONES: todas las variables de entorno van en window, y comienzan con litt_
 */

function login(user,pass){
    send("login",
    {'user':user,'pass':pass},
    function(msg){
        // si no hubo inconvenientes quiere decir que me loguee correctamente
        if(msg.data["logueo"])
            window.location.href = url_littMain;
        else
            console.log(msg);
    },
    function(msg){
        // no me logueo correctamente, me fijo que haya sido el logueo y no un error
        if(msg.data['logueo'] == false)
            alert('login incorrecto, revise su usuario y contraseña');
    });
}

function logout(){
    send("logout",null,function(msg){
        if(msg.data["logout"]){
            window.location.href = "login.html";
        }
    });
}

function getUserData(){
    send("getUserData",null,function(msg){
        window.msg = msg;
        window.litt_userSession = msg.data['userData'];
    });
}

function credito_getScoreMinimo(){
    send("verazScoreMinimo",null,function(msg){
        window.litt_verazScoreMinimo = msg.data['score']; });
}

function credito_existeCliente(dni,callback){
    
}

function main(){
    // ******** COSAS QUE SE EJECUTAN SIEMPRE ********
    // PONER TODOS LOS INPUT EN MAYUSCULA
    $("input[type=text]").keyup(function(){
        $(this).val( $(this).val().toUpperCase() );
    });
    // PONER TODOS LOS NUMERICOS 
    $(".numerico").keypress(function (e) {
	if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57))
            return false;
    });
    
    $(".flotante").keypress(function (e) {
	if (e.which != 8 && 
		e.which != 0 && 
		e.which != 46 &&
		(e.which < 48 || e.which > 57) )
            return false;
    });
    
    $(".numerico-especial").keypress(function (e) {
        e = e.which;
	if (e != 8 && e != 0 && 
            e != 40 &&
            e != 41 &&
            e != 32 &&
            e != 44 &&
            e != 46 &&
            e != 45 &&
            (e < 48 || e > 57)) // . y -
            return false;
    });
}

// cuando termine de cargar la pagina, lo ejecuto
$(document).ready(function($){
    main();
});