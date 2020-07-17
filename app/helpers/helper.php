<?php
// sencilla redirecion a una pagina
function redirect($pagina){
    header('location: '.URLROOT.'/'.$pagina);
}


function activeMenu($url){
    //obtener la url
    $directoryURI = $_SERVER['REQUEST_URI'];
    $path = parse_url($directoryURI, PHP_URL_PATH);
    $components = explode('/', $path);
    //tomamos cada pedazo de url
    $first_part = $components[1];
    $second_part = $components[2];
    $third_part = $components[3];
    // verficamos cada parte
    if($third_part && $third_part == $url){
        return $active = 'active';
    }
    if($second_part  && $second_part == $url){
        return $active = 'active';
    }

    if($first_part  && $first_part == $url && !$second_part && !$third_part){
        return $active = 'active';
    }
   // retornamos
    return $active;
}
