<?php
    $GLOBALS['url'] =
    [
    // LEADER //

    // HomeController
    'index'                     =>  ['controller' => 'HomeController', 'action' => 'index'],
    'framework'                 =>  ['controller' => 'HomeController', 'action' => 'framework'],

    // DistrictController
    'district'                  =>  ['controller' => 'DistrictController', 'action' => 'district'],
    'districtReports'           =>  ['controller' => 'DistrictController', 'action' => 'districtJsonReportsByDate'],

    // ProfileController
    'leader'                    =>  ['controller' => 'ProfileController', 'action' => 'leader'],
    'staff'                     =>  ['controller' => 'ProfileController', 'action' => 'staff'],
    'profile'                   =>  ['controller' => 'ProfileController', 'action' => 'profile'],
    'notifications'             =>  ['controller' => 'ProfileController', 'action' => 'notifications'],
    'districtNotifications'     =>  ['controller' => 'ProfileController', 'action' => 'districtNotificationsJSON'],

    // MarkController
    'ratingByMark'              =>  ['controller' => 'MarkController', 'action' => 'jsonRatingByMark'],

    // STAFF //

    // DistrictController
    'districts'                 =>  ['controller' => 'DistrictController', 'action' => 'districts'],

    // ReportController
    'reports'                   =>  ['controller' => 'ReportController', 'action' => 'reports'],
    'report'                    =>  ['controller' => 'ReportController', 'action' => 'report'],
    'report/new'                =>  ['controller' => 'ReportController', 'action' => 'new'],

    // ПОКА НЕ ГОТОВЫ //
    'login'                     =>  ['controller' => 'UserController', 'action' => 'login'],
    'exel'                      =>  ['controller' => 'ExelController', 'action' => 'work'],
    'ajax'                      =>  ['controller' => 'AjaxController', 'action' => 'getMarkData'],
    'calculate'                 =>  ['controller' => 'CalculateController', 'action' => 'index'],
    ];

    return $GLOBALS['url'];
