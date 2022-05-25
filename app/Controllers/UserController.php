<?php namespace App\Controllers;
class UserController{
    public      $view, $model;
    protected   $pageData = [];

    public function __construct() {
        //$this->view  = new App\View;
        //$this->model = new App\Model;
    }
    public function auth(){
        echo 'Пользователя страница';        
    }    
}