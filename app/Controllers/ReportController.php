<?php

namespace App\Controllers;

use Exception;

class ReportController extends AbstractController
{
    public $model, $view;

    public function __construct()
    {
        $this->model = new \App\Models\ReportModel();
    }

    /**
     * @throws Exception
     */
    public function index() {
<<<<<<< HEAD
        $htis->view->render();
=======

        $this->render('/report/report.php');
>>>>>>> 325e4cf3043bb735dc8c793af30385cd4f53b50a
    }
}
