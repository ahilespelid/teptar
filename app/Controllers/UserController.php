<?php 
namespace App\Controllers;
session_start([
    'cookie_lifetime' => 3600,
]);

class UserController{
    public $model, $pageLogin;
    private $token; 

    public function __construct() {
        $this->pageLogin  = new \App\Views\LoginView;      
        $this->model = new \App\Models\UserModel;
    }
 
      public function login($q){
           $model = $this->model; 
           $pLogin = $this->pageLogin;
          
          if(is_array($q) && !empty($q)){extract($q, EXTR_REFS);}  /*/ Взяли данные из формы авторизации /*/
          $username = (!empty($username)) ? trim($username) : '';
          $password = (!empty($password)) ? trim($password) : '';
          $uin = (!empty($uin)) ? trim($uin) : '';
         
          $u = $model->getUser(['login' => $username]); /*/ Взяли пользователя из базы /*/

           
           
          if(!empty($u) && md5($password) == $u['pass']){
             $hash = (!empty($u['pass']) && !empty($u['hash'])) ? $u['pass'].$u['hash'] : false;
             $token = ($hash) ? hash('sha3-512', $hash) : false;
             
             if($token){
                 echo $token.'<br>';
                 echo $model->update($model->table,['id' => $u['id'] ,'token'=>$token]);
                 
             }
             
             
             
              //echo $hash;
                 
              
              //pa($u);
          }else{
              $pLogin->render();
          }


          
          
      }
    
     public function isAuth() {
        if (isset($_SESSION["token"])) {return $_SESSION["token"];}
        return false; 
    }
   
    public function auth($token=''){
        if(empty($token)){return false;}
        
        
        
        if ($login == $this->login && $passwors == $this->pass){
            $_SESSION["token"] = true; $_SESSION["login"] = $login; 
            return true;
        }else{
            $_SESSION["token"] = false;
            return false; 
        }
    }
    
    public function getLogin() {
        return (($this->isAuth()) ?  $_SESSION["login"] : false);
    }
        
    public function out() {
        $_SESSION = array(); 
        session_destroy(); 
    }
}