<?php  
namespace App\Models; 

class DeadlineModel extends \App\Data {
    public $table;

    public function __construct(){
        $this->table =$GLOBALS['db']['table']['deadline'];
         (object)$this->pdo = $this->connPDO();
    }
}
