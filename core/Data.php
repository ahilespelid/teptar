<?php 
namespace App;  
use PDO, PDOException;

class Data{
    public $host,
                $base, 
                $user, 
                $pass,
                $pdo;
    
    function __construct(){
        (string) $this->host = $GLOBALS['db']['host'];
        (string) $this->base = $GLOBALS['db']['base'];
        (string) $this->user = $GLOBALS['db']['user'];
        (string) $this->pass = $GLOBALS['db']['pass'];
        (object) $this->pdo = $this->connPDO();
    } 
         
    public function connPDO(){
            $pdo = new \PDO("mysql:dbname=".$this->base.";host=".$this->host."", $this->user, $this->pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
    }
}