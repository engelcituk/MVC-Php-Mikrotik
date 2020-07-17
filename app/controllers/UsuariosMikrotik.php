<?php

class UsuariosMikrotik extends Controller {
   
    public function __construct()
    {       
        /* if (!isLoggedIn()) {
            redirect('users/login');
        }
        $this->postModel = $this->model('Post');
        $this->userModel = $this->model('User'); */
    }
    public function index(){
        //obtengo los posts

        $data =[
            'posts'=>'hola'
        ];
        
        $this->view('usuariosMikrotik/index', $data);
    }

    public function editarPassword(){
        //obtengo los posts

        $data =[
            'posts'=>'hola'
        ];
        
        $this->view('usuariosMikrotik/editarPassword', $data);
    }

    public function editarIdentidad(){
        //obtengo los posts

        $data =[
            'posts'=>'hola'
        ];
        
        $this->view('usuariosMikrotik/editarIdentidad', $data);
    }

    public function reiniciarMikrotik(){
        //obtengo los posts

        $data =[
            'posts'=>'hola'
        ];
        
        $this->view('usuariosMikrotik/reiniciarMikrotik', $data);
    }
    public function editPerfilMikrotik(){
        //obtengo los posts

        $data =[
            'posts'=>'hola'
        ];
        
        $this->view('usuariosMikrotik/editarPerfilMikrotik', $data);
    }
}
