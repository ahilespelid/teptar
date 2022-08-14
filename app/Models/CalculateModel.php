<?php  
namespace App\Models; 

class CalculateModel extends \App\Data{
    public 
    $table, 
    $tableCount,
    $tableIndexes;
    public function __construct(){
         (object)$this->pdo = $this->connPDO();
          $this->table = $GLOBALS['db']['table']['calculate'];
          $this->tableCount = $GLOBALS['db']['table']['count'];
          $this->tableIndexes = $GLOBALS['db']['table']['indexes'];
    }

    public function markGeneralRating($mark, $year) {
        $sql = '
            SELECT slug, owner, firstname, lastname, secondname, login, avatar, `mark_' . $mark . '` AS `index`
            FROM kp
            LEFT JOIN reports ON kp.id_report = reports.id
            LEFT JOIN uin ON reports.id_uin = uin.id
            LEFT JOIN users ON reports.id_userBoss = users.id
            LEFT JOIN deadline ON deadline.id = reports.id_deadline
            WHERE deadline.year = ' . $year . '
            ORDER BY `index` DESC
        ';

        return $this->customSQL($sql);
    }

    public function markDistrictRating($mark, $district) {
        if (str_contains($mark, '_SV')) {
            $mark = str_replace('_SV', '', $mark) . '.1';
            $index = 'index_sv';
        } else {
            $index = 'index_final';
        }

        $sql = '
            SELECT ' . $index . ' as `index`, DATE_FORMAT(deadline,"%Y") as `date`
            FROM calculate
            LEFT JOIN uin on calculate.id_uin = uin.id
            WHERE mark = ' . $mark . '
            AND slug = "' . $district . '"
            ORDER BY deadline DESC
        ';

        return $this->customSQL($sql);
    }

    public function getReports($periodYears = 4) {
        $argv = array('cond' => array('creating'=>'CURDATE() - INTERVAL '.$periodYears.' YEAR'), 'sign' => array(['simbol' => '>', 'quote' => true]));
//
/*/       
        $reports = $this->getWhere($this->table,$argv['cond'], $argv['sign'], 'ORDER BY `id` ASC');

        if(is_array($reports) && !empty($reports) && is_array(current($reports))){$return = [];
            foreach($reports as $key => $report){foreach($report as $k => $v){
                
                $t =$this->getTableFromIdString($k);
                $return[$key][$k] =(!empty($t)) ? $this->getId($this->table,$v) : $return[$key][$k] = $v;
                
        }}}else{return false;}
        return (is_array($return) && !empty($return)) ? $return : false;
///*/        
    }

    public function getIndexes($idMark = [],  $iDdistrict = [], $idReport = [], $status = 5){
        $idMark = (empty($idMark)) ? [ '1','2','3','4','5','6','7','8','8.1','8.2','8.3','8.4','8.5','8.6','9','10','11','13','14','15','16','17','18','19','20','20.1','20.2','20.3','21','22','23','23.1','24','24.1','25','25.1','26','26.1','26.2','27','28','29','30','31','32','33','34','35','36','37','38','39','39.1','39.2','39.3','39.4','39.5','40','40.1','40.2','40.3','40.4','40.5','41','41.1','41.2','41.3','41.4','41.5', ] 
        : ((is_array($idMark) && !is_array(current($idMark))) ? $idMark :  false);
        $iDdistrict = (is_array($iDdistrict) && !is_array(current($iDdistrict))) ? $iDdistrict : false;
        $idReport = (is_array($idReport) && !is_array(current($idReport))) ? $idReport : false;
        (int) $status = (!empty($status) && is_int($status)) ? $status : 5;
        
        $sql = "SELECT * FROM `index` t WHERE 
        t.`id_mark` IN ('".implode("', '", $idMark)."') AND 
        t.`id_uin` IN ('".implode("', '", $iDdistrict)."') AND 
        t.`id_status`='".$status."' AND
        t.`id`";
        if($idReport){
            $sql .= ' IN (';
        foreach($idReport as $k => $report){$sql .= "(SELECT i".$k.".`id` FROM `index` i".$k." WHERE i".$k.".`id_mark`= t.`id_mark` AND i".$k.".`id_uin`= t.`id_uin` AND i".$k.".`id_report`= '".$report."' AND i".$k.".`id_status`= t.`id_status` ORDER BY `date` DESC LIMIT 1),";}
            $sql = rtrim($sql,','); $sql .= ') ORDER BY t.`date` DESC, t.`id` DESC';      
        }$sql .= ';';
        ///*/ 
        $indexes = $this->getQuery($sql); ///*/ echo $sql.'<br><br>'; ///*/

        if(is_array($indexes) && !empty($indexes)){$return = [];
            foreach($indexes as $key => $index){foreach($index as $k => $v){$table =$this->getTableFromIdString($k);
                $return[$key][$k] =(!empty($table)) ? $this->getId($table,$v) : $return[$key][$k] = $v;
        }}}else{return false;}//*/ $return; //*/
        return (is_array($return) && !empty($return)) ? $return : false;        
    } 
//
/*/
    public function getInd($idMark = [],  $iDdistrict = [], $idReport = [], $status = 5, $yearFromBackToCurrentInterval = '', $yearBackInterval = ''){
        $idMark = (empty($idMark)) ? [ '1','2','3','4','5','6','7','8','8.1','8.2','8.3','8.4','8.5','8.6','9','10','11','13','14','15','16','17','18','19','20','20.1','20.2','20.3','21','22','23','23.1','24','24.1','25','25.1','26','26.1','26.2','27','28','29','30','31','32','33','34','35','36','37','38','39','39.1','39.2','39.3','39.4','39.5','40','40.1','40.2','40.3','40.4','40.5', ] 
                                                        : ((is_array($idMark) && !is_array(current($idMark))) ? $idMark :  false);
        $iDdistrict = (is_array($iDdistrict) && !is_array(current($iDdistrict))) ? $iDdistrict : false;
        $idReport = (is_array($idReport) && !is_array(current($idReport))) ? $idReport : false;
        (int) $yearBackInterval = ('' == $yearBackInterval || 0 > $yearBackInterval) ? false : $yearBackInterval;
        (int) $yearFromBackToCurrentInterval = ('' == $yearFromBackToCurrentInterval || 0 > $yearFromBackToCurrentInterval) ? false : $yearFromBackToCurrentInterval;
        (int) $status = (!empty($status) && is_int($status)) ? $status : 5;
        if(is_int($yearFromBackToCurrentInterval)){
            $argv = ['cond' => array(
                            'date' => 'MAKEDATE(YEAR(SUBDATE(CURDATE(), INTERVAL '.($yearFromBackToCurrentInterval).' YEAR)),1)',
                          ), 
                            'sign' => array(['simbol' => '>', 'quote' => false])];
        }
        if(is_int($yearBackInterval)){
            $argv = ['cond' => array(
                            'date' => 'MAKEDATE(YEAR(SUBDATE(CURDATE(), INTERVAL '.($yearBackInterval).' YEAR)),1)',
                            'date ' => 'LAST_DAY(MAKEDATE(YEAR(SUBDATE(CURDATE(), INTERVAL '.$yearBackInterval.' YEAR)),365))',
                          ), 
                            'sign' => array(['simbol' => '>', 'quote' => false],['simbol' => '<', 'quote' => false])];
        }
        if($idMark){
            $argv['cond']['id_mark'] = "('".implode("', '", $idMark)."')"; $argv['sign'][] = ['simbol' => 'IN', 'quote' => false];
        }
        if($iDdistrict){
            $argv['cond']['id_uin'] = "('".implode("', '", $iDdistrict)."')";$argv['sign'][] = ['simbol' => 'IN', 'quote' => false];
        }
        if($idReport){
            $argv['cond']['id_report'] = "('".implode("', '", $idReport)."')";$argv['sign'][] = ['simbol' => 'IN', 'quote' => false];
        }
        if($status){
            $argv['cond']['id_status'] = 5;$argv['sign'][] = ['simbol' => '=', 'quote' => true];
        }        
        $indexes = $this->getWhere($this->tableIndexes, $argv['cond'], $argv['sign'], 'GROUP BY `id_report` ORDER BY `date` DESC');
        if(is_array($indexes) && !empty($indexes)){$return = [];
            foreach($indexes as $key => $index){foreach($index as $k => $v){$table =$this->getTableFromIdString($k);

                $return[$key][$k] =(!empty($table)) ? $this->getId($table,$v) : $return[$key][$k] = $v;

        }}}else{return false;}/// pa($argv); ///
        return (is_array($return) && !empty($return)) ? $return : false;        
    } ///*/

    public function __destruct() {$this->pdo = null;}
}
