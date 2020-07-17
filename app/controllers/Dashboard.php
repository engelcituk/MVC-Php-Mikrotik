<?php

class Dashboard extends Controller {
    
    public $ok;
    public $mensaje;
    public $objeto;

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
        
        $this->view('dashboard/index', $data);
    }

    public function click()
    {
        if (isset($_POST['info']) && $_POST['info'] ) {
            $arr = array ('ok' => true, 'mensaje' => 'Petición exitosa','objeto'=>[]);

            echo json_encode($arr);
        } 
               
    }

}

