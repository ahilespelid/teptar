<?php  
namespace App\Models;

class IndexModel extends \App\Data{
    public $table, $tableRole;

    public function __construct(){
        $this->table = $GLOBALS['db']['table']['index'];
        (object)$this->pdo = $this->connPDO();
    }
}
