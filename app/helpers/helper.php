<?php
// sencilla redirecion a una pagina
function redirect($pagina){
    header('location: '.URLROOT.'/'.$pagina);
}


function activeMenu($url){
    //obtener la url
    $directoryURI = $_SERVER['REQUEST_URI'];
    $path = parse_url($directoryURI, PHP_URL_PATH);
    
    return $active = ($url == $path) ? 'active' : ''; 
}

function activeMenuArray($urlArray){ //recibo un array
    $directoryURI = $_SERVER['REQUEST_URI'];
    $path = array (parse_url($directoryURI, PHP_URL_PATH));
    $existe = false;
    
    foreach ($urlArray as $value) {// recorro el array de urls
        if (in_array($value, $path)) { //path el valor permitido
            $existe = true;
            break;
        } 
    }
    return $active = $existe  ? 'active' : '';
}

function setCollapseShowArray($urlArray){ //recibo un array
    $directoryURI = $_SERVER['REQUEST_URI'];
    $path = array (parse_url($directoryURI, PHP_URL_PATH));
    $existe = false;
    
    foreach ($urlArray as $value) { // recorro el array de urls
        if (in_array($value, $path)) { //path el valor permitido
            $existe = true;
            break;
        } 
    }
    return $show = $existe  ? 'show' : '';
}

function csrf_token(){
    return md5(uniqid(mt_rand(), true));
}