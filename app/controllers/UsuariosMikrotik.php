<?php

class UsuariosMikrotik extends Controller {
   
    public $API;
    public $connected;

    public function __construct()
    {     
        $this->API = $this->routerosAPI(); //instancia de routeros

        $this->connected = connected($this->API); // llamo al helper connected y le paso la instancia de RouterOS
          
        if (!estaLogueado()) {
            redirect('paginas/login');
        }
    }
    public function index(){

        //obtengo el listado de usuarios
        $usersMikrotik = $this->getUsersMikrotik();
        
	    $data = array('users' =>$usersMikrotik); // construyo un array con los datos obtenidos

        $this->view('usuariosMikrotik/index', $data);
    }

    public function agregar(){

        //obtengo el listado de usuarios
        $groupUsers = $this->getUserGroups();

        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            //saneamos los datos que vienen por POST
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            //array de campos del formulario
            $fields = [
                'name' => trim($_POST['name']),
                'groupUser'=>trim($_POST['groupUser']),
                'password' => trim($_POST['password']),
                'informacion'=>trim($_POST['informacion']),
                'name_err' => '',
                'groupUser_err' => '',
                'password_err' => '',
                'informacion_err' => '',
                'messageApi'=>''

            ];

            //Sí name es vacía regresamos mensaje de validación
            if(empty($fields['name'])){
                $fields['name_err'] = 'Por favor ingrese el nombre de usuario';
            }
            //Sí groupUser es vacía regresamos mensaje de validación
            if(empty($fields['groupUser'])){ 
                $fields['groupUser_err'] = 'Por favor seleccione un elemento de la lista';
            }

            //Sí password es vacía regresamos mensaje de validación
            if(empty($fields['password'])){ 
                $fields['password_err'] = 'Por favor ingrese la contraseña para el usuario';
            }

            //Sí informacion es vacía regresamos mensaje de validación
            if(empty($fields['informacion'])){ 
                $fields['informacion_err'] = 'Por favor ingrese la información';
            }
            //guardo los datos de user mikrotik
            $this->saveUserMikrotik($groupUsers , $fields);


        } else {
             //array de campos del formulario
             $fields = [
                'name'=> '' ,
                'groupUser'=>'',
                'password' => '',
                'informacion'=>'',
                'name_err' => '',
                'groupUser_err' => '',
                'password_err' => '',
                'informacion_err' => '',
                'messageApi'=>''

            ];

            $data = array('groupUsers' => $groupUsers, 'fields' => $fields); // construyo un array con los datos obtenidos

            $this->view('usuariosMikrotik/agregar', $data);
        }
	    
    }

    public function saveUserMikrotik($groupUsers , $fields){
       //sino hay ningún campo vacío guardamos los datos
       if(empty($fields['name_err']) && empty($fields['groupUser_err']) && 
          empty($fields['password_err']) && empty($fields['informacion_err']) ){
           
            if( $this->connected ){

                $name = $fields['name'];
                $groupUser = $fields['groupUser']; 
                $password = $fields['password'];
                $informacion = $fields['informacion'];

                $this->API->write('/user/add',false);	
                $this->API->write('=name='.$name,false);	
                $this->API->write('=group='.$groupUser,false);	
                $this->API->write('=password='.$password,true);
                $this->API->write('=comment='.$informacion,false);	
                $this->API->read();

                $fields['messageApi'] = 'Datos de usuario Mikrotik guardados correctamente.';
          
                flashMensaje('messageApi', $fields['messageApi'], 'alert alert-success'); 

                redirect('usuariosMikrotik/agregar'); // redirijo a la pagina sin los datos, porque se han guardado, pero se muestra el mensaje flash 

            } else {

                $fields['messageApi'] = 'Falló el guardado del Usuario Mikrotik';

                flashMensaje('messageApi', $fields['messageApi'], 'alert alert-danger'); 

                $data = array('groupUsers' => $groupUsers, 'fields' => $fields ); // construyo un array con los datos obtenidos

                $this->view('usuariosMikrotik/agregar', $data);

            }

       } else {

            $data = array('groupUsers' => $groupUsers, 'fields' => $fields ); // construyo un array con los datos obtenidos
    
            $this->view('usuariosMikrotik/agregar', $data);

       }

    }

    public function editarPassword(){

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            //saneamos los datos que vienen por POST
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            //array de campos del formulario
            $fields = [
                'oldPassword' => trim($_POST['oldPassword']),
                'newPassword'=>trim($_POST['newPassword']),
                'oldPassword_err' => '',
                'newPassword_err' => '',
                'messageApi'=>''

            ];

            //Sí oldPassword es vacía regresamos mensaje de validación
            if(empty($fields['oldPassword'])){
                $fields['oldPassword_err'] = 'Por favor ingrese la contraseña anterior';
            }
            //Sí newPassword es vacía regresamos mensaje de validación
            if(empty($fields['newPassword'])){ 
                $fields['newPassword_err'] = 'Por favor indique la nueva contraseña';
            }

            $this->updatePasswordMikrotik($fields);
            
        } else {

            //array de campos del formulario
            $fields = [
                'oldPassword'=> '' ,
                'newPassword'=>'',
                'oldPassword_err' => '',
                'newPassword_err' => '',
                'messageApi'=>''

            ];

            $data = array('fields' => $fields); // construyo un array con los datos obtenidos

            $this->view('usuariosMikrotik/editarPassword', $data);

        }        
    }

    public function updatePasswordMikrotik($fields){

        if(empty($fields['oldPassword_err']) && empty($fields['newPassword_err']) ){

            $oldPassword = $fields['oldPassword'];
            $newPassword = $fields['newPassword'];

            if( $this->connected ) {

                $this->API->write("/password",false);	
                $this->API->write("=old-password=".$oldPassword,false);	
                $this->API->write("=new-password=".$newPassword,false);	
                $this->API->write("=confirm-new-password=".$newPassword,true);
                $this->API->read();
                //actualizo en el archivo conexionRouter.php la nueva contraseña
                $this->updateDatosConexionRouter($_SESSION['ip'], $_SESSION['usuario'], $newPassword); 

                $fields['messageApi'] = 'Contraseña del Mikrotik actualizado exitosamente.';
          
                flashMensaje('messageApi', $fields['messageApi'], 'alert alert-success'); 

                redirect('usuariosMikrotik/editarPassword'); 
    
            } else {

                $fields['messageApi'] = 'Falló la actualización de la contraseña del Mikrotik';

                flashMensaje('messageApi', $fields['messageApi'], 'alert alert-danger'); 

                $data = array('fields' => $fields ); // construyo un array con los datos obtenidos

                $this->view('usuariosMikrotik/agregar', $data);

            }

        } else {

            $data = array('fields' => $fields ); // construyo un array con los datos obtenidos
    
            $this->view('usuariosMikrotik/editarPassword', $data);

        }
    }

    public function updateDatosConexionRouter($ip, $username, $newPassword){
        
        $archivo = 'conexionRouter.php';
     
        $manejador = fopen('../app/config/'.$archivo, 'w') or die('No puede abrir el archivo '.$archivo);
        $codigo = 
        '<?php 
            //datos de conexion router
            define("ROUTER_IP", "'.$ip.'");
            define("ROUTER_USER", "'.$username.'");
            define("ROUTER_PASS", "'.$newPassword.'");
        ';
        fwrite($manejador, $codigo);
        fclose($manejador);
    }

    public function editarIdentidad(){

        $data =[
            'posts'=>'hola'
        ];
        
        $this->view('usuariosMikrotik/editarIdentidad', $data);
    }

    public function reiniciarMikrotik(){

        $data =[
            'posts'=>'hola'
        ];
        
        $this->view('usuariosMikrotik/reiniciarMikrotik', $data);
    }

    public function editarPerfilMikrotik(){
        //obtengo el listado de usuarios
        $groupUsers = $this->getUserGroups();

        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            //saneamos los datos que vienen por POST
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            //array de campos del formulario
            $fields = [
                'id' => trim($_POST['id']),
                'name' => trim($_POST['name']),
                'groupUser'=>trim($_POST['groupUser']),
                'informacion'=>trim($_POST['informacion']),
                'name_err' => '',
                'groupUser_err' => '',
                'informacion_err' => '',
                'messageApi'=>''

            ];

            //Sí name es vacía regresamos mensaje de validación
            if(empty($fields['name'])){
                $fields['name_err'] = 'Por favor ingrese el nombre de usuario';
            }
            //Sí groupUser es vacía regresamos mensaje de validación
            if(empty($fields['groupUser'])){ 
                $fields['groupUser_err'] = 'Por favor seleccione un elemento de la lista';
            }

            //Sí password es vacía regresamos mensaje de validación
            if(empty($fields['password'])){ 
                $fields['password_err'] = 'Por favor ingrese la contraseña para el usuario';
            }

            //Sí informacion es vacía regresamos mensaje de validación
            if(empty($fields['informacion'])){ 
                $fields['informacion_err'] = 'Por favor ingrese la información';
            }
            //guardo los datos de user mikrotik
            $this->updateUserMikrotik($groupUsers , $fields);


        } else {

            $user = $this->getInfoUserMikrotikByName();
            $userMikrotik = $user[0]; //tomo el primer elemento de la fila
            
            $fields = [
                'id' =>$userMikrotik['.id'],
                'name'=> $userMikrotik['name'],
                'groupUser'=>$userMikrotik['group'],
                'informacion'=>$userMikrotik['comment'],
                'name_err' => '',
                'groupUser_err' => '',
                'informacion_err' => '',
                'messageApi'=>''

            ];

            $data = array('groupUsers' => $groupUsers, 'fields' => $fields); // construyo un array con los datos obtenidos

            $this->view('usuariosMikrotik/editarPerfilMikrotik', $data);
        } 
    }

    public function updateUserMikrotik($groupUsers , $fields){
        //sino hay ningún campo vacío guardamos los datos
       if(empty($fields['name_err']) && empty($fields['groupUser_err']) && empty($fields['informacion_err']) ){
           
            if( $this->connected){
                $this->API->write("/user/set",false);	
                $this->API->write("=name=".$fields['name'],false);	
                $this->API->write("=group=".$fields['groupUser'],false);	
                $this->API->write("=comment=".$fields['informacion'],false);	
                $this->API->write("=.id=".$fields['id'],true);
                $this->API->read();

                $fields['messageApi'] = 'Se actualizaron los datos del usuario Mikrotik.';
          
                flashMensaje('messageApi', $fields['messageApi'], 'alert alert-success'); 

                redirect('usuariosMikrotik/editarPerfilMikrotik'); // redirijo a la pagina sin los datos, porque se han guardado, pero se muestra el mensaje flash 

           } else {

            $fields['messageApi'] = 'Falló la actualización de los datos del Usuario Mikrotik';

            flashMensaje('messageApi', $fields['messageApi'], 'alert alert-danger'); 

            $data = array('groupUsers' => $groupUsers, 'fields' => $fields ); // construyo un array con los datos obtenidos

            $this->view('usuariosMikrotik/editarPerfilMikrotik', $data);

           }

       } else {

        $data = array('groupUsers' => $groupUsers, 'fields' => $fields ); // construyo un array con los datos obtenidos
   
        $this->view('usuariosMikrotik/editarPerfilMikrotik', $data);

       }
    }

    public function getUsersMikrotik(){
        //Sí estoy connectado, otengo los users del mikrotik, se guardan en un array
        if($this->connected){
            $this->API->write('/user/print'); 
            $usersMikrotik = $this->API->read(); 
        } else {
            $usersMikrotik = [];
        } 

        return $usersMikrotik;
    }

    public function getInfoUserMikrotikByName(){
        //Sí estoy connectado, otengo los groupUsers del mikrotik, se guardan en un array
        if($this->connected){
            $this->API->write('/user/print',false);   
	        $this->API->write('?name='.$_SESSION['usuario'],true); // el name del router guardado en sesion   
            $userMikrotik = $this->API->read(); 
       
        } else {
            $userMikrotik = [];
        } 

        return $userMikrotik;
    }

    public function getUserGroups(){
        //Sí estoy connectado, otengo los groupUsers del mikrotik, se guardan en un array
        if($this->connected){
            $this->API->write('/user/group/print'); 
            $groupUsers = $this->API->read(); 
        } else {
            $groupUsers = [];
        } 

        return $groupUsers;
    }

    public function deleteUserMikrotik(){
        
        if (isset($_POST['id']) && $_POST['id'] && isset($_POST['tokenCsrf']) && $_POST['tokenCsrf']) {
            
            $id= $_POST['id'];

            if($this->connected){
                
                $this->API->write('/user/remove',false);
                $this->API->write('=.id='.$id,true);
                $this->API->read();

                $respuesta = array ('ok' => true, 'mensaje' => 'Se ha borrado exitosamente al usuario');

            } else {

                $respuesta = array ('ok' => false, 'mensaje' => 'No se ha podido borrar los datos del usuario');

            }
            echo json_encode($respuesta);
        }        
    }

}
