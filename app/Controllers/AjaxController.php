<?php 
namespace App\Controllers ;
use App\Models;
use App\Service\Security;

class AjaxController{
    public          $model, $view, $security;

    public function __construct() {
        $this->model = new \App\Models\AjaxModel;
        $this->security = new Security();

    }
/*/ -------------------------------------------------------------- Аякс для главной временный -------------------------------------------------------------- /*/   
    public function getMarkData($q){
        header("Content-type: application/json; charset=utf-8");
        $db =  $this->model;
        $return = $db->getWhere('indexes', $q);
        $json = json_encode($return, JSON_FORCE_OBJECT);
        
        $this->view->render($data[[]], f);
        //pa($return);
        }  
}
