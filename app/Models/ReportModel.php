<?php  
namespace App\Models; 

class ReportModel extends \App\Data{
    public $table, $tableIndexes;
    public function __construct(){
         (object)$this->pdo = $this->connPDO();
          $this->table = $GLOBALS['db']['table']['reports'];
          $this->tableIndexes = $GLOBALS['db']['table']['indexes'];
    }

    public function findDistrictReportsByDate($date, $district = null, array $orderBy = null, int $limit = null) {
        $orderSQL = '';
        $limitSQL = '';
        $districtSQL = '';

        if ($district) {
            $districtSQL = " id_uin = " . $district ." AND";
        }

        // Генерация строки запроса SQL для необязательного параметра сортировки $orderBy
        if ($orderBy) {
            $iteration = 1;
            foreach ($orderBy as $column => $order) {
                ($iteration == 1) ? $orderSQL .= ' ORDER BY ' : $orderSQL .= ', ' ;
                $orderSQL .= $column . ' ' . $order;
                $iteration += 1;
            }
        }

        // Генерация строки запроса SQL для необязательных параметров лимита $limit и офсета $offset
        if ($limit) {
            $limitSQL = " LIMIT " . $limit;
        }

        // Генерация всего запроса из результатов предыдуще генерированных строков
        $sql = "SELECT * FROM " . $this->table . " WHERE" . $districtSQL . " submitting BETWEEN '" . $date . "-01-01 00:00:01' AND '" . $date . "-12-31 23:59:59'" . $orderSQL . $limitSQL;

        $query = $this->pdo->query($sql);

        return $query->fetchAll();
    }

    public function jsonDistrictReportsByDate($date, $district = null, array $orderBy = null, int $limit = null) {
        return json_encode($this->findDistrictReportsByDate($date, $district, $orderBy, $limit), JSON_UNESCAPED_UNICODE);
    }

    public function getReports($periodYears = 5){
        $argv = array('cond' => array('creating'=>'CURDATE() - INTERVAL '.$periodYears.' YEAR'), 'sign' => array(['simbol' => '>', 'quote' => true]));       
        $reports = $this->getWhere($this->table,$argv['cond'], $argv['sign'], 'ORDER BY `id` ASC');
        
        if(is_array($reports) && !empty($reports) && is_array(current($reports))){$return = [];
            foreach($reports as $key => $report){foreach($report as $k => $v){
                
                $t =$this->getTableFromIdString($k);
                $return[$key][$k] =(!empty($t)) ? $this->getId($this->table,$v) : $return[$key][$k] = $v;
                
        }}}else{return false;}
        return (is_array($return) && !empty($return)) ? $return : false;        
    }                                                                           

    public function getIndexes($idMark = [],  $iDdistrict = [], $idReport = [], $yearFromBackToCurrentInterval = '', $yearBackInterval = ''){
        $idMark = (empty($idMark)) ? [ '1','2','3','4','5','6','7','8','8.1','8.2','8.3','8.4','8.5','8.6','9','10','11','13','14','15','16','17','18','19','20','20.1','20.2','20.3','21','22','23','23.1','24','24.1','25','25.1','26','26.1','26.2','27','28','29','30','31','32','33','34','35','36','37','38','39','39.1','39.2','39.3','39.4','39.5','40','40.1','40.2','40.3','40.4','40.5', ] 
                                                        : ((is_array($idMark) && !is_array(current($idMark))) ? $idMark :  false);
        $iDdistrict = (is_array($iDdistrict) && !is_array(current($iDdistrict))) ? $iDdistrict : false;
        $idReport = (is_array($idReport) && !is_array(current($idReport))) ? $idReport : false;
        (int) $yearBackInterval = ('' == $yearBackInterval || 0 > $yearBackInterval) ? false : $yearBackInterval;
        (int) $yearFromBackToCurrentInterval = ('' == $yearFromBackToCurrentInterval || 0 > $yearFromBackToCurrentInterval) ? false : $yearFromBackToCurrentInterval;
       
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
        
        $indexes = $this->getWhere($this->tableIndexes, $argv['cond'], $argv['sign'], 'ORDER BY `date` DESC');
        
        if(is_array($indexes) && !empty($indexes)){$return = [];
            foreach($indexes as $key => $index){foreach($index as $k => $v){$table =$this->getTableFromIdString($k);
            
                $return[$key][$k] =(!empty($table)) ? $this->getId($table,$v) : $return[$key][$k] = $v;
                
        }}}else{return false;}//*/ pa($argv); //*/
        return (is_array($return) && !empty($return)) ? $return : false;        
    }
    
    public function __destruct() {$this->pdo = null;}
}
