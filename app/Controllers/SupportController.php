<?php

namespace App\Controllers;

use App\Service\Security;

class SupportController extends AbstractController {
    public $security;
    public $users;
    public $uins;
    public $marks;
    public $calculations;
    public $notifications;
    public $supports;

    public function __construct()
    {
        $this->uins = new \App\Models\UINModel;
        $this->users = new \App\Models\UserModel;
        $this->marks = new \App\Models\MarkModel;
        $this->calculations = new \App\Models\CalculateModel;
        $this->notifications = new \App\Models\NotificationModel;
        $this->supports = new \App\Models\SupportModel;
        $this->security = new Security();
    }

    public function support() {
        if ($_POST && isset($_POST['message'])) {
            $this->supports->add([
                'id_user' => $this->user()['id'],
                'date' => new \DateTime('now'),
                'message' => $_POST['message'],
                'answered' => 0
            ]);

            setcookie('alert', json_encode([
                'message' => 'Ваше сообщение отправлено в службу поддержки: ' . $_POST['message'],
                'type' => 'success'
            ]), time()+1, '/');

            $this->redirectToRoute('/support');
        }

        $this->render('/staff/support/support.php', [
            'questions' => $this->supports->questions($this->user()['id'])
        ]);
    }

    public function messages() {
        if ($_POST && $_POST['message']) {
            foreach ($_POST['message'] as $questionID => $answer) {
                $this->supports->update(['answered' => 1],['id' => $questionID]);
                $question = $this->supports->findOneBy(['id' => $questionID]);

                $this->supports->add([
                    'id_user' => $this->user()['id'],
                    'date' => new \DateTime('now'),
                    'message' => $answer,
                    'answerFor' => $questionID
                ]);

                $this->notifications->add([
                    'sender' => $this->user()['id'],
                    'receiver' => $question['id_user'],
                    'datetime' => new \DateTime('now'),
                    'seen' => 0,
                    'message' => 'Служба поддержки ответила на ваше обращение, перейдите во вкладку «Служба поддержки» чтобы посмотреть ответ.'
                ]);
            }
            $this->redirectToRoute('/messages');
        }

        $this->render('/staff/support/messages.php', [
            'messages' => $this->supports->messages()
        ]);
    }

    public function answers() {
        $this->render('/staff/support/answers.php', [
            'messages' => $this->supports->answers()
        ]);
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
            'districts' => $this->uins->findBy(['type' => 'district']),
            'marks' => $this->marks->findAll()
        ]);
    }

    public function center() {
        if (isset($_GET['center']) && $this->uins->findOneBy(['slug' => $_GET['center']])) {
            $uin = $this->uins->findOneBy(['slug' => $_GET['center']]);

            $generalRating = $this->calculations->markGeneralRating('ko');
            $rank = null;

            foreach ($generalRating as $key => $rating) {
                if ($rating['slug'] === $_GET['center']) {
                    $rank = $key + 1;
                }
            }

            $this->render('/staff/support/center.php', [
                'district' => $uin,
                'districtBoss' => $this->users->findOneBy(['id_uin' => $uin['id']]),
                'staffs' => $this->users->findBy(['id_uin' => $uin['id'], 'id_role' => 5]),
                'type' => ($uin['type'] == 'district') ? 'district' : 'ministry',
                'marks' => $this->marks->findAll(),
                'rank' => $rank
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
