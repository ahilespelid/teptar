<?php  
namespace App\Models; 

class SupportModel extends \App\Data {
    public $table;

    public function __construct(){
        $this->table =$GLOBALS['db']['table']['support'];
         (object)$this->pdo = $this->connPDO();
    }

    public function messages() {
        return $this->customSQL('
            SELECT
                message.id,
                message.date,
                message.message,
                message.answered,
                sender.login AS username,
                sender.firstname,
                sender.lastname,
                sender.secondname,
                sender.avatar,
                role.post
            FROM support message
            LEFT JOIN users sender ON id_user = sender.id
            LEFT JOIN roles role ON sender.id_role = role.id
            WHERE answered = 0
            ORDER BY message.date
        ');
    }

    public function answers() {
        return $this->customSQL('
            SELECT
                questions.id AS id,
                questions.message AS question,
                message.message AS answer,
                questions.date AS question_date,
                message.date AS answer_date,
                sender.login AS username,
                sender.firstname,
                sender.lastname,
                sender.secondname,
                sender.avatar,
                role.post
            FROM support message
            LEFT JOIN support questions ON message.answerFor = questions.id
            LEFT JOIN users sender ON questions.id_user = sender.id
            LEFT JOIN roles role ON sender.id_role = role.id
            WHERE message.answered IS NULL
            ORDER BY message.date DESC 
        ');
    }

    public function questions($userId) {
        return $this->customSQL('
            SELECT
                question.id AS id,
                question.message AS question,
                answer.message AS answer,
                question.date AS question_date,
                answer.date AS answer_date,
                sender.login AS username,
                sender.firstname,
                sender.lastname,
                sender.secondname,
                sender.avatar,
                role.post
            FROM support question
            LEFT JOIN users sender ON sender.id = question.id_user
            LEFT JOIN roles role ON sender.id_role = role.id
            LEFT JOIN support answer ON answer.answerFor = question.id
            WHERE question.id_user = ' . $userId . ' AND question.answerFor IS NULL
            ORDER BY question.date DESC
        ');
    }
}
