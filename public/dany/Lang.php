<?php

    /*/Язык - перевод/*/
    $MESS = array();
    function LoaderGetMessage($name)
    {
        global $MESS;
        return $MESS[$name];
    }
    /*/Пример $strError = LoaderGetMessage('Ministry_Education');/*/

    /*/Права пользователей/*/

    /*/ Министерства /*/
    $MESS["Ministry_Education"]             =       'Министерство образования';
    $MESS["Ministry_Culture"]               =       'Министерство культуры';
    $MESS["Ministry_Labor"]                 =       'Министерство труда';
    $MESS["Ministry_Agriculture"]           =       'Министерство Сельского хозяйства';
    $MESS["Ministry_Communal"]              =       'Министерство Строительства ЖКХ';
    $MESS["Ministry_Sports"]                =       'Министерство спорта';
    $MESS["Ministry_Economics"]             =       'Министерство экономического, территориального развития и торговли';

    /*/ Остальные ведомства /*/
    $MESS["Department_Chechenstat"]         =       'Чеченстат';
    $MESS["Department_OMS"]                 =       'ОМС';
    $MESS["Department_Financial"]           =       'ФинУпр';
    $MESS["Department_Kpdo"]                =       'КПДО';


    /*/ Районы /*/
    $MESS["Village_Boss"]                   =       'Глава Района';
    $MESS["Village_Personal"]               =       'Сотрудник Района';

    /*/ Регион /*/
    $MESS["Region_Boss"]                    =       'Глава Района';
    $MESS["Region_Personal"]                =       'Сотрудник Района';

    /*/ Администратор /*/
    $MESS["Admin"]                          =        'Администратор';


    //Для страниц
    $MESS["Not_found_page"]                 =        'Ошибка 404. Страница не найдена.';     /*/ Ошибка. Страница не найдена /*/
    $MESS["Not_found"]                      =        'Не найдено.';                          /*/ Ошибка. Не найден какой-либо объект /*/