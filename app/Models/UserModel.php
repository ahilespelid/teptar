<?php  
namespace App\Models;  
use App;

class UserModel extends \App\Data{
    public $table, $tableRole, $tableDistrict;
    public function __construct() {
         (object)$this->pdo = $this->connPDO();
          $this->table = $GLOBALS['db']['table']['users'];
          $this->tableRole = $GLOBALS['db']['table']['roles'];
          $this->tableDistrict = $GLOBALS['db']['table']['districts'];
    }
    
    public function getUser(array $arg = []){        
        $user = $this->getWhere($this->table,$arg);
        return ((is_array($user) && !empty($user) && is_array(current($user))) ? $user[0] : false);
        
    }
 
    public function getRole($id = 1){        
        $role = $this->getId($this->tableRole,$id);
        return ((is_array($role) && !empty($role) && !is_array(current($role))) ? $role : []);
        
    }
    
    public function getDistrict($id = 1){        
        $district = $this->getId($this->tableDistrict,$id);
        return ((is_array($district) && !empty($district) && !is_array(current($district))) ? $district : []);
        
    }
    
    public function __destruct() {$this->pdo = null;}
}