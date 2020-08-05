<?php

class UsuariosHotspot extends Controller {
   
    public $API;
    public $connected;

    public function __construct()
    {       
        $this->API = $this->routerosAPI(); //instancia de routeros

        $this->connected = connected($this->API); // llamo al helper connected y le paso la instancia de RouterOS
        
        // unset($_SESSION['data']); // sesion data se destruye, guarda el array

        if (!estaLogueado()) {
            redirect('paginas/login');
        }
        
    }
    public function index(){
        //obtengo el listado de usuarios
        $users = $this->getUsersHotspot();
        //obtengo el listado de grupos limite de anchos de banda (o perfil)
        $anchosBanda = $this->getBandwidthLimitGroup();
        // users se muestran en el datatables, anchosabanda en el modal de edit userhotspot
	    $data = array('users' =>$users, 'anchosBanda' => $anchosBanda); // construyo un array con los datos obtenidos

        $this->view('usuariosHotspot/index', $data);
    }

    public function activos(){
        //obtengo los usuarios activos
        $usersActive = $this->getUsersHotspotActive();

	    $data = array('users' =>$usersActive); // construyo un array con los datos obtenidos

        $this->view('usuariosHotspot/activos', $data);
    }

    public function generador(){
        //obtengo el listado de grupos limite de anchos de banda (o perfil)
        $anchosBanda = $this->getBandwidthLimitGroup();

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            //saneamos los datos que vienen por POST
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            //array de campos del formulario
            $fields = [
                'longitudUser'=> trim($_POST['longitudUser']) ,
                'longitudPassword' => trim($_POST['longitudPassword']),
                'grupoLimiteAnchosBanda' => trim($_POST['grupoLimiteAnchosBanda']),
                'tipoTiempos' => trim($_POST['tipoTiempos']),
                'limiteTiempo' => trim($_POST['limiteTiempo']),
                'cantidadUsers' => trim($_POST['cantidadUsers']),
                'precio' => trim($_POST['precio']),
                'longitudUser_err' => '',
                'longitudPassword_err' => '',
                'grupoLimiteAnchosBanda_err'=>'',
                'tipoTiempos_err'=>'',
                'limiteTiempo_err'=>'',
                'cantidadUsers_err'=>'',
                'precio_err'=>'',
                'messageApi' => ''

            ];

             //Sí longitudUser es vacía regresamos mensaje de validacíon
             if(empty($fields['longitudUser'])){
                $fields['longitudUser_err'] = 'Elija la longitud de caracteres para los usuarios';
            }
            //Sí longitudPassword es vacía regresamos mensaje de validacíon
            if(empty($fields['longitudPassword'])){ 
                $fields['longitudPassword_err'] = 'Elija la longitud de caracteres para las contraseñas';
            }
             //Sí grupoLimiteAnchosBanda es vacía regresamos mensaje de validacíon
            if(empty($fields['grupoLimiteAnchosBanda'])){ 
                $fields['grupoLimiteAnchosBanda_err'] = 'Por favor elija un elemento de la lista';
            }
             //Sí tipoTiempos es vacía regresamos mensaje de validacíon
             if(empty($fields['tipoTiempos'])){ 
                $fields['tipoTiempos_err'] = 'Por favor elija un tiempo';
            }
            //Sí limiteTiempo es vacía regresamos mensaje de validacíon
            if(empty($fields['limiteTiempo'])){ 
                $fields['limiteTiempo_err'] = 'Por favor ingrese el limite de tiempo';
            }
             //Sí cantidadUsers es vacía regresamos mensaje de validacíon
            if(empty($fields['cantidadUsers'])){ 
                $fields['cantidadUsers_err'] = 'Elija la cantidad de usuarios';
            }
             //Sí precio es vacía regresamos mensaje de validacíon
             if(empty($fields['precio'])){ 
                $fields['precio_err'] = 'Por favor ingrese el precio para los vouchers';
            }
            

            $this->saveUsersHotspot($fields, $anchosBanda);

        }else{

             //Iniciar array de campos
             $fields = [
                'longitudUser'=> '',
                'longitudPassword' => '',
                'grupoLimiteAnchosBanda' => '',
                'tipoTiempos'=>'',
                'limiteTiempo'=>'',
                'cantidadUsers'=>'',
                'precio'=>'',
                'longitudUser_err' => '',
                'longitudPassword_err' => '',
                'grupoLimiteAnchosBanda_err'=>'',
                'tipoTiempos_err'=>'',
                'limiteTiempo_err'=>'',
                'cantidadUsers_err'=>'',
                'precio_err'=>'',
                'messageApi' => ''
            ];

            $data = array('anchosBanda' => $anchosBanda, 'fields' => $fields ); // construyo un array con los datos

            $this->view('usuariosHotspot/generador', $data);

        }       
    }

    public function agregar(){
        //obtengo el listado de grupos limite de anchos de banda (o perfil)
        $anchosBanda = $this->getBandwidthLimitGroup();

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            //saneamos los datos que vienen por POST
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            //array de campos del formulario
            $fields = [
                'username'=> trim($_POST['username']) ,
                'password' => trim($_POST['password']),
                'grupoLimiteAnchosBanda' => trim($_POST['grupoLimiteAnchosBanda']),
                'informacion' => trim($_POST['informacion']),
                'username_err' => '',
                'password_err' => '',
                'grupoLimiteAnchosBanda_err'=>'',
                'informacion_err'=>'',
                'messageApi'=>''

            ];

            //Sí username es vacía regresamos mensaje de validacíon
            if(empty($fields['username'])){
                $fields['username_err'] = 'Por favor ingrese el nombre de usuario';
            }
            //Sí password es vacía regresamos mensaje de validacíon
            if(empty($fields['password'])){ 
                $fields['password_err'] = 'Por favor ingrese la contraseña para el usuario';
            }
             //Sí grupoLimiteAnchosBanda es vacía regresamos mensaje de validacíon
            if(empty($fields['grupoLimiteAnchosBanda'])){ 
                $fields['grupoLimiteAnchosBanda_err'] = 'Por favor elija un elemento de la lista';
            }
             //Sí informacion es vacía regresamos mensaje de validacíon
             if(empty($fields['informacion'])){ 
                $fields['informacion_err'] = 'Por favor ingrese el precio';
            }

            //guardo los datos de user hotspot
            $this->saveUserHotspot($fields, $anchosBanda);

        } else {

            //Iniciar array de campos
            $fields = [
                'username'=> '',
                'password' => '',
                'grupoLimiteAnchosBanda' => '',
                'informacion'=>'',
                'username_err' => '',
                'password_err' => '',
                'grupoLimiteAnchosBanda_err'=>'',
                'informacion_err'=>'',
                'messageApi' => ''
            ];

            $data = array('anchosBanda' => $anchosBanda, 'fields' => $fields ); // construyo un array con los datos

            $this->view('usuariosHotspot/agregar', $data);
        }
        
    }
    public function saveUsersHotspot($fields, $anchosBanda){
        //sino hay ningún campo vacío guardamos los datos
        if( empty($fields['longitudUser_err']) && empty($fields['longitudPassword_err']) && 
            empty($fields['grupoLimiteAnchosBanda_err']) && empty($fields['tipoTiempos_err']) &&
            empty($fields['limiteTiempo_err']) && empty($fields['cantidadUsers_err']) &&
            empty($fields['precio_err'])  ){

            if( $this->connected){

                $dataUsers = array();
                
                $profile = $fields['grupoLimiteAnchosBanda'];
                $tiempo = tranformarTiempo($fields['limiteTiempo'], $fields['tipoTiempos']); //helper
                $precio = $fields['precio'];

                for ( $i=0; $i < $fields['cantidadUsers']; $i++) { 

                    $username = generateUserString($fields['longitudUser']); //helper
                    $password = generateUserPasswordString($fields['longitudPassword']); //helper
                    
                    $this->API->write("/ip/hotspot/user/add",false);	
                    $this->API->write("=name=".$username,false);	
                    $this->API->write("=password=".$password,false);	
                    $this->API->write("=profile=".$profile,false);	
                    $this->API->write("=limit-uptime=".$tiempo,false);		
                    $this->API->write("=comment=".$precio,true);	
                    $this->API->read();

	                $dataUsers[]= ['name'=>$username,'password'=>$password, 'profile'=>$profile,'limitUptime'=>$tiempo, 'comment'=>$precio];

                }
                
                $fields['messageApi'] = 'Generación de usuarios Hotspot realizados exitosamente.';
          
                flashMensaje('messageApiSuccess', $fields['messageApi'], 'alert alert-success'); 
   
                $data = array('anchosBanda' => $anchosBanda, 'fields' => $fields ); // construyo un array con los datos obtenidos
                
                $_SESSION['dataUsers'] = json_encode($dataUsers);

                redirect('usuariosHotspot/vouchers'); // redirijo a la pagina con los datos para ver los vouchers de users

            } else {
                //si hubo falla al conectarse al mikrotik
                $fields['messageApi'] = 'Falló la generación de usuarios Hotspot';

                flashMensaje('messageApi', $fields['messageApi'], 'alert alert-danger'); 

                $data = array('anchosBanda' => $anchosBanda, 'fields' => $fields ); // construyo un array con los datos obtenidos

                $this->view('usuariosHotspot/generador', $data);
                
            }

        } else { //si hay campos vacíos se regresa el array de errores y se conserva los campos rellenados, y los datos de anchos de banda

            $data = array('anchosBanda' => $anchosBanda, 'fields' => $fields ); // construyo un array con los datos obtenidos
   
            $this->view('usuariosHotspot/generador', $data);
   
        }
    }
    
    //funcion que se encarga de procesar la logica de guardado, validar si campos están vacíos
    public function saveUserHotspot($fields, $anchosBanda){
        //sino hay ningún campo vacío guardamos los datos
        if(empty($fields['username_err']) && empty($fields['password_err'])
        && empty($fields['grupoLimiteAnchosBanda_err']) && empty($fields['informacion_err']) ){

         if($this->connected){

             $username = $fields['username'];
             $password = $fields['password'];
             $grupoLimiteAnchosBanda = $fields['grupoLimiteAnchosBanda'];
             $precio = $fields['informacion'];

             $this->API->write("/ip/hotspot/user/add",false);	
             $this->API->write("=name=".$username,false);	
             $this->API->write("=password=".$password,false);	
             $this->API->write("=profile=".$grupoLimiteAnchosBanda,false);			
             $this->API->write("=comment=".$precio,true);	

             $this->API->read();

             $fields['messageApi'] = 'Datos de usuario Hotspot guardados correctamente.';
          
             flashMensaje('messageApi', $fields['messageApi'], 'alert alert-success'); 

             redirect('usuariosHotspot/agregar'); // redirijo a la pagina sin los datos, porque se han guardado, pero se muestra el mensaje flash               
                          
         } else {
             $fields['messageApi'] = 'Falló el guardado del Usuario Hotspot';

             flashMensaje('messageApi', $fields['messageApi'], 'alert alert-danger'); 

             $data = array('anchosBanda' => $anchosBanda, 'fields' => $fields ); // construyo un array con los datos obtenidos

             $this->view('usuariosHotspot/agregar', $data);
         }

     } else { //si hay campos vacíos se regresa el array de errores y se conserva los campos rellenados, y los datos de anchos de banda

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
    public function updateUserHotspot(){

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

    public function getUsersHotspot(){
        //Sí estoy connectado, otengo los users hotspot, se guardan en un array
        if($this->connected){
            $this->API->write('/ip/hotspot/user/print'); 
            $users = $this->API->read(); 
        } else {
            $users = [];
        } 

        return $users;
    }

    public function getUsersHotspotActive(){
        //Sí estoy connectado, otengo los users hotspot, se guardan en un array
        if($this->connected){
	        $this->API->write("/ip/hotspot/active/print");   

            $usersActive = $this->API->read(); 
        } else {
            $usersActive = [];
        } 

        return $usersActive;
    }

    public function getBandwidthLimitGroup(){
        //Sí estoy connectado, obtengo los grupos limite de ancho de banda y los guardo en un array
        if($this->connected){
            $this->API->write("/ip/hotspot/user/profile/print");
            $anchosBanda = $this->API->read();;
        }else {
            $anchosBanda = [];
        }

        return $anchosBanda;
        
    }

    public function vouchers(){
        if (isset($_SESSION['dataUsers']) && $_SESSION['dataUsers']){

            $data = json_decode($_SESSION['dataUsers']);
            $this->view('usuariosHotspot/vouchers', $data);

        }else if(isset($_GET['data']) && $_GET['data']){
            
            $data = json_decode($_GET['data']);
            $this->view('usuariosHotspot/vouchers', $data);

        }else{
            $this->view('shared/noData');   
        }
    }
}

