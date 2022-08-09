<?php 
//ini_set('memory_limit', '-1');
///*/ Локаль.
setlocale(LC_ALL, 'ru_RU', 'ru_RU.UTF-8', 'ru', 'russian');
header('Content-type: text/html; charset=utf-8');
date_default_timezone_set('Europe/Moscow'); ///*/ 


/*/ Режим вывода ошибок /*/
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$GLOBALS['lifeToken'] = (3600)*24;

// Режим разработчика
//$GLOBALS['env'] = 'dev';

// База данных
$table = [
    'users'         => 'users',
    'districts'     => 'districts',
    'reports'       => 'reports',
    'indexes'       => 'index',
    'roles'         => 'roles',
    'status'        => 'status',
    'index'         => 'index',
    'marks'         => 'marks',
    'count'         => 'count',
    'notifications' => 'notifications',
    'usersBlock'    => 'usersBlock',
    'tableUIN'      => 'uin',
    'deadline'      => 'deadline',
    'calculate'     => 'calculate',
];

$GLOBALS['db']['table'] =  $table;
$GLOBALS['db']['host']  = '194.67.90.250';
$GLOBALS['db']['base']  = 'teptar';
$GLOBALS['db']['user']  = 'tepuser';
$GLOBALS['db']['pass']  = '-Txh9y#j_sJM';

/*/ --------------------------------------------------------------Глобальный массив параметров --------------------------------------------------------------/*/
if (!defined('_DS_')){define('_DS_', DIRECTORY_SEPARATOR);}
if (!defined('_LS_')){define('_LS_', '----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------');}

$path = dirname(__DIR__);
$path = [
    'dev'               => $path,
    'pub'               => $_SERVER['DOCUMENT_ROOT'],
    'app'               => $path._DS_.'app',
    'core'              => $path._DS_.'core',
    'log'                => $path._DS_.'log',
    'tmp'               => $path._DS_.'public'._DS_.'tmp',
    'layouts'         => $path._DS_.'templates'. _DS_ . 'layouts',
    'views'           => $path._DS_.'templates'. _DS_ . 'views',
];

$GLOBALS['mantisa'] = 16;

$GLOBALS['path'] = $path;
$GLOBALS['path']['controller'] = $GLOBALS['path']['app']._DS_.'Controllers';
$GLOBALS['path']['model'] = $GLOBALS['path']['app']._DS_.'Models';
$GLOBALS['path']['view'] = $GLOBALS['path']['app']._DS_.'Views';
$GLOBALS['path']['disk'] = $GLOBALS['path']['dev']._DS_.'disk';

/*/-------------------------------------------------------------- Удочка для ошибок --------------------------------------------------------------/*/

if (!function_exists('handleUncaughtException')){
    function handleUncaughtException($e){
        // */  Запись в лог исключений (new \App\Registr)->writeLog($e); // */
        // */  
        pa($e); // */
        // */  Показ вида при выявленных исключениях include $GLOBALS['path']['layouts'] . _DS_ . 'developer' . _DS_ . 'exception.php'; // */
    }
}

/*/-------------------------------------------------------------- Цепляем удочку для ошибок глобально --------------------------------------------------------------/*/
set_exception_handler('handleUncaughtException');