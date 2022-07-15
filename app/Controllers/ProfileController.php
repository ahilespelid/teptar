<?php

namespace App\Controllers;

use App\Service\Security;

class ProfileController extends AbstractController {
    public $uins;
    public $user;
    public $roles;
    public $users;
    public $security;

    public function __construct() {
        $this->user = new UserController;
        $this->uins = new \App\Models\UINModel;
        $this->users = new \App\Models\UserModel;
        $this->roles = new \App\Models\RoleModel;
        $this->security = new Security();
    }

    public function leader() {
        $this->render('/leader/leader.php', [
            'districts' => $this->uins->findBy(['type' => 'district'])
        ]);
    }

    public function userExistInDistrict($data) {
        $exist = false;
        $dataSet = isset($data['district']) && isset($data['login']);

        if ($dataSet) {
            $uinExist = $this->uins->findOneBy(['slug' => $data['district']]);

            if ($uinExist) {
                $staffExist = $this->users->findOneBy(['login' => $data['login'], 'id_uin' => $uinExist['id']]);

                if ($staffExist) {
                    $exist = true;
                }
            }
        }

        return $exist;
    }

    public function staff() {
        if ($this->userExistInDistrict($_GET)) {
            $staff = $this->users->findOneBy(['login' => $_GET['login']]);
            $uin = $this->uins->findOneBy(['id' => $staff['id_uin']]);
            $role = $this->roles->findOneBy(['id' => $staff['id_role']]);

            $this->render('/leader/staff.php', [
                'districts' => $this->uins->findBy(['type' => 'district']),
                'staff' => $staff,
                'uin' => $uin,
                'role' => $role
            ]);
        } else {
            (new Security())->error(404, 'Пользователь не найден', 'Пользователь которого вы искали в регионе не существует, пожалуйста выберите другого либо вернитесь на главную.');
        }
    }
}
