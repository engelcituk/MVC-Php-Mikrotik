<?php

class Post { 
/* como convencion, el modelo es singular y su controlador 
respectivo es en plural
*/
    private $db;
    
    public function __construct()
    {
        $this->db = new Database;
    }

    public function getPosts(){
        $this->db->query("SELECT  * FROM posts");

        return $this->db->resultSet();
         
    }
}