<?php

namespace App\Controllers;

use Exception;

class ReportController extends AbstractController
{
    public $model,
    $reports,
    $indexes;

    public function __construct(){
        $this->model = new \App\Models\ReportModel;
        $this->model = new \App\Models\ReportModel;
        //$this->reports = (object) $this->model->getReports(1); 
        //$this->indexes = (object) $this->model->getIndexes(); 
    }

    public function index(){
        
        $_1_mark = $this->model->getIndexes([1],4,[1,18,35,52]);
                                                                        
        //foreach($_1_mark as $k => $v){echo $k.' : '.$v['date'].'<br>';}
        
        echo count($_1_mark);
        
        pa($_1_mark);
        //pa($this);
        
        //$this->render('/report/report.php');
    }
    
    public function sopO($array = []){
        if(is_array($array) && !empty($array) && !is_array(current($array))){
            return (array_sum($array) / count($array));
        }
    return false;}
    
    
}
