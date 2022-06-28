<?php  
namespace App\Models;  
use App;

class UINModel extends \App\Data {
    public $table, $tableRole;

    public function __construct(){
        $this->table = 'uin';
         (object)$this->pdo = $this->connPDO();
    }

    public function __destruct() {
        $this->pdo = null;
    }
}
