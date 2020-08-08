<?php

class Dashboard extends Controller {
    
    public $ok;
    public $mensaje;
    public $objeto;
    public $API;

    public function __construct()
    {   
        //$this->API = $this->routerosAPI(); 

        if (!estaLogueado()) {
            redirect('paginas/login');
        }
         
    }
    public function index(){
        
        $this->view('dashboard/index');
    }

}

