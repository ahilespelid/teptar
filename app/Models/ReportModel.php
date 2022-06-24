<?php  
namespace App\Models;  
use App;

class ReportModel extends \App\Data{
    public $table, $tableIndexes;
    public function __construct(){
         (object)$this->pdo = $this->connPDO();
          $this->table = $GLOBALS['db']['table']['reports'];
          $this->tableIndexes = $GLOBALS['db']['table']['indexes'];
    }
    
    public function getReports($returnFalse = []){        
        $reports = $this->getQuery("SELECT * FROM `".$this->table."` WHERE creating > CURDATE() - INTERVAL 7 YEAR ORDER BY id ASC;");
        if(is_array($reports) && !empty($reports) && is_array(current($reports))){$output = [];
            foreach($reports as $key => $report){foreach($report as $k => $v){$t =$this->getTableFromIdString($k);
                if(!empty($t)){
                    $output[$key][$k] = $this->getId($t,$v);}
                else{
                    $output[$key][$k] = $v;}
        }}}else{return false;}
        return (is_array($output) && !empty($output)) ? $output : $returnFalse;        
    }

    public function getIndexes($returnFalse = []){        
        $indexes = $this->getQuery("SELECT * FROM `".$this->tableIndexes."` WHERE date > CURDATE() - INTERVAL 7 YEAR ORDER BY id ASC;");
        if(is_array($indexes) && !empty($indexes) && is_array(current($indexes))){$output = [];
            foreach($indexes as $key => $index){foreach($index as $k => $v){$t =$this->getTableFromIdString($k);
                if(!empty($t)){
                    $output[$key][$k] = $this->getId($t,$v);}
                else{
                    $output[$key][$k] = $v;}
        }}}else{return false;}
        return (is_array($output) && !empty($output)) ? $output : $returnFalse;        
    }
    
    public function __destruct() {$this->pdo = null;}
}
