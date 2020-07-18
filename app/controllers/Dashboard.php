<?php

class Dashboard extends Controller {
    
    public $ok;
    public $mensaje;
    public $objeto;
    public $API;

    public function __construct()
    {       
        /* if (!isLoggedIn()) {
            redirect('users/login');
        }
        $this->postModel = $this->model('Post');
        $this->userModel = $this->model('User'); */
        $this->API = $this->routerosAPI(); 
    }
    public function index(){
        //obtengo los posts
        //$hola = $this->API->hola();
/* 
        $data =[
            'info'=>$hola
        ];
         */
        $this->view('dashboard/index');
    }

    public function click()
    {
        if (isset($_POST['info']) && $_POST['info'] ) {
            $arr = array ('ok' => true, 'mensaje' => 'Petición exitosa','objeto'=>[]);

            echo json_encode($arr);
        } 
               
    }

}

