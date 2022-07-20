<?php

namespace App\Controllers;

use App\Service\Security;
use Exception;

class ProfileController extends AbstractController {
    public $uins;
    public $user;
    public $roles;
    public $users;
    public $security;
    public $notifications;

    public function __construct() {
        $this->user = new UserController;
        $this->uins = new \App\Models\UINModel;
        $this->users = new \App\Models\UserModel;
        $this->roles = new \App\Models\RoleModel;
        $this->notifications = new \App\Models\NotificationModel;
        $this->security = new Security();
    }

    /**
     * @throws Exception
     */
    public function leader() {
        $this->render('/leader/leader.php', [
            'districts' => $this->uins->findBy(['type' => 'district'])
        ]);
    }

    public function userExistInDistrict($data): bool
    {
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

    /**
     * @throws Exception
     */
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

    /**
     * @throws Exception
     */
    public function notifications() {
        if ($this->security->userHasRole(['ministry_boss', 'ministry_boss'])) {
            $this->render('/staff/notifications.php', [
                'districts' => $this->notifications->districtsNotificationsList($this->user()['id']),
                'notifications' => $this->notifications->districtNotifications($this->user()['id'], $this->notifications->lastDistrictId($this->user()['id']))
            ]);
        } elseif ($this->security->userHasRole(['district_boss', 'district_staff'])) {
            $this->render('/staff/notifications.php', [
                'notifications' => $this->notifications->districtNotifications($this->user()['id'])
            ]);
        }
    }

    public function districtNotificationsJSON() {
        if (isset($_GET['id']) && $this->notifications->findOneBy(['sender' => $_GET['id']])) {
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($this->notifications->districtNotifications($this->user()['id'], $_GET['id']), JSON_UNESCAPED_UNICODE);
        } else {
            echo json_encode(0, JSON_UNESCAPED_UNICODE);
        }
    }
}
