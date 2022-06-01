<?php 
namespace App;  
use PDO, PDOException;
define('dbHost',  $GLOBALS['db']['host']);
define('dbBase',  $GLOBALS['db']['base']);
define('dbUser',  $GLOBALS['db']['user']);
define('dbPass',  $GLOBALS['db']['pass']);

abstract class Data{
    public $host = dbHost,
                $base =dbBase, 
                $user = dbUser, 
                $pass = dbPass,
                $pdo;
    
    function __construct(){
        (object) $this->pdo = $this->connPDO();
    } 
         
    public function connPDO(){
            $pdo = new \PDO("mysql:dbname=".$this->base.";host=".$this->host."", $this->user, $this->pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
    }
}