<?php
/**
 * Controlador base
 * Carga de modelos y vistas
 */
 class Controller { 
     //cargar modelo
     public function model($model){
         // requerir el archivo del modelo
         require_once '../app/models/'.$model.'.php';
         // se instancia el modelo
         return new $model();   
     }
     //metodo para cargar la vista
     public function view($view, $data=[]){
        // verificamos que el archivo de la vista exista dentro de la carpeta vistas
        if(file_exists('../app/views/'. $view. '.php')){
            //requerimos la vista
            require_once '../app/views/'. $view. '.php';
        }else{
            // si la vista no existe
            die('La vista no existe');
        }
    }
    // requiero la clase routeros_api y genero una instancia de esta, para usar en los constructores de los controladores
    public function routerosAPI()
    {
        require_once 'RouterosAPI.php'; //ubicado dentro de la carpeta libraries

        return new RouterosAPI(); //genero la instancia
        
    }


 }