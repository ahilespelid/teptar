<?php

namespace App\Controllers;

class ReportsController
{
    private $view;

    public function __construct()
    {
        $this->view = new \App\Views\NotificationsView();
    }

    public function profile() {
        $this->view->render();
    }
}
