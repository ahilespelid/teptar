<?php  
namespace App\Models;  
use App;

class PageModel extends \App\Data{
    public $resID, $resRange, $pdo;

    public function __construct() {
         $this->connPDO();
}
    public function getById($id = 1){
        //echo $this->host.'<br>'.$this->base.'<br>'.$this->user.'<br>'.$this->pass.'<br>';
       
        $id = (int) $id;
        
        pa($GLOBALS['db']); 
        pa($this->pdo); 
        return $this->pdo->query("SELECT * FROM page WHERE id=$id");
    }

    public function getByRange($from, $to){
        return $this->pdo->query("SELECT * FROM page WHERE id>=$from AND id<=$to");
    }
}
/*/     
       var_dump($bug);
        echo '<br>';
        //\pa((array) $bag);
        //\pa((array) $GLOBALS['bug']);
        var_dump( $GLOBALS['bug']); 
/*/