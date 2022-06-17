<?php 
namespace App\Controllers;

class DistrictController{
    public $model,
                $pIndex,
                $districts; 

    public function __construct(){
        $this->model = new \App\Models\DistrictModel;
        $this->pIndex = new \App\Views\DistrictView;
        $this->districts = $this->model->getDistricts();
    } 
    
    public function index($q){;
        $is_districtUrl = str_starts_with(((!empty($_REQUEST['q']) && is_string($_REQUEST['q'])) ? mb_strtolower(trim($_REQUEST['q'])) : ''),'district');
        
        $this->pIndex->render();
        
        pa($this->districts);
 

    
    
    }
    
}