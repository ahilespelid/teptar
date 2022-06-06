<?php  
namespace App\Models;  
use App;

class PageModel extends \App\Data{
    public $resID, $resRange;

    public function __construct() {
         (object)$this->pdo = $this->connPDO();
    }
    
    public function getByRange($from, $to){
        return $this->pdo->query("SELECT * FROM page WHERE id>=$from AND id<=$to");
  
  
    }
    
    public function __destruct() {
        $this->pdo = null;
   }
}