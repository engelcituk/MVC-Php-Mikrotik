<?php

class GrupoLimiteAnchoBanda extends Controller {
   
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
