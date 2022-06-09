<?php
namespace App;
use PDO, PDOException;
define('dbHost',  $GLOBALS['db']['host']);
define('dbBase',  $GLOBALS['db']['base']);
define('dbUser',  $GLOBALS['db']['user']);
define('dbPass',  $GLOBALS['db']['pass']);

abstract class Data{
    public $host = dbHost, $base = dbBase, $user = dbUser, $pass = dbPass, $pdo;

    function __construct(){
        
    }

    public function connPDO(){
        $pdo = new \PDO("mysql:dbname=" . $this->base . ";host=" . $this->host . "", $this->user, $this->pass, array(PDO::ATTR_PERSISTENT => true));
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $pdo;
    }

    public function getId($table = '', $id = 1){/*/ Берёт значения по ИД из таблицы /*/ 
        $id = (int)$id;
        $table = (is_string($table) && !empty($table)) ? trim($table) : $this->getRandTable()[0];
        if(!empty($table) && !empty($id)){return $this->pdo->query("SELECT * FROM $table WHERE id=$id;")->fetch();}
        return false;
    }

    public function getAll($table = ''){/*/ Берёт все значения из таблицы /*/ 
        $table = (is_string($table) && !empty($table)) ? trim($table) : $this->getRandTable()[0];
        if(!empty($table)){return $this->pdo->query("SELECT * FROM $table;")->fetchAll();}
        return false;
    }

    public function getWhere($table = '', array $where){/*/ Берёт все значения из таблицы /*/ 
        $table = (is_string($table) && !empty($table)) ? trim($table) : $this->getRandTable()[0];
        $where = (is_array($where) && !empty($where)) ? $where : ['id'=>'1'];

        $whereString = ''; $i = 1;
        if(!is_array(current($where)) && 1 <= $c = count($where)){
            foreach($where as $k => $v){
                $whereString .= "`".$k."`='".$v."'".(($i < $c ) ? ' AND ' : ''); $i++;
        }}
        $whereString = ' WHERE '.$whereString;
        $sql =  "SELECT * FROM `".$table."`".((!empty($whereString)) ? $whereString : '').';';
        //echo $sql;
        if(!empty($table)){return $this->pdo->query($sql)->fetchAll();}
        return false;
    }
    
    public function getRandTable($oneOrMony = true){/*/ Берёт случайную таблиц(У|Ы) из схемы  /*/ 
        if($oneOrMony){
             $table = (!empty($table) && is_string($table)) ? $table : $this->pdo->query(
                "select TABLE_NAME  from INFORMATION_SCHEMA.TABLES ". 
                "where TABLE_SCHEMA = '" . $this->base. "' order by rand() limit 1;"
            )->fetch();  /*/ return [ 0 => TABLE_NAME] default /*/     
        }else{
             $table = (!empty($table) && is_string($table)) ? $table : $this->pdo->query(
                "select TABLE_NAME  from INFORMATION_SCHEMA.TABLES ". 
                "where TABLE_SCHEMA = '" . $this->base. "' order by rand();"
            )->fetchAll();  /*/ return [ 0 => TABLE_NAME], 1 => TABLE_NAME, ...] /*/
        }
        $return = []; array_walk_recursive($table, function($a) use (&$return) { $return[] = $a;}); 
        return $return;     
    }
}
