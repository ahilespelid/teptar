<?php

namespace App\Controllers;

use App\Models\DistrictModel;
use Exception;

class HomeController extends AbstractController {
    public function __construct(
        public $user = new UserController,
        public $database = new DistrictModel,
    ){}

    /**
     * Главная страница
     * @throws Exception
     */
    public function index() {
        if (isset($_GET['logout'])) {
            $this->user->out(); exit();
        }

        if ($this->user->isToken()) {
            if($user = $this->user->login($this->user->getLoginUser())){
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
     * @throws Exception
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

    /**
     * @throws Exception
     */
    public function framework() {
        $this->render('/home/framework.php');
    }
}
