<?php
/*/ Режим вывода ошибок /*/
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
/*/ Глобальный массив параметров /*/
define('_DS_',DIRECTORY_SEPARATOR);
$GLOBALS['path']['dev'] = realpath(dirname(__DIR__)._DS_)._DS_;
$GLOBALS['path']['pub'] = $_SERVER['DOCUMENT_ROOT']._DS_;

$GLOBALS['path']['app'] = 'app';
$GLOBALS['path']['cor'] = 'core';
$GLOBALS['path']['log'] = 'log';
$GLOBALS['path']['con'] = 'Controllers';
$GLOBALS['path']['mod'] = 'Models';
$GLOBALS['path']['vie'] = 'Views';