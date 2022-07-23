<?php  
namespace App\Models; 

class MarkModel extends \App\Data {
    public $table;

    public function __construct(){
        $this->table =$GLOBALS['db']['table']['marks'];
         (object)$this->pdo = $this->connPDO();
    }
}
