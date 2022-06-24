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
        $this->reports = (object) $this->model->getReports(1); 
        $this->indexes = (object) $this->model->getIndexes(1); 
    }

    public function index() {
        
        pa($this);
        
        //$this->render('/report/report.php');
    }
}
