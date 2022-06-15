<?php 
namespace App\Controllers;
session_start([
    'cookie_lifetime' => 3600,
]);

class UserController{
    public $model, 
                $pProfile,
                $pLogin,
                $pIndex,
                $id,
                $login,
                $pass,
                $hash,
                $district,
                $role,
                $email,
                $phone,
                $lastname,
                $firstname,
                $secondname,
                $age,
                $token; 

    public function __construct(){
        $this->model = new \App\Models\UserModel;
        $this->pLogin = new \App\Views\LoginView;
        $this->pProfile = new \App\Views\ProfileView;
        $this->pIndex = new \App\Views\InView;
        
        
    } 
    
    public function login($data = []){
        $is_loginUrl = str_starts_with(((!empty($_REQUEST['q']) && is_string($_REQUEST['q'])) ? mb_strtolower(trim($_REQUEST['q'])) : ''),'login');
         if(is_array($data) && !empty($data) && !is_array(current($data))  
            && !empty($data['pass'])  && !empty($data['login']) && !empty($data['uin'])
            && is_string($data['pass'])  && is_string($data['login']) && is_string($data['uin'])){
                
                extract($data, EXTR_REFS);  /*/ Взяли данные /*/

                $login = (!empty($login)) ? $login : false;
                $pass = (!empty($pass)) ? $pass : false;
                $user = (!$is_loginUrl) ? $data : $this->model->getUser(['login' => $login, 'pass' => md5($pass)]); /*/ Взяли пользователя из базы /*/
                $user['uin'] = (!empty($user['uin'])) ? $user['uin'] : $uin;
                 
                if(is_array($user) && !empty($user)){$hashNew = date_timestamp_get(date_create());
                      $this->id                   = $user['id'];
                      $this->login              = $user['login'];
                      $this->pass               = $user['pass'];
                      $this->hash               = (empty($user['hash']))            ? $hashNew : $user['hash'];
                      $this->token              = $user['token'] = ($token = $this->createToken(['pass' => $this->pass, 'hash' => $this->hash])) ? $token : $user['token'];
                      
                      $this->email             = (empty($user['email']))            ? '': $user['email'];
                      $this->phone            = (empty($user['phone']))           ?  '': $user['phone'];
                      $this->lastname       = (empty($user['lastname']))      ?  '': $user['lastname'];
                      $this->firstname       = (empty($user['firstname']))     ?  '': $user['firstname'];
                      $this->secondname = (empty($user['secondname'])) ? '': $user['secondname'];
                      $this->age                = (empty($user['age']))                ? '': $user['age'];
                      
                      $this->district           = $user['district'] = (!empty($user['id_district'])) ? $this->model->getDistrict($user['id_district']) : [];
                      $this->role                = $user['role'] = (!empty($user['id_role'])) ? $this->model->getRole($user['id_role']) : [];
                      
                      
                      if($user['uin'] == $this->district['uin']){
                      if($this->model->update($this->model->table,['id' => $user['id'] ,'hash'=>$hashNew,'token'=>$this->token])
                        && $this->model->insert($this->model->tableUsersBlock,['id_user' => $user['id'],'hash'=>$this->hash, 'token'=>$this->token])){
                            $is_auth = $this->auth($user);
                            if($is_loginUrl && $is_auth){header('Location: /');}
                            elseif($is_loginUrl && !$is_auth){$this->pLogin->render();}
                            elseif(!$is_loginUrl && $is_auth){return $user;}
                            else{return false;}
                        }}
                }
         } 
         if($is_loginUrl){$this->pLogin->render();}else{
    return 'be';}}
    
     public function createToken($user = []){
        if(is_array($user) && !empty($user) && !is_array(current((array) $user))  
            && !empty($user['pass']) && !empty($user['hash'])){        
             $hash = (!empty($user['pass']) && !empty($user['hash'])) ? $user['pass'].$user['hash'] : false;
             return $token = ($hash) ? hash('sha3-512', $hash) : false;
         }
     return false;}
 
     public function isToken() {
        if (!empty($_SESSION["user"]) && !empty($_SESSION["token"])) {return true;}
        return false; 
    }
   
    public function auth($user = []){       
       if(is_array($user) && !empty($user) && !is_array(current((array) $user))  
            && !empty($user['id']) && !empty($user['token'])){
            $_SESSION['user'] = $user; $_SESSION["token"] = $user['token']; 
            return true;
        }else{
            $_SESSION["user"] = $_SESSION["token"] = false;
            return false; 
        }  
    }
    
    public function getLoginUser(){return (($this->isToken()) ?  $_SESSION["user"] : false);}
        
    public function out(){$_SESSION = array(); session_destroy();}
}