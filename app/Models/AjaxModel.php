<?php  
namespace App\Models;

class AjaxModel extends \App\Data{
    public $pdo;

    public function __construct() {
         (object)$this->pdo = $this->connPDO();
    }

    public function __destruct() {
        $this->pdo = null;
   }
}
