<?php 
namespace App\Controllers;
session_start();

class UserController{
    public $model, $pageLogin;
    private $login = '', $pass = ''; 

    public function __construct() {
        $this->pageLogin  = new \App\Views\LoginView;      
        $this->model = new \App\Models\UserModel;
    }
 
      public function login($q){
          $u = $this->model->getUser();

          pa($u);
          pa($q);
          if(is_array($q) && !empty($q)){extract($q, EXTR_REFS);}
          
          $this->pageLogin->render($u);
      }
    
     public function isAuth() {
        if (isset($_SESSION["is_auth"])) {return $_SESSION["is_auth"];}
        return false; 
    }
   
    public function auth($login, $passwors){
        if ($login == $this->login && $passwors == $this->pass){
            $_SESSION["is_auth"] = true; $_SESSION["login"] = $login; 
            return true;
        }else{
            $_SESSION["is_auth"] = false;
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