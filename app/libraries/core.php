<?php

/**
 * clase principal de la aplicación
 * Crea URL y cargar del controllador nucleo
 * Formateo de la URL /controllador/metodo/parametros
 */

class Core {
     protected $controladorActual = 'Paginas';
     protected $metodoActual = 'index';
     protected $parametros = [];

     public function __construct(){
         $url = $this->getUrl();         
         // busca en los controladores el primer valor de nuestro array url
         if($url && file_exists('../app/controllers/'. ucwords($url[0]).'.php')){
             // sí existe, establezco ese controlador en la propiedad $controladorActual
             $this->controladorActual = ucwords($url[0]);
             unset($url[0]); // elimino la variable con el indice 1
         }
         // Requiero el controllador llamado de manera dinamica
         require_once '../app/controllers/'.$this->controladorActual.'.php';
         // instancio la clase controlador
         $this->controladorActual = new $this->controladorActual;

         //Revisar la segunda parte del url 
         if(isset($url[1])){
             //Revisar si el nmetodo existe en el controlador
            if (method_exists($this->controladorActual, $url[1])) {
                $this->metodoActual = $url[1];
                unset($url[1]); // elimino la variable con el indice 2
            }
         }
         // echo $this->metodoActual; 
         // obtener parametros restantes
        $this->parametros = $url ? array_values($url) : []; // operador ternario
         // llamar un callback con el array de parametros
        call_user_func_array([$this->controladorActual, $this->metodoActual], $this->parametros);
         
     }

     public function getUrl(){         
         if(isset($_GET['url'])){
             $url = rtrim($_GET['url'],'/'); // elimino los diagonales al final
             $url = filter_var($url, FILTER_SANITIZE_URL);// sanitizo la url
             $url = explode('/', $url); // divide la cadena en partes (creando un array)
             return $url; // regreso url en un array
         }else  {
             $url[0]='Paginas';
            return $url;
         }
     }
 }