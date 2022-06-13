<?php  
namespace App\Models;  
use App;

class UserModel extends \App\Data{
    public $table;
    public function __construct() {
         (object)$this->pdo = $this->connPDO();
          $this->table = $GLOBALS['db']['table']['users'];
    }
    
    public function getUser(array $arg = []){        
        $user = $this->getWhere($this->table,$arg);
        return ((is_array($user) && !empty($user) && is_array(current($user))) ? $user[0] : false);
        
    }
    
    public function __destruct() {$this->pdo = null;}
}