<?php 
namespace App\Controllers;

class DistrictController extends AbstractController {
    public  $model,
            $pIndex,
            $districts,
            $user;


    public function __construct(){
        $this->user = new UserController;
        $this->model = new \App\Models\DistrictModel;
    }
    
//    public function index($q){;
//        $is_districtUrl = str_starts_with(((!empty($_REQUEST['q']) && is_string($_REQUEST['q'])) ? mb_strtolower(trim($_REQUEST['q'])) : ''),'district');
//        $this->pIndex->render();
//    }

    public function district() {
        if ($user = $this->user->login($this->user->getLoginUser())) {
            $district = $this->model->getWhere('districts', ['mapname' => $_GET['district']])[0];
            $isLeader = ('Region' == $user->role['name'] && 'Boss' == $user->role['subject']);

            if ($isLeader) {
                $this->render('/district/district-leader.php', [
                    'user' => [
                        'post' => $user->uin['comments']
                    ],
                    'district' => $district,
                    'districts' => $this->model->getAll('districts')
                ]);
            }
        }
    }
}
