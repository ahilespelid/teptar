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

if (isset($GLOBALS['env']) && $GLOBALS['env'] == 'dev') {
    require_once $GLOBALS['path']['layouts'] . '/developer/toolbar.php';
}

//pa($GLOBALS['url'][$_SERVER['REQUEST_URI']]);

//pa($GLOBALS['url']);

//echo $_SERVER['REQUEST_URI'];

//pa(get_class_methods($this));
