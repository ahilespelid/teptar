<?php  
namespace App\Models;

class IndexModel extends \App\Data{
    public $table;

    public function __construct(){
        $this->table = $GLOBALS['db']['table']['index'];
        (object)$this->pdo = $this->connPDO();
    }

    public function getActivity($report) {
        $sql = "SELECT * FROM `" . $this->table . "` LEFT JOIN marks on `index`.id_mark = marks.id WHERE id_report = " . $report;

        return $this->customSQL($sql);
    }
}
