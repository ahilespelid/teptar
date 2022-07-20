<?php
namespace App\Models;

class NotificationModel extends \App\Data {
    public $table;

    public function __construct(){
        $this->table =$GLOBALS['db']['table']['notifications'];
         (object)$this->pdo = $this->connPDO();
    }

    public function districtsNotificationsList($receiver) {
        $sql = 'SELECT count(notifications.id) AS count, seen, receiver, flag, datetime, owner, slug, uin.id AS districtId
                FROM notifications
                LEFT JOIN uin ON notifications.sender = uin.id
                LEFT JOIN users ON notifications.receiver = users.id
                WHERE users.id = ' . $receiver . '
                GROUP BY slug
                ORDER BY notifications.datetime DESC;';

        return $this->customSQL($sql);
    }

    public function districtNotifications($receiver, $sender = null) {
        if ($sender) {
            $condition = 'WHERE users.id = ' . $receiver . ' AND uin.id = ' . $sender;
        } else {
            $condition = 'WHERE users.id = ' . $receiver;
        }

        $sql = 'SELECT seen, DATE_FORMAT(datetime,"%H:%i") as `time`, DATE_FORMAT(datetime,"%d.%m.%Y") as `date`, flag, owner, message
                FROM notifications
                LEFT JOIN uin ON notifications.sender = uin.id
                LEFT JOIN users ON notifications.receiver = users.id
                ' . $condition . '
                ORDER BY notifications.datetime DESC';

        return $this->customSQL($sql);
    }

    public function lastDistrictId($receiver) {
        $sql = 'SELECT uin.id
                FROM notifications
                LEFT JOIN uin ON notifications.sender = uin.id
                LEFT JOIN users ON notifications.receiver = users.id
                WHERE users.id = ' . $receiver .'
                ORDER BY notifications.datetime DESC LIMIT 1';

        return $this->customSQL($sql)[0]['id'];
    }
}
