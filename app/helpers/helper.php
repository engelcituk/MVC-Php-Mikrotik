<?php
// sencilla redirecion a una pagina
function redirect($pagina){
    header('location: '.URLROOT.'/'.$pagina);
}


function activeMenu($url){
    //obtener la url
    $base = '/base';
    $directoryURI = $_SERVER['REQUEST_URI'];
    $path = parse_url($directoryURI, PHP_URL_PATH);
    
    

    return $path   ;
   // retornamos
   // return $second_part;
}

function setCollapseShow($url){
    //obtener la url
    $directoryURI = $_SERVER['REQUEST_URI'];
    $path = parse_url($directoryURI, PHP_URL_PATH);
    $components = explode('/', $path);
    //tomamos cada pedazo de url
    $first_part = $components[1];
    $second_part = $components[2];
    $third_part = $components[3];
    // verficamos cada parte
    if($third_part == $url){
        return $show = 'show';
    }
    if($second_part == $url){
        return $show = 'show';
    }

    if($first_part == $url && !$second_part && !$third_part){
        return $show = 'show';
    }
   // retornamos
    return $show;
}
