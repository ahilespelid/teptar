<?php

namespace App\Service;

class Validator
{
    public $reportHaveDistrictData;
    public $indexes;
    public $mark;
    public $report;

    public function __construct()
    {
        $this->report = ['id' => 82];
        $this->mark = 1;
        $this->indexes = new \App\Models\IndexModel;
        $this->reportHaveDistrictData = $this->indexes->indexByMarkReportAndUinType($this->mark, $this->report['id'], 'district') ?? false;
    }
}
