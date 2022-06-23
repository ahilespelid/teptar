<?php namespace App;
//ini_set('memory_limit', '-1');
/*/ Режим вывода ошибок /*/
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$GLOBALS['lifeToken'] = (60*60)*1;
$GLOBALS['env'] = 'dev';

/*/ --------------------------------------------------------------База данных --------------------------------------------------------------/*/

$table = array(
'users'       => 'users',
'districts'   => 'districts',
'roles'   => 'roles',
'usersBlock'   => 'usersBlock',

);
$GLOBALS['db']['table'] =  $table;
$GLOBALS['db']['host'] = '194.67.90.250';
$GLOBALS['db']['base'] = 'teptar';
$GLOBALS['db']['user'] = 'tepuser';
$GLOBALS['db']['pass'] = '-Txh9y#j_sJM';

/*/ --------------------------------------------------------------Глобальный массив параметров --------------------------------------------------------------/*/

define('_DS_',DIRECTORY_SEPARATOR);
$path = dirname(__DIR__);
$path =array(
'dev'       => $path,
'pub'       =>$_SERVER['DOCUMENT_ROOT'],
'app'       => $path._DS_.'app',
'core'      => $path._DS_.'core',
'log'        => $path._DS_.'log',
'temp'     => $path._DS_.'temp',
'tmp'     => $path._DS_.'public'._DS_.'tmp',
'use' => ['ex' => '/tmp/external', 'in' => '/tmp/internal'],
'out' => ['ex' => 'tmp'._DS_.'external', 'in' => 'tmp'._DS_.'internal'],

'layouts'     => $path._DS_.'templates'. _DS_ . 'layouts' . _DS_,
'views'     => $path._DS_.'templates'. _DS_ . 'views' . _DS_,
);

$GLOBALS['path'] = $path;
$GLOBALS['path']['controller'] = $GLOBALS['path']['app']._DS_.'Controllers';
$GLOBALS['path']['model'] = $GLOBALS['path']['app']._DS_.'Models';
$GLOBALS['path']['view'] = $GLOBALS['path']['app']._DS_.'Views';

$GLOBALS['path']['layout'] = $GLOBALS['path']['temp']._DS_.'internal'._DS_;

$url = array(
'index' => ['controller' => 'MainController', 'action' => 'index'],
'404'    => ['controller' => 'MainController', 'action' => 'notfound'],
'login'  => ['controller' => 'UserController', 'action' => 'login'],
'exel'   => ['controller' => 'ExelController', 'action' => 'work'],
'ajax'   => ['controller' => 'AjaxController', 'action' => 'getMarkData'],
'district'   => ['controller' => 'DistrictController', 'action' => 'index'],
'report'   => ['controller' => 'ReportController', 'action' => 'index'],
'framework'   => ['controller' => 'FrameworkController', 'action' => 'index'],

'profile'   => ['controller' => 'ProfileController', 'action' => 'profile'],

);

$GLOBALS['url'] = $url;

/*/-------------------------------------------------------------- Удочка для ошибок --------------------------------------------------------------/*/

class Config{
    public function handleUncaughtException($e){
        $registr = new Registr();
        $registr->writeLog($e);

        /*/ Показ вида при выявленных исключениях /*/
        include $GLOBALS['path']['views'] . 'errors' . _DS_ . 'exception.php';
    }
}

/*/-------------------------------------------------------------- Цепляем удочку для ошибок глобально --------------------------------------------------------------/*/

set_exception_handler([(new Config), 'handleUncaughtException']);
