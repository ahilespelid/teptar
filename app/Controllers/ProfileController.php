<?php

namespace App\Controllers;

use App\Models\UINModel;
use Exception;

class ProfileController extends AbstractController {
    public $uins;
    public $user;

    public function __construct()
    {
        $this->user = new UserController;
        $this->uins = new UINModel;
    }

    /**
     * @throws Exception
     */
    public function profile() {
        if($user = $this->user->login($this->user->getLoginUser())){
            $this->render('/profile/leader.php', [
                'districts' => $this->uins->findBy(['type' => 'district']),
                'user' => [
                    'post' => $user->role['post'],
                    'full_name' => $user->lastname . ' ' . $user->firstname . ' ' . $user->secondname
                ]
            ]);
        }
    }
}
