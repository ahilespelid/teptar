<?php

namespace App\Controllers;

class ReportController
{
    public $model, $view;

    public function __construct()
    {
        $this->model = new \App\Views\ReportModel();
        $this->view = new \App\Views\ReportView();
    }

    public function index() {
        $this->view->render();
    }
}
