<?php  
namespace App\Models;  
use App;

class UserModel extends \App\Data{
    public function __construct() {
         (object)$this->pdo = $this->connPDO();
    }
    
    public function getUser($login, $pass){
        $user = $this->getWhere('users',['login'=>$login, 'pass'=>$pass]);
        return ((is_array($user) && !empty($user)) ? $user : false);
    }
    
    public function __destruct() {$this->pdo = null;}
}