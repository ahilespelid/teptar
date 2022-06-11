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
    public function index($q){
        
        $t = $this->model->getRange(1,3, 'indexes', 'district');
        //\pa($t);
        //pa($this->model->getId('pages',1));

        if(!empty($q) && 'ex' == key($q)){
            switch ($q['ex']) {
                case 'districts':
                  include $GLOBALS['path']['dev'].$GLOBALS['path']['out']['ex']._DS_.$q['ex']._DS_.$q['ex'].'.php';
                  break;
                case 'district':
                  include $GLOBALS['path']['dev'].$GLOBALS['path']['out']['ex']._DS_.$q['ex']._DS_.$q['ex'].'.php';
                  break;
                case 'reports':
                  include $GLOBALS['path']['dev'].$GLOBALS['path']['out']['ex']._DS_.$q['ex']._DS_.$q['ex'].'.php';
                  break;
                case 'report':
                  include $GLOBALS['path']['dev'].$GLOBALS['path']['out']['ex']._DS_.$q['ex']._DS_.$q['ex'].'.php';
                  break;
                case 'report-form':
                  include $GLOBALS['path']['dev'].$GLOBALS['path']['out']['ex']._DS_.$q['ex']._DS_.$q['ex'].'.php';
                  break;
                case 'notifications':
                  include $GLOBALS['path']['dev'].$GLOBALS['path']['out']['ex']._DS_.$q['ex']._DS_.$q['ex'].'.php';
                  break;

              } exit();           
        }

        if(!empty($q) && 'in' == key($q)){
            switch ($q['in']) {
                case 'index':
                  include $GLOBALS['path']['dev'].$GLOBALS['path']['out']['in']._DS_.$q['in'].'.php';
                  break;
              } exit();           
        }
        
        
      /*/  
       \pa($this->model->getId('pages',1));
       \pa($this->model->getId('pages',2));
       \pa($this->model->getId('pages',3));
       \pa($this->model->getId('pages',4));
       \pa($this->model->getAll());
       /*/ 
        
 
 
 
 
 
 
 
 
 
 
 
 
 
 
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