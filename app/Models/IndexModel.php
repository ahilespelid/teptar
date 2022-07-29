<?php  
namespace App\Models;

class IndexModel extends \App\Data{
    public $table;

    public function __construct(){
        $this->table = $GLOBALS['db']['table']['index'];
        (object)$this->pdo = $this->connPDO();
    }
    public function reportActions($id_repotr){if(!is_numeric($id_repotr)){return false;}
        $sql = "SELECT i.`id`, i.`id_uin`, i.`index`, i.`id_mark`, i.`id_status`, i.`date`, i.`id_user`, u.`login`, u.`avatar`, u.`firstname`, u.`secondname`, u.`lastname` FROM `index` i
        INNER JOIN `users` u ON i.`id_user`=u.id AND i.`date`>=(SELECT MAX(m2.`date`) FROM `index` m2 WHERE m2.`id_report`=i.`id_report` AND m2.`id_uin`=i.`id_uin` AND m2.`id_mark`=i.`id_mark` AND m2.`date` NOT IN (SELECT MAX(n.`date`) FROM `index` n WHERE n.`id_report`=i.`id_report` AND n.`id_uin`=i.`id_uin` AND n.`id_mark`=i.`id_mark`))
        WHERE i.`id_report`='$id_repotr' AND i.`id_mark` IN (SELECT num FROM `marks`) ORDER BY i.`id_mark`+0;";
        $return = $this->getQuery($sql); $r = [];
        foreach($return as $key => $val){foreach($val as $k => $v){if('id_mark' == $k){$r[$v] []= $val;}}}
        
        return (is_array($r) && !empty($r)) ? $r : null;
    }
}
