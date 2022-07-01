<?php  
namespace App\Models; 

class UINModel extends \App\Data {
    public $table, $tableRole;

    public function __construct(){
        $this->table =$GLOBALS['db']['table']['tableUIN'];
         (object)$this->pdo = $this->connPDO();
    }
}
