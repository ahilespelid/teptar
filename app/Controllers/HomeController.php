<?php

namespace App\Controllers;

class HomeController extends AbstractController {
    public $user;
    public $uins;
    public $reports;

    public function __construct(){
        $this->user = new UserController;
        $this->uins = new \App\Models\UINModel;
        $this->reports = new \App\Models\ReportModel;
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
                $district = $this->uins->findOneBy(['slug' => $_GET['district'] ?? 'Grozny']);
                $date = $_GET['year'] ?? (new \DateTime('now'))->format('Y');

                $this->render('/leader/home/home.php', [
                    'districts' => $this->uins->findBy(['type' => 'district']),
                    'navbar' => 'home',
                    'reportsType' => 'home',
                    'user' => [
                        'post' => $user->role['post']
                    ],
                    'reports' => $this->reports->findDistrictReportsByDate($date,$district['id']),
                    'district' => $district,
                ]);
            }
        } else {
            $this->render('/leader/home/login.php');
        }
    }

    /**
     * Страница ошибок
     */
    public function error($error = 404, $title = null, $message = null) {
        if ($title == null) {
            if ($error == 404) {
                $title = 'Страница не найдена';
            }
        }

        if ($message == null) {
            if ($error == 404) {
                $message = 'Страницу которую вы искали не существует, пожалуйста выберите другую либо вернитесь на главную.';
            }
        }

        if($user = $this->user->login($this->user->getLoginUser())){
            $this->render('/leader/home/error.php', [
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
        $this->render('/leader/home/framework.php');
    }
}
