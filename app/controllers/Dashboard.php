<?php

class Dashboard extends Controller {
    

    public function __construct(){   
        
        if (!estaLogueado()) {
            redirect('paginas/login');
        }
         
    }
    public function index(){
        
        $this->view('dashboard/index');
    }

}
