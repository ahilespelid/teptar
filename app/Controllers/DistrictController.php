<?php 
namespace App\Controllers;

class DistrictController{
    public $model, 
                $pProfile,
                $pLogin,
                $pIndex,
                $id,
                $token; 

    public function __construct(){
        $this->model = new \App\Models\DistrictModel;
        $this->pLogin = new \App\Views\LoginView;
        $this->pIndex = new \App\Views\IndexView;
    } 
    
    public function index($data){
        $is_districtUrl = str_starts_with(((!empty($_REQUEST['q']) && is_string($_REQUEST['q'])) ? mb_strtolower(trim($_REQUEST['q'])) : ''),'district');
 

    
    
    }
    
     public function createToken($user = []){
        if(is_array($user) && !empty($user) && !is_array(current((array) $user))  
            && !empty($user['pass']) && !empty($user['hash'])){        
             $hash = (!empty($user['pass']) && !empty($user['hash'])) ? $user['pass'].$user['hash'] : false;
             return $token = ($hash) ? hash('sha3-512', $hash) : false;
         }
     return false;}
 
    public function getToken(){return (!empty($this->token()) ?  $this->token() : false);}
    
}