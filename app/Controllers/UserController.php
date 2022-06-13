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
                $login,
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
    
         if(is_array($data) && !empty($data) && !is_array(current($data))  
            && !empty($data['pass'])  && !empty($data['login'])
            && is_string($data['pass'])  && is_string($data['login'])){
                
                extract($data, EXTR_REFS);  /*/ Взяли данные /*/

                $login = (!empty($login)) ? $login : false;
                $pass = (!empty($pass)) ? $pass : false;
                
                $user = $this->model->getUser(['login' => $login, 'pass' => md5($pass)]);
                pa($user);
                if(is_array($user) && !empty($user)){/*/ Взяли пользователя из базы /*/
          
                      $this->login              = $login;
                      $this->hash              = $hash             = (empty($user['hash']))              ? ((!empty($hash))              ? $hash : '')             : $user['hash'];
                      $this->token             = $token            = (empty($user['token']))            ? ((!empty($token))             ? $token : '')            : $user['token'];
                      
                      $this->email             = $email            = (empty($user['email']))            ? ((!empty($email))             ? $email : '')            : $user['email'];
                      $this->phone            = $phone           = (empty($user['phone']))           ? ((!empty($phone))            ? $phone : '')           : $user['phone'];
                      $this->lastname       = $lastname      = (empty($user['lastname']))      ? ((!empty($lastname))       ? $lastname : '')      : $user['lastname'];
                      $this->firstname      = $firstname      = (empty($user['firstname']))      ? ((!empty($firstname))      ? $firstname : '')      : $user['firstname'];
                      $this->secondname = $secondname = (empty($user['secondname'])) ? ((!empty($secondname)) ? $secondname : '') : $user['secondname'];
                      $this->age                = $age               = (empty($user['age']))                ? ((!empty($age))               ? $age : '')                : $user['age'];
                      
                      $this->district           = $district          = (!empty($user['id_district']))     ? $this->model->getDistrict($user['id_district']) : [];
                      $this->role                = $role               = (!empty($user['id_role']))          ? $this->model->getRole($user['id_role'])           : [];

            
                
                }
                
         }else{$this->pLogin->render();}
          pa($this);
         
         return false;
        
        //pa($this);
       // pa($data);
        
         /*
        $hash
        $token

        $email 
        $phone
        $lastname
        $firstname
        $secondname
        $age
        */
        $username = (!empty($username)) ? trim($username) : '';
        $password = (!empty($password)) ? trim($password) : '';
        $uin = (!empty($uin)) ? trim($uin) : '';

        //$user = $model->getUser(['login' => $username]); /*/ Взяли пользователя из базы /*/

        if(!empty($user) && md5($password) == $user['pass']){
            $hash = (!empty($user['pass']) && !empty($user['hash'])) ? $user['pass'].$user['hash'] : false;
            $token = ($hash) ? hash('sha3-512', $hash) : false;

            if($token != $user['token']){
                $model->update($model->table,['id' => $user['id'] ,'token'=>$token]);

        }


    
    }}
    
     public function getToken($user){
        $token = $this->model->getId($this->model->table,$user['id'])['token'];        
        return (($token) ? $token : false); 
    }
 
     public function isAuth() {
        if (isset($_SESSION["token"])) {return $_SESSION["token"];}
        return false; 
    }
   
    public function auth($user = [], $password = ''){
        if(!is_array($user) && empty($user) && is_array(current($user))  
            && !empty($user['id']) && !empty($user['pass']) && !empty($user['hash'])
            && is_string($password) && !empty($password)){return false;}
        
       if(md5($password) == $user['pass']){
         $hash = (!empty($user['pass']) && !empty($user['hash'])) ? $user['pass'].$user['hash'] : false;
         $token = ($hash) ? hash('sha3-512', $hash) : false;
         
         if($token != $user['token']){
             $this->model->update($this->model->table,['id' => $user['id'] ,'hash'=>date_timestamp_get(date_create()),'token'=>$token]);}

        if(empty($token)){return false;}
        
        
        
        if ($login == $this->login && $passwors == $this->pass){
            $_SESSION["token"] = true; $_SESSION["login"] = $login; 
            return true;
        }else{
            $_SESSION["token"] = false;
            return false; 
        }
    }}
    
    public function getLogin() {
        return (($this->isAuth()) ?  $_SESSION["login"] : false);
    }
        
    public function out() {
        $_SESSION = array(); 
        session_destroy(); 
    }
}