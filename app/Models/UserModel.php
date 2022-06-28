<?php  
namespace App\Models;  
use App;

class UserModel extends \App\Data{
    public $table, $tableRole, $tableDistrict, $tableUsersBlock, $tableUIN;
    public function __construct() {
         (object)$this->pdo = $this->connPDO();
          $this->table = $GLOBALS['db']['table']['users'];
          $this->tableRole = $GLOBALS['db']['table']['roles'];
          $this->tableDistrict = $GLOBALS['db']['table']['districts'];
          $this->tableUsersBlock = $GLOBALS['db']['table']['usersBlock'];
          $this->tableUIN = $GLOBALS['db']['table']['tableUIN'];
    }
    
    public function getUser(array $arg = []){if(empty($arg)){return false;}        
        $user = $this->getWhere($this->table,$arg);
        return ((is_array($user) && !empty($user) && is_array(current($user))) ? $user[0] : false);
        
    }
 
    public function getRole($id = ''){if(empty($id)){return false;}        
        $role = $this->getId($this->tableRole,$id);
        return ((is_array($role) && !empty($role) && !is_array(current($role))) ? $role : []);
        
    }
    
    public function getDistrict($id = ''){if(empty($id)){return false;}        
        $district = $this->getId($this->tableDistrict,$id);
        return ((is_array($district) && !empty($district) && !is_array(current($district))) ? $district : []);
        
    }

    public function getUIN(array $arg = []){if(empty($arg)){return false;}        
        $uin = $this->getWhere($this->tableUIN,$arg);
        return ((is_array($uin) && !empty($uin) && is_array(current($uin))) ? $uin[0] : []);
        
    }
    
    public function __destruct() {$this->pdo = null;}
}
