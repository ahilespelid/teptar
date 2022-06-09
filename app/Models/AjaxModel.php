<?php  
namespace App\Models;  
use App;

class AjaxModel extends \App\Data{
    public $resID, $resRange;

    public function __construct() {
         (object)$this->pdo = $this->connPDO();
    }


    public function __destruct() {
        $this->pdo = null;
   }
}