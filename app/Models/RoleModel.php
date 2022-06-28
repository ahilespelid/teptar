<?php  
namespace App\Models;  
use App;

class RoleModel extends \App\Data{
    public $table, $tableRole;

    public function __construct(){
        $this->table = 'roles';
        (object)$this->pdo = $this->connPDO();
    }
}
