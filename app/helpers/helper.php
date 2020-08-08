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

function connected($API){
    return $API->connect(ROUTER_IP, ROUTER_USER, ROUTER_PASS); //constantes tomadas del archivo config/conexionRouter.php
}

 
function generateUserString( $strength = 6) {
    $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

    $input_length = strlen($permitted_chars );
    $randomUserString = '';
    for($i = 0; $i < $strength; $i++) {
        $random_character = $permitted_chars [mt_rand(0, $input_length - 1)];
        $randomUserString .= $random_character;
    }
 
    return $randomUserString;
}

function generateUserPasswordString($strength = 6) {
    $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

    $input_length = strlen($permitted_chars );
    $randomPasswordstring = '';
    for($i = 0; $i < $strength; $i++) {
        $random_character = $permitted_chars [mt_rand(0, $input_length - 1)];
        $randomPasswordstring .= $random_character;
    }
 
    return $randomPasswordstring;
}

function tranformarTiempo($cantidad, $tiempo){
    
    switch ($tiempo) {
        case 'minuto':
            return '00:'.$cantidad.':00';
            break;
        case 'hora':
            return $cantidad.':00:00';
            break;
        case 'dia':
            $total = $cantidad * 24;
            return $total.':00:00';           
            break;
    }
}
