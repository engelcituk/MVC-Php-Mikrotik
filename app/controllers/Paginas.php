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

        $this->view('paginas/login');


    }

    public function about(){

        $this->view('paginas/about');        
    }

    
}