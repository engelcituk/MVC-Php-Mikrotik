
<?php
// carga de archivo de configuracion 
require_once 'config/config.php';
require_once 'config/conexionRouter.php';
require_once 'config/datosTicket.php';

// carga de archivos helpers
require_once 'helpers/helper.php';
require_once 'helpers/sesionHelper.php';


// carga automática de nuestros archivos de la carpeta libraries-> bibliotecas base
spl_autoload_register( function($className){
    require_once 'libraries/'. $className .'.php';
});

