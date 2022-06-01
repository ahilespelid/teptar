<?php  
namespace App\Models;  
use App;

class PageModel extends \App\Data{
    public $resID, $resRange;

    public function __construct() {
        
       /*/  var_dump($bug);
        echo '<br>';
        //\pa((array) $bag);
        //\pa((array) $GLOBALS['bug']);
        var_dump( $GLOBALS['bug']); /*/
    }
    public function getById($id){
        return $this->PDO->query("SELECT * FROM page WHERE id=$id");
    }

    public function getByRange($from, $to){
        return $this->PDO->query("SELECT * FROM page WHERE id>=$from AND id<=$to");
    }
}
