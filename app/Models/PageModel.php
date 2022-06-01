<?php  
namespace App\Model;  
use App, Exception;

class PageModel extends \App\Data{
    public $resID, $resRange;

    public function __construct() {
        try {
            $bug = (is_object($GLOBALS['bug']) && $GLOBALS['bug'] instanceof \App\Regist) ? $GLOBALS['bug'] : false;
            if(is_object($bug)){throw new Exception('Failed to identify the Register object');}
        } catch (Exception $e) {
             echo '<span style="color: #ce4040">' .(new \DateTime('now'))->format('[H:i | d M Y]'). '</span> '.
                        $e->getMessage() . ' <b>' . $e->getFile(). '</b> <small>(line ' . $e->getLine() . ')</small><br>';
        }        
        
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
