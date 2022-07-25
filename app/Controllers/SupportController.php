<?php

namespace App\Controllers;

use App\Service\Security;

class SupportController extends AbstractController {
    public $security;
    public $users;
    public $uins;

    public function __construct()
    {
        $this->uins = new \App\Models\UINModel;
        $this->users = new \App\Models\UserModel;
        $this->security = new Security();
    }

    public function support() {
        $this->render('/staff/support/support.php');
    }

    public function callCenter() {
        if (isset($_GET['type']) && $this->uins->findOneBy(['type' => $_GET['type']])) {
            $this->render('/staff/support/call_center.php', [
                'centers' => $this->uins->findBy(['type' => $_GET['type']])
            ]);
        } else {
            $this->security->error();
        }
    }

    public function rating() {
        $this->render('/staff/support/rating.php', [
            'districts' => $this->uins->findBy(['type' => 'district'])
        ]);
    }

    public function center() {
        if (isset($_GET['center']) && $this->uins->findOneBy(['slug' => $_GET['center']])) {
            $uin = $this->uins->findOneBy(['slug' => $_GET['center']]);
            $this->render('/staff/support/center.php', [
                'center' => $uin,
                'boss' => $this->users->findOneBy(['id_uin' => $uin['id']]),
                'staffs' => $this->users->findBy(['id_uin' => $uin['id'], 'id_role' => 5])
            ]);
        } else {
            $this->security->error();
        }
    }

    public function uinInJSON() {
        if (isset($_GET['id']) && $this->uins->findOneBy(['id' => $_GET['id']])) {
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($this->uins->findOneBy(['id' => $_GET['id']]), JSON_UNESCAPED_UNICODE);
        } else {
            echo json_encode(0, JSON_UNESCAPED_UNICODE);
        }
    }
}
