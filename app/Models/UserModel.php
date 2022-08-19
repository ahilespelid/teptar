<?php  
namespace App\Models;

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
    
    public function getRule(string $role, int $uin){if(empty($role) && empty($uin)){return false;}
        $rule = $this->getQuery("SELECT * FROM `rules` WHERE FIND_IN_SET($uin, uin)<>0 AND subject_role LIKE '%$role%';");
        if(!is_array($rule) && empty($rule) && !is_array(current($rule))){return false;}
        array_walk_recursive($rule, function($v, $k) use (&$return) {if('right' == $k){$return[] = $v;}});
        return (is_array($return) && !empty($return)) ? $return : [];   
    }
    
    public function getDistrict($id = ''){if(empty($id)){return false;}        
        $district = $this->getId($this->tableDistrict,$id);
        return ((is_array($district) && !empty($district) && !is_array(current($district))) ? $district : []);
        
    }

    public function getUIN(array $arg = []){if(empty($arg)){return false;}        
        $uin = $this->getWhere($this->tableUIN,$arg);
        return ((is_array($uin) && !empty($uin) && is_array(current($uin))) ? $uin[0] : []);
    }

    public function inactiveUsers() {
        return $this->customSQL('
            SELECT
                user.id,
                user.login,
                user.firstname,
                user.lastname,
                user.secondname,
                user.phone,
                user.email,
                user.avatar,
                user.age,
                role.post,
                uin.slug,
                uin.owner AS district,
                uin.type
            FROM users user
            LEFT JOIN roles role ON user.id_role = role.id
            LEFT JOIN uin ON user.id_uin = uin.id
            WHERE user.active IS NULL
        ');
    }

    public function __destruct() {$this->pdo = null;}
}
