
function isNum(val){
    return /\D/.test(val);
}

function send(accion,postArgument,callbackOK,callbackFail = null){
    // el get argument va en la direccion, el post argument siempre es un
    // array que se envia via post y del otro lado se descompone, requiere
    // AJAX / JQUERY para funcionar correctamente
    // cuando retornar sea true, el servidor responde con un array con lo 
    // que se le envio, util cuando JS cambia de ambito y se necesita saber
    // a quien se hacia referencia
    url_envio = url_query_local + "?accion=" + accion;
    window.con = $.ajax({
        type: 'POST',
        // make sure you respect the same origin policy with this url:
        // http://en.wikipedia.org/wiki/Same_origin_policy
        url: url_envio,
        async: true,
        data: postArgument,
        success: function(msg){
            // tengo respuesta, envio a callback
            // msg = retArr(msg);
            //console.log(msg);
            callbackOK(msg);
            },
        error: function(msg){
            console.error(msg);
            if(msg.status == 401) // que no esta logueado, redirecciono al login
                window.location.href = "login.html";
            else if(!callbackFail)
                callbackFail(msg);
            }
        });
}

function hrefTo(enlace,elemento = "body"){
    // muestra una nueva pagina sin necesidad de mover la actual, por default
    // el body
    $("#" + elemento).load(enlace);
}

function getSearchParameters() {
    var prmstr = window.location.search.substr(1);
    return prmstr != null && prmstr != "" ? transformToAssocArray(prmstr) : {};
}

function transformToAssocArray( prmstr ) {
    var params = {};
    var prmarr = prmstr.split("&");
    for ( var i = 0; i < prmarr.length; i++) {
        var tmparr = prmarr[i].split("=");
        params[tmparr[0]] = tmparr[1];
    }
    return params;
}

function getCheckedBoxes(chkboxName){
        var checkboxes = document.getElementsByClassName(chkboxName);
        var checkboxesChecked = [];
        // loop over them all
        for (var i=0; i<checkboxes.length; i++) {
            // And stick the checked ones onto an array...
            if (checkboxes[i].checked) {
                checkboxesChecked.push(checkboxes[i]);
            }
        }
        // Return the array if it is non-empty, or null
        return checkboxesChecked.length > 0 ? checkboxesChecked : null;
    }
    
function retFormatDMYBar(en){
    // 2017 12 01
    // 20171201 12 21
    en = String(en);
    if(en.length == 8)
        return en.substring(6,8) + "/" + en.substring(4,6) + "/" + en.substring(0,4);
    else if(en.length == 12)
        return en.substring(6,8) + "/" + en.substring(4,6) + "/" + en.substring(0,4) + " " + en.substring(8,10) + ":" + en.substring(10,12);
}

function preguntarSalida(local){
    if(typeof window.litt_consultar_abandonar !== 'undefined'){
        if(window.litt_consultar_abandonar){
            if(confirm("Esta seguro de querer abandonar esta pagina? perdera " +
                    "todo contenido no guardado")){
                if(local != "back" && (typeof local !== 'undefined'))
                    window.location.href = local;
                else
                    window.history.go(-1);
            }
        } else window.history.go(-1);
    } else window.history.go(-1);
}