<?php
/*/ Ядро /*/ 
require_once('..'.DIRECTORY_SEPARATOR.'vendor'.DIRECTORY_SEPARATOR.'autoload.php');
$bug = new App\Registr();
$route = new App\Route(); $route->run();



/*/
 pa(array_slice(pn(false),172));
try {
    throw new Exception('The value has to be 1 or lower');
} catch (Exception $exception) {
    $bug->setException($exception);
}

pa($bug->getException());  //*/$bug->writeLog(); //*/