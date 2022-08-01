<?php  
namespace App\Models;

class IndexModel extends \App\Data{
    public $table;

    public function __construct(){
        $this->table = $GLOBALS['db']['table']['index'];
        $this->tableUser = $GLOBALS['db']['table']['users'];
        $this->tableMark = $GLOBALS['db']['table']['marks'];
        $this->tableRole = $GLOBALS['db']['table']['roles'];
        (object)$this->pdo = $this->connPDO();
    }
    public function reportActions($id_repotr){if(!is_numeric($id_repotr)){return false;}
        $sql = "SELECT * FROM `index` WHERE `id_report`= '$id_repotr' ORDER BY date DESC";  ///* / id_mark+0 ASC, ///*/
        $indexes = $this->getQuery($sql); $r = [];
        
        foreach($indexes as $key => $val){foreach($val as $k => $v){if('id_user' == $k){$r[$v][$val['id_mark']] [$val['id']]= $val;} } }
        ///*/ foreach($indexes as $key => $val){foreach($val as $k => $v){if('id_mark' == $k){$r[$v] []= $val;}}} ///*/

        if(is_array($r) && !empty($r)){$return = [];
            foreach($r as $user => $marksAction){
                $return[$user][0] = $this->getId($this->tableUser,$user); $return[$user][0]['id_role'] = $this->getId($this->tableRole,$return[$user][0]['id_role']);
                foreach($marksAction as $mark => $numberIndexAction){
                    $numMark = $this->getWhere($this->tableMark,['num'=>$mark],['symbol' => '=', 'quote' => true]);                    
                    $return[$user][$mark][] = ($numMark[0]) ?? null;
                    foreach($numberIndexAction as $num => $index){
                        $return[$user][$mark] []= $index; 
                    }}}}else{return false;}//*/ pa($return); //*/
        
        //pa($return);
        
        return (is_array($return) && !empty($return)) ? $return : null;
    }
} 