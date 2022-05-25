<?php namespace App\Models; use App;
class MainModel extends App\Model{
    public $resID, $resRange;

    public function getById($id){
        return $this->PDO->query("SELECT * FROM page WHERE id=$id");
    }

    public function getByRange($from, $to){
        return $this->PDO->query("SELECT * FROM page WHERE id>=$from AND id<=$to");
    }
}