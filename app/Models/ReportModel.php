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
    
    public function __destruct() {$this->pdo = null;}
}
