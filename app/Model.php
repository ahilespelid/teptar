<?php namespace App; use PDO;

abstract class Model{
    private $host, $base, $user, $pass;
    protected $pdo;
    
    function __construct(){
        (string) $this->host = '194.67.90.250';
        (string) $this->base = 'teptar';
        (string) $this->user = 'tepuser';
        (string) $this->pass = '-Txh9y#j_sJM';
        (object) $this->pdo = $this->connPDO();
    } 
         
    public function connPDO(){
        try{
            $pdo = new \PDO("mysql:dbname=$this->base;host=$this->host", $this->user, $this->pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        }catch (PDOException $e){echo 'ERROR: ' . $e->getMessage();}
        return false;
    }
}