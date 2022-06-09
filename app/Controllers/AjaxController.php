<?php 
namespace App\Controllers ;
use App\Models;

class AjaxController{
    public          $model;

    public function __construct() {
        $this->model = new \App\Models\AjaxModel;
    }
/*/ -------------------------------------------------------------- Аякс для главной временный -------------------------------------------------------------- /*/   
    public function getMarkData($q){
        header("Content-type: application/json; charset=utf-8");
        $db =  $this->model;
        $return = $db->getWhere('indexes', $q);
        $json = json_encode($return, JSON_FORCE_OBJECT);
        
        echo $json; exit();
        //pa($return);
        }  
}