<?php  
namespace App\Models;

class StatusModel extends \App\Data{
    public $table, $tableRole;

    public function __construct(){
        $this->table = $GLOBALS['db']['table']['status'];
        (object)$this->pdo = $this->connPDO();
    }
}
