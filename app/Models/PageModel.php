<?php  
namespace App\Models;  
use App;

class PageModel extends \App\Data{
    public $resID, $resRange;

    public function __construct() {
        $bug = (is_a($GLOBALS['bug'], 'Registr') ) ? $GLOBALS['bug'] : (new App\Registr());
        \pa((array) $bag);
        \pa((array) $GLOBALS['bug']);
        var_dump( $GLOBALS['bug']);
    }
    public function getById($id){
        return $this->PDO->query("SELECT * FROM page WHERE id=$id");
    }

    public function getByRange($from, $to){
        return $this->PDO->query("SELECT * FROM page WHERE id>=$from AND id<=$to");
    }
}
