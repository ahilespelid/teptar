<?php

namespace App\Controllers;

class MarkController
{
    public $counts;
    public $marks;
    public $indexes;
    public $calculations;
    public $districts;

    public function __construct()
    {
        $this->counts = new \App\Models\CountModel;
        $this->marks = new \App\Models\MarkModel;
        $this->indexes = new \App\Models\IndexModel;
        $this->calculations = new \App\Models\CalculateModel;
        $this->districts = new \App\Models\UINModel;
    }

    public function jsonGeneralRating() {
        if (isset($_GET['mark']) && $this->marks->findOneBy(['num' => $_GET['mark']]) || isset($_GET['mark']) && $_GET['mark'] == 'ko') {
            $calculations = $this->calculations->markGeneralRating($_GET['mark']);

            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($calculations, JSON_UNESCAPED_UNICODE);
        } else {
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode(0, JSON_UNESCAPED_UNICODE);
        }
    }

    public function jsonDistrictRating() {
        if (isset($_GET['mark']) && isset($_GET['district']) && $this->marks->findOneBy(['num' => $_GET['mark']]) && $this->districts->findOneBy(['slug' => $_GET['district']])) {
            $districtRating = $this->calculations->markDistrictRating($_GET['mark'], $_GET['district']);
            $markRating = $this->calculations->markGeneralRating($_GET['mark']);

            header('Content-Type: application/json; charset=utf-8');
            echo json_encode([
                'district' => $districtRating,
                'mark' => $markRating
            ], JSON_UNESCAPED_UNICODE);
        } else {
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode(0, JSON_UNESCAPED_UNICODE);
        }
    }
}
