<?php

/**
 * Clase base de datos PDO
 * Conectar a la base de datos
 * Crear sentencias preparadas
 * Bind values (valores enlazados)
 * Retorno de resultados
 */

 class Database {

     private $host = DB_HOST;
     private $user = DB_USER;
     private $pass = DB_PASS;
     private $dbname = DB_NAME;

     private $dbh; // database handler
     private $stmt; // sentencia
     private $error;

     public function __construct()
     {
         // seteamos Nombre del Origen de Datos (DSN)
         $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
         $options = array(
             PDO::ATTR_PERSISTENT => true,
             PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
         );

         // creamos una instancia de pdo
         try {
             $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
         } catch(PDOException $e) {
             $this->error = $e->getMessage();
             echo $this->error;
         }
     }

     // para usar en sentencias sql
     public function query($sql){
         $this->stmt = $this->dbh->prepare($sql);
     }
     // función para enlazar valores
     public function bind($param, $value, $type = null){
         if(is_null($type)){
             switch(true){
                 case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;

             }
         }
         $this->stmt->bindValue($param,$value, $type);
     }

     // para ejecutar la sentencia preparada (ejecutar consultas)
     public function execute(){
         return $this->stmt->execute();
     }

     //obtener el conjunto de resultados como una matriz de objetos
     public function resultSet(){
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }

    // para obtener un solo registro como objeto
    public function single(){
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }
    
    //obtener un recuento de filas
    public function rowCount(){
        return $this->stmt->rowCount();
    } 
 }