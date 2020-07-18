<?php

class UsuariosMikrotik extends Controller {
   
    public function __construct()
    {       
        if (!estaLogueado()) {
            redirect('paginas/login');
        }
    }
    public function index(){

        $data =[
            'posts'=>'hola'
        ];
        
        $this->view('usuariosMikrotik/index', $data);
    }

    public function editarPassword(){

        $data =[
            'posts'=>'hola'
        ];
        
        $this->view('usuariosMikrotik/editarPassword', $data);
    }

    public function editarIdentidad(){

        $data =[
            'posts'=>'hola'
        ];
        
        $this->view('usuariosMikrotik/editarIdentidad', $data);
    }

    public function reiniciarMikrotik(){

        $data =[
            'posts'=>'hola'
        ];
        
        $this->view('usuariosMikrotik/reiniciarMikrotik', $data);
    }
    public function editarPerfilMikrotik(){

        $data =[
            'posts'=>'hola'
        ];
        
        $this->view('usuariosMikrotik/editarPerfilMikrotik', $data);
    }
}
