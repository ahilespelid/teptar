<?php

namespace App\Controllers;

use App\Models\DistrictModel;
use Exception;

class ProfileController extends AbstractController {
    public $database;
    public $user;

    public function __construct()
    {
        $this->user = new UserController;
        $this->database = new DistrictModel;
    }

    /**
     * @throws Exception
     */
    public function profile() {
        if($user = $this->user->login($this->user->getLoginUser())){
            $this->render('/profile/leader.php', [
                'districts' => $this->database->getAll('districts'),
                'user' => [
                    'post' => $user->uin['comments'],
                    'full_name' => $user->lastname . ' ' . $user->firstname . ' ' . $user->secondname
                ]
            ]);
        }
    }
}
