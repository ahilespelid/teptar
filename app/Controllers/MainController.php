<?php 
namespace App\Controllers ;

use Exception;

class MainController extends AbstractController {
    public      $pageLogin, $user, $districts;
    protected   $pageData = [];

    public function __construct() {
         $this->user = new UserController;
         $this->districts = new DistrictController;
    }

/*/ ------------ Главная страница ------------ /*/

//    public function index($q){$user =  $this->user;
//        if (isset($_GET['in']) && 'logout' == $_GET['in']){$user->out(); $user->pLogin->render(); exit();}
//
//
//
//
//        ($user->isToken()) ? $user->login($user->getLoginUser())->pIndex->render() : $user->pLogin->render();
//
//        //pa($user);
//    }

    /**
     * @throws Exception
     */
    public function index(){
        if(isset($_GET['logout'])){$this->user->out(); $this->render('/login/index.php'); exit();}
        
        
        if($this->user->isToken()){
            if($user = $this->user->login($this->user->getLoginUser())){
                pa($user);
                
            }
        }else{$this->render('/login/index.php');}
        
       
    }

 /*/ ------------ 404 страница ------------ /*/

    public function notFound(){

        $this->render('/errors/404.php');
//        $path = realpath('./').DIRECTORY_SEPARATOR.'404.php';
//        if(file_exists($path)){include($path);}
//        exit();
    }
}
