<?php namespace App;
/*/ База /*/
class Model{
    const HOST = "194.67.90.250", DB = "teptar";
    const USER = "tepuser", PASS = '-Txh9y#j_sJM';

    public static function conn(){
        $user = self::USER;
        $pass = self::PASS;
        $host = self::HOST;
        $db   = self::DB;

        $conn = new \PDO("mysql:dbname=$db;host=$host", $user, $pass);
        return $conn;
    }
}