<?php

class Paginas extends Controller {

    public $API;
    public function __construct()
    {
        $this->API = $this->routerosAPI(); 

    }

    public function index(){
       
        if (estaLogueado()) {
            redirect('dashboard');
        }
        $data = [
            'ip'=> '' ,
            'username' => '',
            'password' => '',
            'ip_err' => '',
            'username_err' => '',
            'messageApi'=>''
        ];
        $this->view('paginas/login', $data);


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
                'username_err' => '',
                'messageApi'=>''
            ];

             //Validamos ip
            if(empty($data['ip'])){
                $data['ip_err'] = 'Por favor ingrese la ip';
            }
            //Validamos username
            if(empty($data['username'])){
                $data['username_err'] = 'Por favor ingrese el nombre de usuario';
            }
            // se asegura que no haya errores de validación
            if( empty($data['ip_err']) && empty($data['username_err']) ){
                $conectado = $this->conectar($data); //verifico si conecta con los datos al mikrotik
                if($conectado){ //si se conecta, se crea las variables de sesion y redirijo al dashboard
                    $this->createUserSession($data);
                    $this->datosConexionRouter($data);//se escribe en el archivo de configuración los datos de acceso al router
                    redirect('dashboard');                
                }else{
                    $data['messageApi'] = '¡La conexión al Mikrotik FALLÓ! Verifique la conexión con el enrutador o el nombre de usuario/contraseña ¡Quizás no sean correctos!';
                    flashMensaje('messageApi', $data['messageApi'], 'alert alert-danger');
                    $this->view('paginas/login', $data);
                }
            }else{
                // carga la vista login con el arreglo de errores y se imprimirían en el formulario
                $this->view('paginas/login', $data);
            }

        } else {
            //Iniciar data
            $data = [
                'ip'=> '',
                'username' => '',
                'password' => '',
                'ip_err' => '',
                'username_err' => '',
                'messageApi'=>''
            ];
            // Cargar vista
            $this->view('paginas/login', $data);
        }      
    }

    public function conectar($data)
    {
        return  $this->API->connect($data['ip'],$data['username'],$data['password']); //verifico si se conecta, me regresa un booleano
        
    }
    public function createUserSession($data){
        $_SESSION['ip'] = $data['ip'];
        $_SESSION['usuario'] = $data['username'];
        $_SESSION['tokencsrf'] = csrf_token(); //token generado gracias al helper
        redirect('dashboard');        
    }
    public function logout(){
        //elimino las variables de sesion 
        unset($_SESSION['ip']);
        unset($_SESSION['usuario']);
        unset($_SESSION['tokencsrf']);

        session_destroy();// destruyo la sesion 

        redirect('paginas/login'); //redirijo la raiz
    }

    public function datosConexionRouter($data)
    {
        $archivo = 'conexionRouter.php';

        $ip = $data["ip"];
        $username = $data["username"]; 
        $password = $data["password"];
     
        $manejador = fopen('../app/config/'.$archivo, 'w') or die('No puede abrir el archivo '.$archivo);
        $codigo = 
        '<?php 
            //datos de conexion router
            define("ROUTER_IP", "'.$ip.'");
            define("ROUTER_USER", "'.$username.'");
            define("ROUTER_PASS", "'.$password.'");
        ';
        fwrite($manejador, $codigo);
        fclose($manejador);
    }
    
}