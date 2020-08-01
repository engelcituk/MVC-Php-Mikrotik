<?php

class UsuariosHotspot extends Controller {
   
    public $API;
    public $connected;

    public function __construct()
    {       
        $this->API = $this->routerosAPI(); //instancia de routeros

        $this->connected = connected($this->API); // llamo al helper connected
        
        if (!estaLogueado()) {
            redirect('paginas/login');
        }
        
    }
    public function index(){
        //Sí estoy connectado, otengo los users hotspot, se guardan en un array
        if($this->connected){
            $this->API->write('/ip/hotspot/user/print'); 
            $users = $this->API->read(); 
        } else {
            $users = [];
        } 
        //Sí estoy connectado, obtengo los grupos limite de ancho de banda y los guardo en un array
        if($this->connected){
            $this->API->write("/ip/hotspot/user/profile/print");
            $anchosBanda = $this->API->read();;
        }else {
            $anchosBanda = [];
        }
        
	    $data = array('users' =>$users, 'anchosBanda' => $anchosBanda); // construyo un array con los datos obtenidos

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
        //Sí estoy connectado, obtengo los grupos limite de ancho de banda y los guardo en un array
        if($this->connected){
            $this->API->write("/ip/hotspot/user/profile/print");
            $anchosBanda = $this->API->read();;
        }else { 
            $anchosBanda = [];
        }

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            //saneamos los datos que vienen por POST
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $fields = [
                'username'=> trim($_POST['username']) ,
                'password' => trim($_POST['password']),
                'grupoLimiteAnchosBanda' => trim($_POST['grupoLimiteAnchosBanda']),
                'informacion' => trim($_POST['informacion']),
                'username_err' => '',
                'password_err' => '',
                'grupoLimiteAnchosBanda_err'=>'',
                'informacion_err'=>''
            ];

            //Validamos username
            if(empty($fields['username'])){
                $fields['username_err'] = 'Por favor ingrese el nombre de usuario';
            }
            //Validamos password
            if(empty($fields['password'])){ 
                $fields['password_err'] = 'Por favor ingrese la contraseña para el usuario';
            }
             //Validamos grupoLimiteAnchosBanda
            if(empty($fields['grupoLimiteAnchosBanda'])){ 
                $fields['grupoLimiteAnchosBanda_err'] = 'Por favor elija un elemento de la lista';
            }
             //Validamos informacion
             if(empty($fields['informacion'])){ 
                $fields['informacion_err'] = 'Por favor ingrese el precio';
            }

            //sino hay ningún campo vacío guardamos los datos
            if(empty($fields['username_err']) && empty($fields['password_err'])
               && empty($fields['grupoLimiteAnchosBanda_err']) && empty($fields['informacion_err']) ){

            }else{

                $data = array('anchosBanda' => $anchosBanda, 'fields' => $fields ); // construyo un array con los datos obtenidos

                $this->view('usuariosHotspot/agregar', $data);

            }
        } else {

            //Iniciar dataFields
            $fields = [
                'username'=> '',
                'password' => '',
                'grupoLimiteAnchosBanda' => '',
                'informacion'=>'',
                'username_err' => '',
                'password_err' => '',
                'grupoLimiteAnchosBanda_err'=>'',
                'informacion_err'=>''
            ];

            $data = array('anchosBanda' => $anchosBanda, 'fields' => $fields ); // construyo un array con los datos obtenidos

            $this->view('usuariosHotspot/agregar', $data);
        }
        
    }
    //obtengo los datos del usuario, desde una llamada ajax, ocupo el token csrf
    public function getInfoUserHotspot(){
        //si idUser está definida y se está recibiendo por post
        if (isset($_POST['idUser']) && $_POST['idUser'] && isset($_POST['tokenCsrf']) && $_POST['tokenCsrf']) {
            $idUser= $_POST['idUser'];
            if($this->connected){

                $this->API->write("/ip/hotspot/user/print",false); 

                $this->API->write("?.id=".$idUser,true);   

                $user = $this->API->read();

                $respuesta = array ('ok' => true, 'mensaje' => 'Se ha obtenido los datos del usuario','user'=>$user);
            }else{
                $respuesta = array ('ok' => false, 'mensaje' => 'No se ha obtenido datos del usuario','user'=>[]);
            }

            echo json_encode($respuesta);
        }
    }
    public function saveUserHotspot(){

        if (isset($_POST['user']) && $_POST['user'] && isset($_POST['tokenCsrf']) && $_POST['tokenCsrf']) {

            $usuario = $_POST['user']; //el usuario array

            $name= $usuario['username'];
            $password= $usuario['password'];
            $profile= $usuario['profile'];
            $comment= $usuario['comment'];
            $id = $usuario['id'];

            if($this->connected){

                $this->API->write("/ip/hotspot/user/set",false); 
                $this->API->write("=name=".$name,false);	
                $this->API->write("=password=".$password,false);	
                $this->API->write("=profile=".$profile,false);		
                $this->API->write("=comment=".$comment,false);		
                $this->API->write("=.id=".$id,true);
                $this->API->read();

                $respuesta = array ('ok' => true, 'mensaje' => 'Se ha actualizado los datos del usuario','user' => $usuario);

            }else{
                $respuesta = array ('ok' => false, 'mensaje' => 'No se ha podido actualizar los datos del usuario','user'=>[]);
            }            
            echo json_encode($respuesta);
        }
    }

    public function deleteUserHotspot(){
        
        if (isset($_POST['id']) && $_POST['id'] && isset($_POST['tokenCsrf']) && $_POST['tokenCsrf']) {
            
            $id= $_POST['id'];

            if($this->connected){
                
                $this->API->write("/ip/hotspot/user/remove",false);

                $this->API->write("=.id=".$id,true);

                $this->API->read();

                $respuesta = array ('ok' => true, 'mensaje' => 'Se ha borrado exitosamente al usuario');

            }else {

                $respuesta = array ('ok' => false, 'mensaje' => 'No se ha podido borrar los datos del usuario');

            }

            echo json_encode($respuesta);
        }        
    }

    public function resetCounterUserHotspot(){

        if (isset($_POST['id']) && $_POST['id'] && isset($_POST['tokenCsrf']) && $_POST['tokenCsrf']) {

            $id= $_POST['id'];

            if($this->connected){

                $this->API->write("/ip/hotspot/user/remove",false);	

                $this->API->write("=.id=".$id,true);

                $this->API->read();

                $respuesta = array ('ok' => true, 'mensaje' => 'Se ha reseteado el contador del usuario');

            } else {

                $respuesta = array ('ok' => false, 'mensaje' => 'No se ha podido resetear el contador del usuario');

            }

            echo json_encode($respuesta);
        }        
    }
}

