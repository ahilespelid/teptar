<?php namespace App; use App\Registr;
//ini_set('memory_limit', '-1');
/*/ Режим вывода ошибок /*/
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$GLOBALS['lifeToken'] = (60*60)*24;

// Режим разработчика (Закомментировать )
//$GLOBALS['env'] = 'dev';

/*/ --------------------------------------------------------------База данных --------------------------------------------------------------/*/

$table = array(
'users'       => 'users',
'districts'   => 'districts',
'reports'   => 'reports',
'indexes'   => 'index',
'roles'   => 'roles',
'marks'   => 'marks',
'usersBlock'   => 'usersBlock',
'tableUIN'   => 'uin', 
);


$GLOBALS['db']['table'] =  $table;
$GLOBALS['db']['host'] = '194.67.90.250';
$GLOBALS['db']['base'] = 'teptar';
$GLOBALS['db']['user'] = 'tepuser';
$GLOBALS['db']['pass'] = '-Txh9y#j_sJM';

/*/ --------------------------------------------------------------Глобальный массив параметров --------------------------------------------------------------/*/

define('_DS_',DIRECTORY_SEPARATOR);
$path = dirname(__DIR__);

$path = [
'dev'       => $path,
'pub'       => $_SERVER['DOCUMENT_ROOT'],
'app'       => $path._DS_.'app',
'core'      => $path._DS_.'core',
'log'       => $path._DS_.'log',
'tmp'       => $path._DS_.'public'._DS_.'tmp',
'use'       => ['ex' => '/tmp/external', 'in' => '/tmp/internal'],
'out'       => ['ex' => 'tmp'._DS_.'external', 'in' => 'tmp'._DS_.'internal'],
'layouts'   => $path._DS_.'templates'. _DS_ . 'layouts',
'views'     => $path._DS_.'templates'. _DS_ . 'views',
];

$GLOBALS['path'] = $path;
$GLOBALS['path']['controller'] = $GLOBALS['path']['app']._DS_.'Controllers';
$GLOBALS['path']['model'] = $GLOBALS['path']['app']._DS_.'Models';
$GLOBALS['path']['view'] = $GLOBALS['path']['app']._DS_.'Views';

$url = [
// HomeController
'index'         => ['controller' => 'HomeController', 'action' => 'index'],
'error'         => ['controller' => 'HomeController', 'action' => 'error'],
'framework'     => ['controller' => 'HomeController', 'action' => 'framework'],

// DistrictController
'district'      => ['controller' => 'DistrictController', 'action' => 'district'],
'districtReports'      => ['controller' => 'DistrictController', 'action' => 'districtJsonReportsByDate'],

// ProfileController
'profile'       => ['controller' => 'ProfileController', 'action' => 'profile'],
'staff'         => ['controller' => 'ProfileController', 'action' => 'staff'],

// Пока не готовы
'login'         => ['controller' => 'UserController', 'action' => 'login'],
'exel'          => ['controller' => 'ExelController', 'action' => 'work'],
'ajax'          => ['controller' => 'AjaxController', 'action' => 'getMarkData'],
'report'        => ['controller' => 'ReportController', 'action' => 'index'],
'calculate'     => ['controller' => 'CalculateController', 'action' => 'index'],
];

$GLOBALS['url'] = $url;
$GLOBALS['mantisa'] = 16;

/*/-------------------------------------------------------------- Удочка для ошибок --------------------------------------------------------------/*/

class Config{
    public function handleUncaughtException($e){
        // */  Запись в лог исключений (new \App\Registr)->writeLog($e); // */
        // */  
        pa($e); // */
        // */  Показ вида при выявленных исключениях include $GLOBALS['path']['layouts'] . _DS_ . 'developer' . _DS_ . 'exception.php'; // */
    }
}

/*/-------------------------------------------------------------- Цепляем удочку для ошибок глобально --------------------------------------------------------------/*/
set_exception_handler([(new Config), 'handleUncaughtException']);