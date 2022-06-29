<?php

namespace App\Controllers;

class HomeController extends AbstractController {
    public $user;
    public $uins;

    public function __construct(){
        $this->user = new UserController;
        $this->uins = new \App\Models\UINModel;
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
                    'districts' => $this->uins->findBy(['type' => 'district']),
                    'navbar' => 'home',
                    'user' => [
                        'post' => $user->role['post']
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
                'districts' => $this->uins->findBy(['type' => 'district']),
                'user' => [
                    'post' => $user->role['post']
                ]
            ]);
        }
    }

    /**
     * Страница с документацией стилей
     */
    public function framework() {
        $this->render('/home/framework.php');
    }
}