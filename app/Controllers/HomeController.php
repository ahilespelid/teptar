<?php

namespace App\Controllers;

use App\Service\Security;

class HomeController extends AbstractController {
    public $uins;
    public $reports;
    public $security;
    public $marks;

    public function __construct(){
        $this->uins = new \App\Models\UINModel;
        $this->reports = new \App\Models\ReportModel;
        $this->marks = new \App\Models\MarkModel;
        $this->security = new Security();
    }

    /**
     * Главная страница
     */
    public function index() {
        if (isset($_GET['logout'])) {
            (new UserController())->out(); exit();
        }

        if ($this->security->userHasRole(['authorized'])) {
            if ($this->security->userHasRole(['region_boss', 'admin_admin'])) {
                $this->leaderHome();
            } elseif ($this->security->userHasRole(['ministry_boss', 'ministry_staff'])) {
                $this->redirectToRoute('/districts');
            } elseif ($this->security->userHasRole(['district_boss', 'district_staff'])) {
                $this->redirectToRoute('/reports');
            }
        } else {
            $this->redirectToRoute('/login');
        }
    }

    public function leaderHome() {
        $district = $this->uins->findOneBy(['slug' => $_GET['district'] ?? 'Grozny']);
        $date = $_GET['year'] ?? (new \DateTime('now'))->format('Y');

        $this->render('/leader/home.php', [
            'districts' => $this->uins->findBy(['type' => 'district']),
            'reports' => $this->reports->findDistrictReportsByDate($date,$district['id']),
            'navbar' => 'home',
            'reportsType' => 'home',
            'district' => $district,
            'marks' => $this->marks->findAll()
        ]);
    }

    /**
     * Страница с документацией стилей
     */
    public function framework() {
        $this->render('/framework/framework.php');
    }
}
