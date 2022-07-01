<?php  
namespace App\Models;

class RoleModel extends \App\Data{
    public $table, $tableRole;

    public function __construct(){
        $this->table = $GLOBALS['db']['table']['roles'];
        (object)$this->pdo = $this->connPDO();
    }
}
