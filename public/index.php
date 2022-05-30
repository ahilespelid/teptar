<<<<<<< HEAD
<?php use App\Registr;
=======
<?php
use App\Registry;

>>>>>>> f6fd1e3818409331b7e47c2e445de17edc3b336a
/*/ Ядро /*/
require_once('..'.DIRECTORY_SEPARATOR.'vendor'.DIRECTORY_SEPARATOR.'autoload.php');
//$route = new App\Route; $route->run();

$registry = new Registr();

$object = [
    'message' => 'Undefined constant "variable"',
    'filename' => 'www/public/index.php',
    'line' => '17',
];

try {
    throw new Exception();
} catch (Exception $exception) {
    $registry->setException($object);
    echo $registry->getException();
}

try {
    throw new Exception('The value has to be 1 or lower');
} catch (Exception $exception) {
    $registry->setException($exception);
    echo $registry->getException();
}

try {
    throw new Exception('The value has to be 1 or lower');
} catch (Exception $exception) {
    echo '<br>';
    $registry->setException($exception);
    pa($registry->getException('array'));
    $registry->writeLog();
}

try {
    throw new Exception('The value has to be 1 or lower');
} catch (Exception $exception) {
    echo '<br>';
    $registry->setException($object);
    pa($registry->getException('array'));
    $registry->writeLog();
}
