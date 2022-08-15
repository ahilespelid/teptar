<?php  
namespace App\Models; 

class SupportModel extends \App\Data {
    public $table;

    public function __construct(){
        $this->table =$GLOBALS['db']['table']['support'];
         (object)$this->pdo = $this->connPDO();
    }
}
