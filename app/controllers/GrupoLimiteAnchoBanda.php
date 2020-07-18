<?php

class GrupoLimiteAnchoBanda extends Controller {
   
    public function __construct()
    {       
        if (!estaLogueado()) {
            redirect('paginas/login');
        }

    }
    public function index(){
        //obtengo los posts

        $data =[
            'posts'=>'hola'
        ];
        
        $this->view('grupoLimiteAnchoBanda/index', $data);
    }

    public function generador(){
        //obtengo los posts

        $data =[
            'posts'=>'hola'
        ];
        
        $this->view('grupoLimiteAnchoBanda/generador', $data);
    }

}
