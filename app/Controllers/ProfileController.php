<?php

namespace App\Controllers;

class ProfileController
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
