<?php  
namespace App\Models; 

class CountModel extends \App\Data {
    public $table;

    public function __construct(){
        $this->table =$GLOBALS['db']['table']['count'];
         (object)$this->pdo = $this->connPDO();
    }
}
