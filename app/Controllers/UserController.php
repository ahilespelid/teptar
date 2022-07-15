<?php

namespace App\Controllers;

session_start([
    'cookie_lifetime' => ($GLOBALS['lifeToken'] > 60) ? $GLOBALS['lifeToken'] : 60,
]);

class UserController extends AbstractController{
    public  $model,
            $id,
            $login,
            $pass,
            $hash,
            $district,
            $uin,
            $role,
            $rule,
            $avatar,
            $email,
            $phone,
            $lastname,
            $firstname,
            $secondname,
            $age,
            $token;

    public function __construct(){
        $this->model = new \App\Models\UserModel;
    }

    public function login($data = []){
        if(str_ends_with($_SERVER['REQUEST_URI'], '/')){$_SERVER['REQUEST_URI'][strlen($_SERVER['REQUEST_URI']) - 1] = ' ';}
        $is_loginUrl = 'login' ==  trim($_SERVER['REQUEST_URI']);

        if(is_array($data) && !empty($data)  
        && !empty($data['pass'])  && !empty($data['login']) && !empty($data['uin']['name'])
        && is_string($data['pass'])  && is_string($data['login']) && is_string($data['uin']['name'])) {

            extract($data, EXTR_REFS);  /*/ Взяли данные /*/

            $login = (!empty($login)) ? $login : false;
            $pass = (!empty($pass)) ? $pass : false;
           
            $user = (!$is_loginUrl) ? $data : $this->model->getUser(['login' => $login, 'pass' => md5($pass)]); /*/ Взяли пользователя из базы /*/

            if (is_array($user) && !empty($user)) {
                $hashNew = date_timestamp_get(date_create());
                $this->id               = $user['id'];
                $this->login            = $user['login'];
                $this->pass             = $user['pass'];
                $this->hash             = (empty($user['hash'])) ? $hashNew : $user['hash'];
                $this->token            = $user['token'] = ($token = $this->createToken(['pass' => $this->pass, 'hash' => $this->hash])) ? $token : $user['token'];

                $this->email            = (empty($user['email'])) ? '': $user['email'];
                $this->phone            = (empty($user['phone'])) ? '': $user['phone'];
                $this->lastname         = (empty($user['lastname'])) ? '': $user['lastname'];
                $this->firstname        = (empty($user['firstname'])) ? '': $user['firstname'];
                $this->secondname       = (empty($user['secondname'])) ? '': $user['secondname'];
                $this->avatar           = (empty($user['avatar'])) ? '': $user['avatar'];
                $this->age              = (empty($user['age'])) ? '': $user['age'];

                $this->district         = $user['district'] = (!empty($user['id_district'])) ? $this->model->getDistrict($user['id_district']) : [];
                $this->uin              = $user['uin'] = (!empty($uin['name']) && !empty($user['id_uin'])) ? $this->model->getUIN(['id' => $user['id_uin'], 'name' => $uin['name']]) : [];
                $this->role             = $user['role'] = (!empty($user['id_role'])) ? $this->model->getRole($user['id_role']) : [];
                $this->rule             = $user['rule'] = (!empty($user['role']['subject']) && !empty($user['id_uin'])) ? $this->model->getRule($user['role']['subject'], $user['id_uin']) : [];
                
                if (!empty($this->uin)) {
                    if($this->model->update($this->model->table,['id' => $user['id'] ,'hash'=>$hashNew,'token'=>$this->token])
                    && $this->model->insert($this->model->tableUsersBlock,['id_user' => $user['id'],'hash'=>$this->hash, 'token'=>$this->token])){
                        $is_auth = $this->auth($user);

                        if ($is_loginUrl && $is_auth) {
                            header('Location: /');
                        } elseif($is_loginUrl && !$is_auth) {
                            $this->render('/leader/home/login.php');
                        } elseif(!$is_loginUrl && $is_auth) {
                            return $this;
                        } else {
                            return false;
                        }
                    }
                }
            }
        }

        if ($is_loginUrl) {
         $this->render('/leader/home/login.php');
        } else {
         return false;
        }
    }

    public function createToken($user = []) {
    if (is_array($user) && !empty($user) && !is_array(current((array) $user))
        && !empty($user['pass']) && !empty($user['hash'])) {
         $hash = $user['pass'] . $user['hash'];
         return $token = ($hash) ? hash('sha3-512', $hash) : false;
    }
    return false;}
 
     public function isToken() {
        if (!empty($_SESSION['user']) && !empty($_SESSION['token'])) {
            return true;
        }
        return false; 
    }

    public function auth($user = []) {
       if(is_array($user) && !empty($user) && !is_array(current((array) $user))  
            && !empty($user['id']) && !empty($user['token'])) {
            $_SESSION['user'] = $user; $_SESSION['token'] = $user['token']; 
            return true;
        } else {
            $_SESSION['user'] = $_SESSION['token'] = false;
            return false; 
        }  
    }

    public function getToken() {
        return (($this->isToken()) ?  $_SESSION['token'] : false);
    }

    public function getLoginUser() {
        return (($this->isToken()) ?  $_SESSION['user'] : false);
    }

    public function out() {
        $_SESSION = array();
        session_destroy();
        header('Location: /');
    }
}
