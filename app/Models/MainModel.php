<?php
namespace App\Models;  
use App;

class MainModel extends \App\Data{
    public $table;
    public function __construct() {
         (object)$this->pdo = $this->connPDO();
    }

    public function __destruct() {$this->pdo = null;}
}
?>