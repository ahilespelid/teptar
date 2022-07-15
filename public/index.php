<?php /*/ Ядро /*/ 
//*/ 
require_once('..'.DIRECTORY_SEPARATOR.'vendor'.DIRECTORY_SEPARATOR.'autoload.php'); //*/
//*/ 
$bug = new App\Registr(); //*/ 
//*/ 
(new App\Route)->run(); //*/
 //*/ 
$bug->writeLog(); //*/
 //*/ 
if (isset($GLOBALS['env']) && $GLOBALS['env'] == 'dev'){require_once $GLOBALS['path']['layouts'] . '/developer/toolbar.php';} //*/