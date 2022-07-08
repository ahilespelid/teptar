<?php return
[
// HomeController
'index'         => $GLOBALS['url']['index'],
'error'         => $GLOBALS['url']['error'],
'framework'     => $GLOBALS['url']['framework'],

// DistrictController
'district'      => $GLOBALS['url']['district'],
'districtReports'      => $GLOBALS['url']['districtReports'],

// ProfileController
'profile'       => $GLOBALS['url']['profile'],
'staff'       => $GLOBALS['url']['staff'],

// Пока не готовы
'login'         => $GLOBALS['url']['login'],        /*/ userController.php Контраллер пользователя -> экшен авторизации /*/
'exel'          => $GLOBALS['url']['exel'],         /*/ json для Внутренней вёрстки /*/
'ajax'          => $GLOBALS['url']['ajax'],
'report'        => $GLOBALS['url']['report'],
];
