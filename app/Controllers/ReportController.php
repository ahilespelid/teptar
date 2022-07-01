<?php

namespace App\Controllers;

use Exception;

class ReportController extends AbstractController{
    public $model, $uins,
                $reports,
                $indexes,
                $mark_1;

    public function __construct(){
        $this->model = new \App\Models\ReportModel;
        $this->uins = new \App\Models\UINModel;
        //$this->reports = (object) $this->model->getReports(1); 
        //$this->indexes = (object) $this->model->getIndexes(); 
        
        $this->mark_1 = $this->sopO($this->model->getIndexes([5],[1],[],4));
    }

    public function index(){      
        echo $this->mark_1;
        
        //pa($this->model->getIndexes([5],[1],[],4));
        $this->sopOmax();
        
        
        //pa($_1_mark);
        //pa($this);
       //foreach($_1_mark as $k => $v){echo $k.' : '.$v['date'].'<br>';}  
        //$this->render('/report/report.php');
    }
    
    public function sopO($array = []){   
        $_4_indexa = (!empty($array) && is_array($array)) ? $array : false;
        
        if($_4_indexa){for($i=0;$i<4; $i++){
            $dateCreatingReport = $this->is_date($_4_indexa[$i]['id_report']['creating'])?->getTimestamp();
            $dateSubmittingReport = $this->is_date($_4_indexa[$i]['id_report']['submitting'])?->getTimestamp();
            $dateCreatingIndex = $this->is_date($_4_indexa[$i]['date'])?->getTimestamp();
            
            if((5 == $_4_indexa[$i]['id_status']['id']) && ($dateCreatingReport<$dateCreatingIndex || $dateSubmittingReport > $dateCreatingIndex)){
                $return[] = (!empty($_4_indexa[$i]['index'])) ? $_4_indexa[$i]['index'] : '';
            }} // */  pa($return); // */
            $return = $this->array_deleteElements($return); 
            if(isset($return[0]) && isset($return[1])){unset($return[3]);}
             // */ pa($return); // */
             $count = count($return);
            return (3 <= $count) ? array_sum($return) / $count : false;
        }                                                                                                              
    return false;}
    
    public function sopOmax($array = []){
        $districts = $this->uins->findBy(['type' => 'district']);
        pa($districts); 
         
        
        
    }    
    
}
