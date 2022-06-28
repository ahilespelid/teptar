<?php

namespace App\Controllers;

class ProfileController extends AbstractController {
    public $uins;
    public $user;
    public $roles;

    public function __construct()
    {
        $this->user = new UserController;
        $this->uins = new \App\Models\UINModel;
        $this->users = new \App\Models\UserModel;
        $this->roles = new \App\Models\RoleModel;
    }

    public function profile() {
        if($user = $this->user->login($this->user->getLoginUser())) {
            $this->render('/profile/leader.php', [
                'districts' => $this->uins->findBy(['type' => 'district']),
                'user' => [
                    'post' => $user->role['post'],
                    'full_name' => $user->lastname . ' ' . $user->firstname . ' ' . $user->secondname
                ]
            ]);
        }
    }

    public function staff() {
        if($user = $this->user->login($this->user->getLoginUser())) {

            $staff = $this->users->findOneBy(['id' => $_GET['id']]);
            $uin = $this->uins->findOneBy(['id' => $staff['id_uin']]);
            $role = $this->roles->findOneBy(['id' => $staff['id_role']]);

            $this->render('/profile/staff.php', [
                'districts' => $this->uins->findBy(['type' => 'district']),
                'user' => [
                    'post' => $user->role['post'],
                    'full_name' => $user->lastname . ' ' . $user->firstname . ' ' . $user->secondname
                ],
                'staff' => $staff,
                'uin' => $uin,
                'role' => $role
            ]);
        }
    }
}
