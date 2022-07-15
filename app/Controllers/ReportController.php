<?php

namespace App\Controllers;

class ReportController extends AbstractController{
    public $model, $uinModel,
                $users,
                $user,
                $statuses;

    public function __construct() {
        $this->model            = new \App\Models\ReportModel;
        $this->uinModel         = new \App\Models\UINModel;
        $this->userModel        = new \App\Models\UserModel;
        $this->statuses         = new \App\Models\StatusModel;
        $this->user             = new UserController();
    }

    public function reports() {
        $reports = [];
        $district = $this->uinModel->findOneBy(['slug' => $_GET['district']]);

        foreach ($this->model->findBy(['id_uin' => $district['id']]) as $key => $report) {
            $reports[$key] = [
                'report' => $report,
                'boss' => $this->userModel->findOneBy(['id' => $report['id_userBoss']]),
                'staff' => $this->userModel->findOneBy(['id' => $report['id_userStaff']]),
                'status' => $this->statuses->findOneBy(['id' => $report['status']])
            ];
        }

        $this->render('/staff/report/reports.php', [
            'reports' => $reports,
            'district' => $district
        ]);
    }

    public function report() {
        $report = $this->model->findOneBy(['id' => $_GET['id']]);

        $data = [
            'report' => $report,
            'district' => $this->uinModel->findOneBy(['id' => $report['id_uin']]),
            'boss' => $this->userModel->findOneBy(['id' => $report['id_userBoss']]),
            'staff' => $this->userModel->findOneBy(['id' => $report['id_userStaff']]),
            'status' => $this->statuses->findOneBy(['id' => $report['status']])
        ];

        $this->render('/staff/report/report.php', [
            'data' => $data
        ]);
    }

}
