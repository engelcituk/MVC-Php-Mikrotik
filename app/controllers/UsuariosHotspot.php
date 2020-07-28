<?php

class UsuariosHotspot extends Controller {
   
    public $API;
    public function __construct()
    {       
        $this->API = $this->routerosAPI(); //instancia de routeros
        
        if (!estaLogueado()) {
            redirect('paginas/login');
        }
        
    }
    public function index(){
        //Sí estoy conectado
        if($this->API->connect(ROUTER_IP, ROUTER_USER, ROUTER_PASS) ){
            $this->API->write('/ip/hotspot/user/print');   
	        $data = $this->API->read(); 
        } else {
            $data = [];
        }
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
