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

/*/ Глобальный массив параметров /*/
define('_DS_',DIRECTORY_SEPARATOR);
$GLOBALS['path']['dev'] = realpath(dirname(__DIR__)._DS_)._DS_;
$GLOBALS['path']['pub'] = $_SERVER['DOCUMENT_ROOT']._DS_;

$GLOBALS['path']['app']         = 'app';
$GLOBALS['path']['cor']          = 'core';
$GLOBALS['path']['log']          = 'log';
$GLOBALS['path']['tmp']         = 'tmp';
$GLOBALS['path']['con']         = 'Controllers';
$GLOBALS['path']['mod']        = 'Models';
$GLOBALS['path']['vie']          = 'Views';

$GLOBALS['db']['host']           = '194.67.90.250';
$GLOBALS['db']['base']          = 'teptar';
$GLOBALS['db']['user']           = 'tepuser';
$GLOBALS['db']['pass']          = '-Txh9y#j_sJM';
 
?>