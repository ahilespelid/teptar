<?php 
namespace App\Controllers ;

class MainController{
    public      $pageLogin, $user;
    protected   $pageData = [];

    public function __construct() {
         $this->user = new UserController;
         $this->pageLogin  = $this->user->pageLogin;
    }
/*/ -------------------------------------------------------------- Главная страница -------------------------------------------------------------- /*/   
    public function index($q){
        $u =  $this->user; 
        $pLogin = $this->pageLogin; 
        
        if($u->isAuth()){
            pa($u);
            $u->view->render();
        }else{
            $pLogin->render();        
        }
        
 

        
        //pa($user);

        
        
 /*/ $auth = new AuthClass();
 
if (isset($_POST["login"]) && isset($_POST["password"])) { //Если логин и пароль были отправлены
    if (!$auth->auth($_POST["login"], $_POST["password"])) { //Если логин и пароль введен не правильно
        echo "Логин и пароль введен не правильно";
    }
}
 /*/ 

 
if (isset($_GET["is_exit"])) { //Если нажата кнопка выхода
    if ($_GET["is_exit"] == 1) {
        $auth->out(); //Выходим
        header("Location: ?is_exit=0"); //Редирект после выхода
    }
}
        
        //$t = $this->model->getRange(1,3, 'indexes', 'district');
        //\pa($t);
        //pa($this->model->getId('pages',1));

        if(!empty($q) && 'ex' == key($q)){
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
                  include $GLOBALS['path']['pub'].$GLOBALS['path']['out']['in']._DS_.$q['in'].'.php';
                  break;
                case 'region':
                  if(!empty($q['district'])){
                      $GET['district'] = $q['district'];}
                  include $GLOBALS['path']['pub'].$GLOBALS['path']['out']['in']._DS_.$q['in']._DS_.'index.php';
                  break;
                case 'profile':
                  include $GLOBALS['path']['pub'].$GLOBALS['path']['out']['in']._DS_.$q['in']._DS_.'index.php';
                  break;
                case 'settings':  $q['in'] ='profile';
                  include $GLOBALS['path']['pub'].$GLOBALS['path']['out']['in']._DS_.$q['in']._DS_.'index.php';
                  break;
                case 'logout':
                  include $GLOBALS['path']['pub'].$GLOBALS['path']['out']['in']._DS_.$q['in']._DS_.'index.php';
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
    }
 /*/ -------------------------------------------------------------- 404 страница -------------------------------------------------------------- /*/     
    public function notfound(){
        $path = realpath('./').DIRECTORY_SEPARATOR.'404.php';
       if(file_exists($path)){include($path);}
        exit();       
    }    
}