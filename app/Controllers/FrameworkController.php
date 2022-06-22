<?php

namespace App\Controllers;

class FrameworkController extends AbstractController
{
    public function index() {
        $this->render('/framework/index.php');
    }
}
