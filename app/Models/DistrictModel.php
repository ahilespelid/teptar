<?php  
namespace App\Models;  
use App;

class DistrictModel extends \App\Data{
    public $table, $tableRole, $tableDistrict, $tableUsersBlock;
    public function __construct(){
         (object)$this->pdo = $this->connPDO();
          $this->table = $GLOBALS['db']['table']['districts'];
    }
    
    public function getDistricts($returnFalse = []){        
        $district = $this->getAll($this->table);
        return ((is_array($district) && !empty($district) && is_array(current($district))) ? $district : $returnFalse);
        
    }
    
    public function __destruct() {$this->pdo = null;}
}            