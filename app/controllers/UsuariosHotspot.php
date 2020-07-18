<?php

class UsuariosHotspot extends Controller {
   
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
        
        $this->view('usuariosHotspot/index', $data);
    }

    public function activos(){
        //obtengo los posts

        $data =[
            'posts'=>'hola'
        ];
        
        $this->view('usuariosHotspot/activos', $data);
    }

    public function generador(){
        //obtengo los posts

        $data =[
            'posts'=>'hola'
        ];
        
        $this->view('usuariosHotspot/generador', $data);
    }
    public function agregar(){
        //obtengo los posts

        $data =[
            'posts'=>'hola'
        ];
        
        $this->view('usuariosHotspot/agregar', $data);
    }

}
