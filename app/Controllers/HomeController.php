<?php

namespace App\Controllers;

use Exception;

class HomeController extends AbstractController {
    public function __construct(
        public $user = new UserController,
    ){}

    /**
     * Главная страница
     * @throws Exception
     */
    public function index() {
        if(isset($_GET['logout'])) {
            $this->user->out(); exit();
        }

        if ($this->user->isToken()) {
            $this->render('/home/login.php');
        } else {
            $this->render('/home/login.php');
        }
    }

    /**
     * Страница ошибок
     * @throws Exception
     */
    public function error() {
        $error = '404';
        $title = 'Страница не найдена';
        $message = 'Страницу которую вы искали не существует, пожалуйста выберите другую либо вернитесь на главную.';

        $this->render('/home/error.php', [
            'error' => $error,
            'title' => $title,
            'message' => $message
        ]);
    }
}
