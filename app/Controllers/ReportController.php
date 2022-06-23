<?php

namespace App\Controllers;

use Exception;

class ReportController extends AbstractController
{
    public $model, $view;

    public function __construct()
    {
        $this->model = new \App\Models\ReportModel;
    }

    /**
     * @throws Exception
     */
    public function index() {
        $this->render('/report/report.php');
    }
}
