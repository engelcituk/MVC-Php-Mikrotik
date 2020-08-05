<?php

class GrupoLimiteAnchoBanda extends Controller {
   
    public $API;
    public $connected;

    public function __construct(){

        $this->API = $this->routerosAPI(); //instancia de routeros

        $this->connected = connected($this->API); // llamo al helper connected y le paso la instancia de RouterOS
        
        if (!estaLogueado()) {
            redirect('paginas/login');
        }

    }
    public function index(){
        //obtengo los usersProfile
        $usersProfile = $this->getHotspotsUsersProfile();

	    $data = array('usersProfile' =>$usersProfile); // construyo un array con los datos obtenidos
        
        $this->view('grupoLimiteAnchoBanda/index', $data);
    }

    public function generador(){

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            //saneamos los datos que vienen por POST
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            //array de campos del formulario
            $fields = [
                'nameGroup'=> trim($_POST['nameGroup']) ,
                'numberSharedUsers' => trim($_POST['numberSharedUsers']),
                'limit' => trim($_POST['limit']),
                'unidadLimit' => trim($_POST['unidadLimit']),
                'nameGroup_err' => '',
                'numberSharedUsers_err' => '',
                'limit_err'=>'',
                'unidadLimit_err'=>'',
                'messageApi' => ''

            ];

             //Sí nameGroup es vacía regresamos mensaje de validacíon
            if(empty($fields['nameGroup'])){
                $fields['nameGroup_err'] = 'Indique un nombre';
            }
            //Sí numberSharedUsers es vacía regresamos mensaje de validacíon
            if(empty($fields['numberSharedUsers'])){ 
                $fields['numberSharedUsers_err'] = 'Indique un número de usuarios compartidos';
            }
             //Sí limit es vacía regresamos mensaje de validacíon
            if(empty($fields['limit'])){ 
                $fields['limit_err'] = 'Defina un valor númerico';
            }
             //Sí unidadLimit es vacía regresamos mensaje de validacíon
             if(empty($fields['unidadLimit'])){ 
                $fields['unidadLimit_err'] = 'Por favor elija una unidad';
            }
            
            $this->saveBandwidthLimitGroup($fields); //guardo

        } else {

             //Iniciar array de campos
             $fields = [
                'nameGroup'=> '',
                'numberSharedUsers' => '',
                'limit' => '',
                'unidadLimit'=>'',
                'nameGroup_err' => '',
                'numberSharedUsers_err' => '',
                'limit_err'=>'',
                'unidadLimit_err'=>'',
                'messageApi' => ''
            ];

            $data = array('fields' => $fields ); // construyo un array con los datos

            $this->view('grupoLimiteAnchoBanda/generador', $data);
        }
    }

    public function saveBandwidthLimitGroup($fields){
        if( empty($fields['nameGroup_err']) && empty($fields['numberSharedUsers_err']) && 
            empty($fields['limit_err']) && empty($fields['unidadLimit_err'])   ){
            
            if($this->connected){

                $name = $fields['nameGroup'];
                $sharedUsers = $fields['numberSharedUsers'];
                $limit = $fields['limit'];
                $unidadLimite = $fields['unidadLimit'];
                $rateLimit = $limit.''.$unidadLimite.'/'.$limit.''.$unidadLimite;

                $this->API->write("/ip/hotspot/user/profile/add",false);	
                $this->API->write("=name=".$name,false);	
                $this->API->write("=shared-users=".$sharedUsers,false);	
                $this->API->write("=rate-limit=".$rateLimit,true);	
                $this->API->read();
                
                $fields['messageApi'] = 'Datos guardados correctamente.';
          
                flashMensaje('messageApi', $fields['messageApi'], 'alert alert-success'); 

                $data = array('fields' => $fields ); // construyo un array con los datos obtenidos

                redirect('grupoLimiteAnchoBanda/generador'); 

            } else {

                $fields['messageApi'] = 'Falló el guardado de la información';

                flashMensaje('messageApi', $fields['messageApi'], 'alert alert-danger'); 

                $data = array('fields' => $fields ); // construyo un array con los datos obtenidos

                $this->view('usuariosHotspot/agregar', $data);

            }

        } else {

            $data = array('fields' => $fields ); // construyo un array con los datos obtenidos
   
            $this->view('grupoLimiteAnchoBanda/generador', $data);

        }
    }

    public function getHotspotsUsersProfile(){
        //Sí estoy connectado, otengo los users hotspot, se guardan en un array
        if($this->connected){

	        $this->API->write('/ip/hotspot/user/profile/print');   
            $usersProfile = $this->API->read();

        } else {

            $usersProfile = [];

        } 

        return $usersProfile;
    }
    public function getInfoHotspotUserProfile(){
        //si idProfile está definida y se está recibiendo por post
        if (isset($_POST['idProfile']) && $_POST['idProfile'] && isset($_POST['tokenCsrf']) && $_POST['tokenCsrf']) {

            $idProfile= $_POST['idProfile'];

            if($this->connected){

                $this->API->write("/ip/hotspot/user/profile/print",false); 

                $this->API->write("?.id=".$idProfile,true);   

                $userProfile = $this->API->read();

                $respuesta = array ('ok' => true, 'mensaje' => 'Se ha obtenido los datos' ,'userProfile'=>$userProfile);

            } else {

                $respuesta = array ('ok' => false, 'mensaje' => 'No se ha obtenido datos' ,'userProfile'=>[]);
            }

            echo json_encode($respuesta);
        }
    }

    public function updateHotspotUserProfile(){

        if (isset($_POST['user']) && $_POST['user'] && isset($_POST['tokenCsrf']) && $_POST['tokenCsrf']) {

            $usuario = $_POST['user']; //el usuario array

            $id = $usuario['id'];
            $name= $usuario['name'];
            $sharedUsers= $usuario['sharedUsers'];
            $limite= $usuario['limite'];
            $tipoUnidad= $usuario['tipoUnidad'];
            $rateLimit = $limite.''.$tipoUnidad.'/'.$limite.''.$tipoUnidad;

            if($this->connected){

                $this->API->write("/ip/hotspot/user/profile/set",false);	
                $this->API->write("=name=".$name,false);	
                $this->API->write("=shared-users=".$sharedUsers,false);	
                $this->API->write("=rate-limit=".$rateLimit,false);		
                $this->API->write("=.id=".$id,true);
                $this->API->read();

                $respuesta = array ('ok' => true, 'mensaje' => 'Se ha actualizado los datos del usuario','user' => $usuario);

            }else{
                $respuesta = array ('ok' => false, 'mensaje' => 'No se ha podido actualizar los datos del usuario','user'=>[]);
            }            
            echo json_encode($respuesta);
        }
    }

    public function deleteHotspotsUserProfile(){
        
        if (isset($_POST['id']) && $_POST['id'] && isset($_POST['tokenCsrf']) && $_POST['tokenCsrf']) {
            
            $id= $_POST['id'];

            if($this->connected){
               
                $this->API->write('/ip/hotspot/user/profile/remove',false);

                $this->API->write('=.id='.$id,true);

                $this->API->read();

                $respuesta = array ('ok' => true, 'mensaje' => 'Se ha borrado exitosamente la información');

            }else {

                $respuesta = array ('ok' => false, 'mensaje' => 'No se ha podido borrar la información');

            }

            echo json_encode($respuesta);
        }        
    }

}
