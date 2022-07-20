<?php

namespace App\Controllers;

class MarkController
{
    public $counts;

    public function __construct()
    {
        $this->counts = new \App\Models\CountModel;
    }

    public function jsonRatingByMark() {
        if (isset($_GET['mark']) && $this->counts->findOneBy(['mark' => $_GET['mark']])) {
            $rating = $this->counts->findBy(['mark' => $_GET['mark']]);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($rating, JSON_UNESCAPED_UNICODE);
        } else {
            echo json_encode(0, JSON_UNESCAPED_UNICODE);
        }
    }
}
