<?php

namespace App\Controllers;

use Exception;

class ProfileController extends AbstractController {
    private $view;
    private $models;

    public function __construct()
    {
        $this->view = new \App\Views\NotificationsView();
        $this->models = new \App\Models\MainModel();
    }

    /**
     * @throws Exception
     */
    public function profile() {
        pa($this->models->getAll('districts'));
        $this->render('profile/leader.php');
    }
}
