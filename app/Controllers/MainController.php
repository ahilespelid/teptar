<?php 
namespace App\Controllers ;

class MainController{
    public      $pageLogin, $user, $districts;
    protected   $pageData = [];

    public function __construct() {
         $this->user = new UserController;
         $this->districts = new DistrictController;
    }
/*/ -------------------------------------------------------------- Главная страница -------------------------------------------------------------- /*/   
    public function index($q){$user =  $this->user;
        if (isset($_GET['in']) && 'logout' == $_GET['in']){$user->out(); $user->pLogin->render(); exit();}

        
        
        
        ($user->isToken()) ? $user->login($user->getLoginUser())->pIndex->render() : $user->pLogin->render();
        
        
        
        //pa($user);
    }
 /*/ -------------------------------------------------------------- 404 страница -------------------------------------------------------------- /*/     
    public function notfound(){
        $path = realpath('./').DIRECTORY_SEPARATOR.'404.php';
       if(file_exists($path)){include($path);}
        exit();       
    }    
}