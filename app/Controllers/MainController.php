<?php 
namespace App\Controllers ;

class MainController{
    public      $pageLogin, $user;
    protected   $pageData = [];

    public function __construct() {
         $this->user = new UserController;
    }
/*/ -------------------------------------------------------------- Главная страница -------------------------------------------------------------- /*/   
    public function index($q){$user =  $this->user;
        if (isset($_GET['in']) && 'logout' == $_GET['in']){$user->out(); $user->pLogin->render(); exit();}

        ($user->isToken()) ? $user->login($user->getLoginUser())->pIndex->render() : $user->pLogin->render();
        //pa($user);
        $q = $_REQUEST;


        if(!empty($q) && 'ex' == @key($q)){
            switch ($q['ex']) {
                case 'districts':
                  include $GLOBALS['path']['pub'].$GLOBALS['path']['out']['ex']._DS_.$q['ex']._DS_.$q['ex'].'.php';
                  break;
                case 'district':
                  include $GLOBALS['path']['pub'].$GLOBALS['path']['out']['ex']._DS_.$q['ex']._DS_.$q['ex'].'.php';
                  break;
                case 'reports':
                  include $GLOBALS['path']['pub'].$GLOBALS['path']['out']['ex']._DS_.$q['ex']._DS_.$q['ex'].'.php';
                  break;
                case 'report':
                  include $GLOBALS['path']['pub'].$GLOBALS['path']['out']['ex']._DS_.$q['ex']._DS_.$q['ex'].'.php';
                  break;
                case 'report-form':
                  include $GLOBALS['path']['pub'].$GLOBALS['path']['out']['ex']._DS_.$q['ex']._DS_.$q['ex'].'.php';
                  break;
                case 'notifications':
                  include $GLOBALS['path']['pub'].$GLOBALS['path']['out']['ex']._DS_.$q['ex']._DS_.$q['ex'].'.php';
                  break;

              } exit();           
        }

        if(!empty($q) && 'in' == key($q)){
            switch ($q['in']) {
                case 'index':
                  include $GLOBALS['path']['pub']._DS_.$GLOBALS['path']['out']['in']._DS_.$q['in'].'.php';
                  break;
                case 'region':
                  if(!empty($q['district'])){
                      $GET['district'] = $q['district'];}
                  include $GLOBALS['path']['pub']._DS_.$GLOBALS['path']['out']['in']._DS_.$q['in']._DS_.'index.php';
                  break;
                case 'profile':
                  include $GLOBALS['path']['pub']._DS_.$GLOBALS['path']['out']['in']._DS_.$q['in']._DS_.'index.php';
                  break;
                case 'settings':  $q['in'] ='profile';
                  include $GLOBALS['path']['pub']._DS_.$GLOBALS['path']['out']['in']._DS_.$q['in']._DS_.'index.php';
                  break;
                case 'logout':
                  include $GLOBALS['path']['pub']._DS_.$GLOBALS['path']['out']['in']._DS_.$q['in']._DS_.'index.php';
                  break;
              } exit();           
        }
    
    }
 /*/ -------------------------------------------------------------- 404 страница -------------------------------------------------------------- /*/     
    public function notfound(){
        $path = realpath('./').DIRECTORY_SEPARATOR.'404.php';
       if(file_exists($path)){include($path);}
        exit();       
    }    
}