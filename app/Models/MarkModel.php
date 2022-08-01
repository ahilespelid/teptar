<?php  
namespace App\Models; 

class MarkModel extends \App\Data {
    public $table;

    public function __construct(){
        $this->table =$GLOBALS['db']['table']['marks'];
         (object)$this->pdo = $this->connPDO();
    }

    public function marksWithoutSV() {
        return $this->customSQL("SELECT * FROM marks WHERE num NOT LIKE '%_SV'");
    }
}
