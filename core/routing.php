<?php
    $GLOBALS['url'] =
    [
    // LEADER //

    // HomeController
    'index'             =>  ['controller' => 'HomeController', 'action' => 'index'],
    'framework'         =>  ['controller' => 'HomeController', 'action' => 'framework'],

    // DistrictController
    'district'          =>  ['controller' => 'DistrictController', 'action' => 'district'],
    'districtReports'   =>  ['controller' => 'DistrictController', 'action' => 'districtJsonReportsByDate'],

    // ProfileController
    'leader'           =>  ['controller' => 'ProfileController', 'action' => 'leader'],
    'staff'             =>  ['controller' => 'ProfileController', 'action' => 'staff'],

    // STAFF //

    // DistrictController
    'districts'         =>  ['controller' => 'DistrictController', 'action' => 'districts'],

    // ReportController
    'reports'           =>  ['controller' => 'ReportController', 'action' => 'reports'],
    'report'            =>  ['controller' => 'ReportController', 'action' => 'report'],
    'report/new'        =>  ['controller' => 'ReportController', 'action' => 'new'],

    // ПОКА НЕ ГОТОВЫ //
    'login'             =>  ['controller' => 'UserController', 'action' => 'login'],
    'exel'              =>  ['controller' => 'ExelController', 'action' => 'work'],
    'ajax'              =>  ['controller' => 'AjaxController', 'action' => 'getMarkData'],
    ];

    return $GLOBALS['url'];
