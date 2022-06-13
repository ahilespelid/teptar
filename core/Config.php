<?php 
//ini_set('memory_limit', '-1');
/*/ Режим вывода ошибок /*/
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
    
/*/ Удочка для ошибок /*/
function handleUncaughtException($e){
    echo
'<center>
    <h3>Что-то пошло не так. </h3>
    <h4>Cвяжитесь с нами 
            <a href="mailto:ahilespelid@yandex.ru">@ahilespelid</a>, 
            если проблема не исчезнет.
    </h4>
</center>';  
    
    $bug = (is_object($GLOBALS['bug']) && $GLOBALS['bug'] instanceof \App\Registr) ? $GLOBALS['bug'] : false;
    $bugClassCheck =  (is_object($bug)) ? true : false;
     
    $extMessage = ($bugClassCheck) ? $e->getMessage() : 'Failed to identify the Register object'; 
    $exFile          = ($bugClassCheck) ? $e->getFile()          : __FILE__;
    $exLine          = ($bugClassCheck) ? $e->getLine()         : __LINE__;
    $exDate         =  (new \DateTime('now'))->format('[H:i | d M Y]');
 
     if($bugClassCheck){
         $bug->setException($e);
     }else{        
        $o = (object)['message' => $extMessage, 'file' => $exFile, 'line' => $exLine];
        (new \App\Registr)->setException($o)->writeLog();
     } 
     echo '<span style="color: #ce4040">' .$exDate. '</span> '.$extMessage.' <b>'.'$exFile'.'</b> <small>(line ' .'$exLine'. ')</small><br>';   
    return false;
}
/*/ Цепляем удочку для ошибок глобально /*/ 
set_exception_handler("handleUncaughtException");
/*/ База данных /*/
$table =array(
'users'       => 'users',
'districts'   => 'districts',

);
$GLOBALS['db']['table'] =  $table;
$GLOBALS['db']['host'] = '194.67.90.250';
$GLOBALS['db']['base'] = 'teptar';
$GLOBALS['db']['user'] = 'tepuser';
$GLOBALS['db']['pass'] = '-Txh9y#j_sJM';
/*/ Глобальный массив параметров /*/
define('_DS_',DIRECTORY_SEPARATOR);
$path = dirname(__DIR__);

$path =array(
'dev'       => $path,
'pub'       =>$_SERVER['DOCUMENT_ROOT'],

'app'       => $path._DS_.'app',
'core'      => $path._DS_.'core',
'log'        => $path._DS_.'log',
'temp'     => $path._DS_.'temp',

'use' => ['ex' => '/tmp/external', 'in' => '/tmp/internal'],
'out' => ['ex' => 'tmp'._DS_.'external', 'in' => 'tmp'._DS_.'internal'],
);

$GLOBALS['path'] = $path;
$GLOBALS['path']['controller'] = $GLOBALS['path']['app']._DS_.'Controllers';
$GLOBALS['path']['model'] = $GLOBALS['path']['app']._DS_.'Models';
$GLOBALS['path']['view'] = $GLOBALS['path']['app']._DS_.'Views';

$GLOBALS['path']['layout'] = $GLOBALS['path']['temp']._DS_.'internal'._DS_;
?>