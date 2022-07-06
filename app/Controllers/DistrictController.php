<?php 
namespace App\Controllers;

class DistrictController extends AbstractController {
    public $users;
    public $uins;
    public $user;
    public $reports;

    public function __construct() {
        $this->user = new UserController;
        $this->users = new \App\Models\UserModel;
        $this->uins = new \App\Models\UINModel;
        $this->reports = new \App\Models\ReportModel;
    }

    public function district() {
        if ($user = $this->user->login($this->user->getLoginUser())) {
            if (isset($_GET['district']) && $this->uins->findOneBy(['slug' => $_GET['district']])) {
                $district = $this->uins->findOneBy(['slug' => $_GET['district']]);
                $districtBoss = $this->users->findOneBy(['id_uin' => $district['id'], 'id_role' => 4]);
                $userIsLeader = ('Region' == $user->role['name'] && 'Boss' == $user->role['subject']);

                $date = $_GET['year'] ?? (new \DateTime('now'))->format('Y');

                if ($userIsLeader) {
                    $this->render('/district/district-leader.php', [
                        'user' => ['post' => $user->role['post']],
                        'district' => $district,
                        'districts' => $this->uins->findBy(['type' => 'district']),
                        'districtBoss' => $districtBoss,
                        'districtStaffs' => $this->users->findBy(['id_uin' => $district['id'], 'id_role' => 5]),
                        'reports' => $this->reports->findDistrictReportsByDate($date, $district['id'])
                    ]);
                }
            } else {
                (new HomeController)->error(404,'Регион не существует', 'Район который вы ищите не существует, пожалуйста выберите другой либо вернитесь на главную.');
            }
        }
    }
}
