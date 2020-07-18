<?php

class Paginas extends Controller {

    public function __construct()
    {
        //$this->postModel= $this->model('Post');

    }

    public function index(){
        $ok=false;
        if($ok){
            redirect('dashboard');
        }
        $data = [
            'ip'=> '' ,
            'username' => '',
            'password' => '',
            'ip_err' => '',
            'username_err' => '' 
        ];
        $this->view('paginas/login', $data);


    }

    public function about(){

        $this->view('paginas/about');        
    }

    public function login()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            //sanitizamos los datos que vienen por POST
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'ip'=> trim($_POST['ip']) ,
                'username' => trim($_POST['username']),
                'password' => trim($_POST['password']),
                'ip_err' => '',
                'username_err' => '' 
            ];

             //Validamos ip
            if(empty($data['ip'])){
                $data['ip_err'] = 'Por favor ingrese la ip';
            }
            //Validamos username
            if(empty($data['username'])){
                $data['username_err'] = 'Por favor ingrese el nombre de usuario';
            }
            // se asegura que no haya erroes de validación
            if( empty($data['ip_err']) && empty($data['username_err']) ){
                redirect('dashboard');                
            }else{
                // carga la vista login con el arreglo de errores y se imprimirían en el formulario
                $this->view('paginas/login', $data);
            }

        } else {
            //Iniciar data
            $data = [
                'email'=> '' ,
                'password' => '',
                'email_err' => '' ,
                'password_err' => ''
            ];
            // Cargar vista
            $this->view('paginas/login', $data);
        }      
    }

    public function login2(){
        // Verificar POST
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            //Procesa el formulario

            //sanitizamos los datos que vienen por POST
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'email'=> trim($_POST['email']) ,
                'password' => trim($_POST['password']),
                'email_err' => '',
                'password_err' => '' 
            ];
            //Validamos el email
            if(empty($data['email'])){
                $data['email_err'] = 'Por favor ingrese su email';
            }
            //Validamos la contraseña
            if(empty($data['password'])){
                $data['password_err'] = 'Por favor ingrese la contraseña';
            }
            // verificar usuario / correo
            if($this->userModel->findUserByEmail($data['email'])){
                // usuario encontrado
            }else{
                // usuario no encontrado
                $data['email_err'] = 'El usuario no se ha encontrado';
            }
            // asegurarse de que los errores esten vacíos
            if( empty($data['email_err']) && empty($data['password_err']) ){
                //validado
                //verificar y configurar que el usuario se conecte
                $user = $this->userModel->login($data['email'],$data['password']);// traigo los datos del usuario
                //si user trae valor
                if( $user ){
                    // creamos variables de sesión
                    $this->createUserSession( $user );
                }else{
                    $data['password_err'] = 'Contraseña incorrecta';
                    //recargamos la vista
                    $this->view('paginas/login', $data);
                }
            }else{
                // carga la vista login con el arreglo de errores y se imprimirían en el formulario
                $this->view('paginas/login', $data);
            }
            
        }else{
            //Iniciar data
            $data = [
                'email'=> '' ,
                'password' => '',
                'email_err' => '' ,
                'password_err' => ''
            ];
            // Cargar vista
            $this->view('users/login', $data);
        }
    }

    public function createUserSession($user){
        $_SESSION['user_id'] = $user->id;
        $_SESSION['user_name'] = $user->name;
        $_SESSION['user_email'] = $user->email;
        redirect('posts');        
    }
    public function logout(){
        //elimino las variables de sesion 
        unset($_SESSION['user_id']);
        unset($_SESSION['user_name']);
        unset($_SESSION['user_email']);

        session_destroy();// destruyo la sesion 

        redirect('users/login'); //redirijo
    }
    
}