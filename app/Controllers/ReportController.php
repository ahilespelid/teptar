<?php

namespace App\Controllers;

use App\Service\Security;

class ReportController extends AbstractController{
    public $model;
    public $uinModel;
    public $statuses;
    public $security;
    public $indexes;

    public function __construct() {
        $this->model    = new \App\Models\ReportModel;
        $this->uinModel = new \App\Models\UINModel;
        $this->statuses = new \App\Models\StatusModel;
        $this->users    = new \App\Models\UserModel;
        $this->indexes    = new \App\Models\IndexModel();
        $this->security = new Security();
    }

    public function reports() {
        if ($this->security->userHasRole(['ministry_boss']) && isset($_GET['district'])) {
            $districtSlug = $_GET['district'];
        } elseif ($this->security->userHasRole(['district_boss', 'district_staff'])) {
            $districtSlug = $this->user()['uin']['slug'];
        } else {
            $districtSlug = false;
        }

        $district = $this->uinModel->findOneBy(['slug' => $districtSlug]);

        if ($district) {
            $reports = [];

            foreach ($this->model->findBy(['id_uin' => $district['id']]) as $key => $report) {
                $reports[$key] = [
                    'report' => $report,
                    'boss' => $this->users->findOneBy(['id' => $report['id_userBoss']]),
                    'staff' => $this->users->findOneBy(['id' => $report['id_userStaff']]),
                    'status' => $this->statuses->findOneBy(['id' => $report['status']])
                ];
            }

            $this->render('/staff/report/reports.php', [
                'reports' => $reports,
                'district' => $district
            ]);
        } else {
            $this->security->error('404', 'Такого района не существует');
        }
    }

    public function report() {
        if (isset($_GET['id'])) {
            $report = $this->model->findOneBy(['id' => $_GET['id']]);

            $data = [
                'report' => $report,
                'district' => $this->uinModel->findOneBy(['id' => $report['id_uin']]),
                'boss' => $this->users->findOneBy(['id' => $report['id_userBoss']]),
                'staff' => $this->users->findOneBy(['id' => $report['id_userStaff']]),
                'status' => $this->statuses->findOneBy(['id' => $report['status']])
            ];

            $this->render('/staff/report/report.php', [
                'data' => $data,
                'indexes' => $this->indexes->getActivity($report['id'])
            ]);
        } else {
            $this->security->error('404', 'Такой отчет не существует');
        }
    }

    public function table() {
        $this->render('/staff/report/table.php');
    }

    public function new() {
        $district = $this->uinModel->findOneBy(['id' => $this->user()['uin']['id']]);

        if ($_POST) {
            $entries = [
                'name' => 'Отчет ' . (new \DateTime('now'))->format('d.m.o') . ' (Район: ' . $district['owner'] . ')'
            ];

            if (isset($_POST['report_description'])) {
                $entries['description'] = $_POST['report_description'];
            }

            if (isset($_POST['report_staff'])) {
                $staffs = implode(', ', $_POST['report_staff']);
                $entries['id_userStaff'] = $staffs;
            }

            $this->model->add($entries);

            $this->redirectToRoute('/reports');
        }

        $this->render('/staff/report/form.php', [
            'staffs' => $this->users->findBy(['id_uin' => $this->user()['uin']['id'], 'id_role' => 5]),
            'district' => $district
        ]);
    }
}
