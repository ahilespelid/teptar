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
        $return = $this->getQuery($sql); $r = [];
        
        foreach($return as $key => $val){foreach($val as $k => $v){if('id_mark' == $k){$r[$v] []= $val;}}}
        
        return (is_array($r) && !empty($r)) ? $r : null;
    }
}
