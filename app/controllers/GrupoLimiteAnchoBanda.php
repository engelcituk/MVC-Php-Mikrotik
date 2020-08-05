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
        //obtengo los posts

        $data =[
            'posts'=>'hola'
        ];
        
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

                $nameGroup = $fields['nameGroup'];
                $numberSharedUsers = $fields['numberSharedUsers'];
                $limit = $fields['limit'];
                $unidadLimit = $fields['unidadLimit'];
                $velocidad = $limit.''.$unidadLimit.'/'.$limit.''.$unidadLimit;

                $this->API->write("/ip/hotspot/user/profile/add",false);	
                $this->API->write("=name=".$nameGroup,false);	
                $this->API->write("=shared-users=".$numberSharedUsers,false);	
                $this->API->write("=rate-limit=".$velocidad,true);	

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

}
