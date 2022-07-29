<?php  
namespace App\Models;

class IndexModel extends \App\Data{
    public $table;

    public function __construct(){
        $this->table = $GLOBALS['db']['table']['index'];
        (object)$this->pdo = $this->connPDO();
    }
    public function reportActions($id_repotr){if(!is_numeric($id_repotr)){return false;}
        $sql = "SELECT * FROM `index` WHERE id_report = `$id_repotr` ORDER BY id_mark+0 ASC, date DESC";
        $indexes = $this->getQuery($sql); $r = [];
        
        foreach($indexes as $key => $val){foreach($val as $k => $v){if('id_mark' == $k){$r[$v] []= $val;}}}
        
        if(is_array($r) && !empty($r)){$return = [];
            foreach($r as $key => $index){foreach($index as $k => $v){$table =$this->getTableFromIdString($k);
                $return[$key][$k] =(!empty($table)) ? $this->getId($table,$v) : $return[$key][$k] = $v;
        }}}else{return false;}//*/ $return; //*/
        
        return (is_array($return) && !empty($return)) ? $return : null;
    }
}
