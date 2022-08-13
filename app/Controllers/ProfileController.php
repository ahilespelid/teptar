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

    public function profile() {
        if (isset($_GET['user']) && $this->users->findOneBy(['login' => $_GET['user']])) {
            $user = $this->users->findOneBy(['login' => $_GET['user']]);
            $currentUser = false;

            if ($this->users->findOneBy(['login' => $_GET['user']])['id'] == $this->user()['id']) {
                $currentUser = true;
            }

            if ($currentUser && $_POST) {
                foreach ($_POST as $field => $value) {
                    $this->users->update([$field => $value],['id' => $this->user()['id']]);
                }
                $this->redirectToRoute('/profile', [
                    'user' => $user['login']
                ]);
            }

            $this->render('/staff/profile/profile.php', [
                'user' => $user,
                'currentUser' => $currentUser,
                'uin' => $this->uins->findOneBy(['id' => $user['id_uin']])
            ]);
        } else {
            $this->security->error('404', 'Такой пользователь не существует');
        }
    }

    public function new() {
        $required = ['lastname', 'firstname', 'secondname', 'age', 'gender', 'email', 'phone', 'login'];

        if ($this->formIsValid($required, 'avatar') && !$this->users->findOneBy(['login' => $_POST['login']])) {
            $currentUser = $this->user();

            if ($this->security->userHasRole(['district_boss'])) {
                $role = 5;
            } else {
                $role = 7;
            }

            $this->users->add([
                'login' => $_POST['login'],
                'firstname' => $_POST['firstname'],
                'lastname' => $_POST['lastname'],
                'secondname' => $_POST['secondname'],
                'age' => $_POST['age'],
                'gender' => $_POST['gender'],
                'email' => $_POST['email'],
                'phone' => $_POST['phone'],
                'avatar' => $this->setFormBaseImage('avatar'),
                'id_uin' => $currentUser['id_uin'],
                'id_role' => $role,
                'active' => 1
            ]);

            $this->redirectToRoute('/profile', [
                'user' => $_POST['login']
            ]);
        }

        $this->render('/staff/profile/new.php');
    }

    public function fire() {
        if (isset($_GET['id'])) {
            $this->users->update(['active' => 0],['id' => $_GET['id']]);
            $user = $this->users->findOneBy(['id' => $_GET['id']]);

            $this->redirectToRoute('/profile', [
                'user' => $user['login']
            ]);
        } else {
            $this->security->error('404', 'Такого пользователя не существует');
        }
    }

    /**
     * @throws Exception
     */
    public function notifications() {
        if ($this->security->userHasRole(['ministry_boss', 'ministry_boss'])) {
            $this->notifications->update(['seen' => true], ['receiver' => $this->user()['id'], 'sender' => $this->notifications->lastDistrictId($this->user()['id'])]);

            $this->render('/staff/profile/notifications.php', [
                'districts' => $this->notifications->districtsNotificationsList($this->user()['id']),
                'notifications' => $this->notifications->districtNotifications($this->user()['id'], $this->notifications->lastDistrictId($this->user()['id']))
            ]);
        } elseif ($this->security->userHasRole(['district_boss', 'district_staff', 'admin_admin'])) {
            if ($this->security->userHasNotification()) {
                $this->notifications->update(['seen' => true], ['receiver' => $this->user()['id']]);
            }

            $this->render('/staff/profile/notifications.php', [
                'notifications' => $this->notifications->districtNotifications($this->user()['id'])
            ]);
        }
    }

    public function districtNotificationsJSON() {
        if (isset($_GET['id']) && $this->notifications->findOneBy(['sender' => $_GET['id']])) {
            $this->notifications->update(['seen' => true], ['receiver' => $this->user()['id'], 'sender' => $_GET['id']]);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($this->notifications->districtNotifications($this->user()['id'], $_GET['id']), JSON_UNESCAPED_UNICODE);
        } else {
            echo json_encode(0, JSON_UNESCAPED_UNICODE);
        }
    }

    public function disk() {
        $this->render('/staff/profile/disk.php');
    }
}
