<?php 
namespace App\Controllers ;
use App\Models;

class MainController{
    public      $view, $model;
    protected   $pageData = [];

    public function __construct() {
       //$this->view  = new App\View;
        $this->model = new \App\Models\PageModel;
    }
/*/ -------------------------------------------------------------- Главная страница -------------------------------------------------------------- /*/   
    public function index(){
       \pa($this->model->getId('pages',1));
       \pa($this->model->getId('pages',2));
       \pa($this->model->getId('pages',3));
       \pa($this->model->getId('pages',4));
      \pa($this->model->getAll());
        
        
 
 
 
 
 
 
 
 
 
 
 
 
 
 
        echo '<br>Главная страница<br>';
        phpinfo(INFO_CONFIGURATION);        
    }
 /*/ -------------------------------------------------------------- 404 страница -------------------------------------------------------------- /*/     
    public function notfound(){
        $path = realpath('./').DIRECTORY_SEPARATOR.'404.php';
       if(file_exists($path)){include($path);}
        exit();       
    }    
}