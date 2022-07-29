<?php 
namespace App\Controllers;

use App\Service\Security;

class DistrictController extends AbstractController {
    public $users;
    public $uins;
    public $user;
    public $reports;
    public $security;
    public $marks;
    public $calculations;

    public function __construct() {
        $this->user = new UserController;
        $this->users = new \App\Models\UserModel;
        $this->uins = new \App\Models\UINModel;
        $this->reports = new \App\Models\ReportModel;
        $this->marks = new \App\Models\MarkModel;
        $this->calculations = new \App\Models\CalculateModel;
        $this->security = new Security();
    }

    public function district() {
        if (isset($_GET['district']) && $this->uins->findOneBy(['slug' => $_GET['district']])) {
            $district = $this->uins->findOneBy(['slug' => $_GET['district']]);
            $districtBoss = $this->users->findOneBy(['id_uin' => $district['id'], 'id_role' => 4]);

            $date = $_GET['year'] ?? (new \DateTime('now'))->format('Y');

            $generalRating = $this->calculations->markGeneralRating('ko');
            $rank = null;

            foreach ($generalRating as $key => $rating) {
                if ($rating['slug'] === $_GET['district']) {
                    $rank = $key + 1;
                }
            }

            if ($this->security->userHasRole(['region_boss', 'admin_admin'])) {
                $this->render('/leader/district.php', [
                    'district' => $district,
                    'districts' => $this->uins->findBy(['type' => 'district']),
                    'districtBoss' => $districtBoss,
                    'districtStaffs' => $this->users->findBy(['id_uin' => $district['id'], 'id_role' => 5]),
                    'reports' => $this->reports->findDistrictReportsByDate($date, $district['id']),
                    'marks' => $this->marks->findAll(),
                    'rank' => $rank
                ]);
            }
        } else {
            (new Security())->error(404,'Регион не существует', 'Район который вы ищите не существует, пожалуйста выберите другой либо вернитесь на главную.');
        }
    }

    public function districts() {
        $districts = [];

        foreach ($this->uins->findBy(['type' => 'district']) as $key => $district) {
            $districts[$key] = [
                'district' => $district,
                'report' => $this->reports->findOneBy(['id_uin' => $district['id']], ['submitting' => 'DESC']),
                'staff' => $this->users->findBy(['id_uin' => $district['id'], 'id_role' => 5], null, 2),
                'staffCount' => $this->users->count(['id_uin' => $district['id'], 'id_role' => 5]),
            ];
        }

        $this->render('/staff/district/districts.php', [
            'districts' => $districts
        ]);
    }

    public function districtJsonReportsByDate() {
        if (isset($_GET['district']) && $this->uins->findOneBy(['slug' => $_GET['district']])) {
            $district = $this->uins->findOneBy(['slug' => $_GET['district']]);
            $date = $_GET['year'] ?? (new \DateTime('now'))->format('Y');

            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($this->reports->findDistrictReportsByDate($date, $district['id']), JSON_UNESCAPED_UNICODE);
        } else {
            echo json_encode(0, JSON_UNESCAPED_UNICODE);
        }
    }
}
