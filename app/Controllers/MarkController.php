<?php

namespace App\Controllers;

class MarkController
{
    public $counts;
    public $marks;
    public $indexes;
    public $calculations;

    public function __construct()
    {
        $this->counts = new \App\Models\CountModel;
        $this->marks = new \App\Models\MarkModel;
        $this->indexes = new \App\Models\IndexModel;
        $this->calculations = new \App\Models\CalculateModel;
    }

    public function jsonGeneralRating() {
        if (isset($_GET['mark']) && $this->marks->findOneBy(['num' => $_GET['mark']])) {
            $calculations = $this->calculations->markRating($_GET['mark']);

            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($calculations, JSON_UNESCAPED_UNICODE);
        } else {
            echo json_encode(0, JSON_UNESCAPED_UNICODE);
        }
    }
}
