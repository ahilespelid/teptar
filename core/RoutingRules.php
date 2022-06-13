<?php return   
[   /*/ -> /*/
'index'              => ['controller' => 'MainController', 'action' => 'index'],     /*/ mainController.php Главный контроллер -> экшен index /*/        
'404'                 => ['controller' => 'MainController', 'action' => 'notfound'],     /*/ mainController.php Главный контроллер -> экшен 404 /*/        
'login'                => ['controller' => 'UserController', 'action' => 'login'],    /*/ userController.php Контраллер пользователя -> экшен авторизации /*/      
'exel'                => ['controller' => 'ExelController', 'action' => 'work'],    /*/ json для Внутренней вёрстки /*/      
'getMarkData'  => ['controller' => 'AjaxController', 'action' => 'getMarkData'],    /*/  /*/      
];