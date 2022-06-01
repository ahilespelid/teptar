<?php
/*/ Ядро /*/ 
require_once('..'.DIRECTORY_SEPARATOR.'vendor'.DIRECTORY_SEPARATOR.'autoload.php');
$bug = new App\Registr();
$route = new App\Route(); $route->run();

$object = [
    'mess' => 'Undefined constant "variable"',
    'file' => 'www/public/index.php',
    'line' => '17',
];

try {
    throw new Exception();
} catch (Exception $exception) {
    $bug->setException($object);
}

try {
    throw new Exception('The value has to be 1 or lower');
} catch (Exception $exception) {
    $bug->setException($exception);
}

try {
    throw new Exception('The value has to be 1 or lower');
} catch (Exception $exception) {
    $bug->setException($exception);

}

try {
    throw new Exception('The value has to be 1 or lower');
} catch (Exception $exception) {
    $bug->setException($object);
    //$bug->writeLog();
}
pa($bug->getException()); 
pa(array_slice(pn(false),172));