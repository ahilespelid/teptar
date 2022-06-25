<?php

namespace App\Controllers;

class HomeController extends AbstractController {
    public $user;
    public $database;

    public function __construct(){
        $this->user = new UserController;
        $this->database = new \App\Models\DistrictModel;
    }

    /**
     * Главная страница
     */
    public function index() {
        if (isset($_GET['logout'])) {
            $this->user->out(); exit();
        }

        if ($this->user->isToken()) {
            if ($user = $this->user->login($this->user->getLoginUser())) {
                $this->render('/home/home-leader.php', [
                    'districts' => $this->database->getAll('districts'),
                    'navbar' => 'home',
                    'user' => [
                        'post' => $user->uin['comments']
                    ]
                ]);
            }
        } else {
            $this->render('/home/login.php');
        }
    }

    /**
     * Страница ошибок
     */
    public function error() {
        $error = '404';
        $title = 'Страница не найдена';
        $message = 'Страницу которую вы искали не существует, пожалуйста выберите другую либо вернитесь на главную.';

        if($user = $this->user->login($this->user->getLoginUser())){
            $this->render('/home/error.php', [
                'error' => $error,
                'title' => $title,
                'message' => $message,
                'districts' => $this->database->getAll('districts'),
                'user' => [
                    'post' => $user->uin['comments']
                ]
            ]);
        }
    }

    public function framework() {
        $this->render('/home/framework.php');
    }
}
