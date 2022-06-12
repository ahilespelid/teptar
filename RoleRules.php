<?php
#Права пользователей

$roles = [                                                                       /*/ -> /*/
    /*/ Права для пользователя /*/
    'Role_auth' => [
        'signup' => 'Регистрация сотрудника',
        'logout' => 'Выйти из системы',
    ],

    /*/ Общие права пользователей /*/
    'Role_default' => [

    ],

    /*/ Права для просмотра /*/
    'Role_viewing' => [

    ],

    /*/ Права работы с Диском /*/
    'Role_disk' => [

    ],

    /*/ Права работы с Данными в таблице /*/
    'Role_table' => [

    ],

];


$role_name = [

    /*/ 1 Админ /*/
    'Admin' => ['Admin'],

    /*/ 2 Регион /*/
    'Region' => ['Region_Boss', 'Region_Personal'],

    /*/ 3 Район /*/
    'Village' => ['Village_Boss', 'Village_Personal'],

    /*/ 4 Министерства /*/
    'Ministries' => ['Ministry_Education', 'Ministry_Culture', 'Ministry_Labor', 'Ministry_Agriculture', 'Ministry_Communal', 'Ministry_Sports', 'Ministry_Economics'],

    /*/ 5 Остальные ведомства /*/
    'Departments' => ['Department_Chechenstat', 'Department_OMS', 'Department_Financial', 'Department_Kpdo'],
    ];

