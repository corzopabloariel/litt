/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */





function verificar(){
    campos = [
        ['n','dni'],
        ['n','score'],
        ['t','name']
        
    ];
    for(i = 0; i < campos.length; ++i){
//        alert("o " + i);
        if(!validateTypoName(campos[i][0],campos[i][1])) 
            return false;
    }
    return true;
        
}

function validateTypoName(tipo,nombre){
    // recorre todos los elementos llamados "nombre"y si cumplen con 
    // el tipo evaliado
    c = document.getElementsByName(nombre);
    // no existe, no interrumpo
    if(c == undefined) return true;
    for(i = 0; i < c.length; ++i){
  //      alert("p " + i);
        val = c[i].value;
        if(val.trim() == "") return alertaSalir(c[i]);
        if((tipo =="n") & (isNum(val))) return alertaSalir(c[i]);
        if((tipo =="t") & (!isNum(val))) return alertaSalir(c[i]);
    }
    return true;
}   

function alertaSalir(e){
    alert("el campo " +  e.name + " parece estar vacio o tiene datos invalidos");
    return false;
}

function isNum(val){
    return /\D/.test(val);
}


