<?php
$dirname = dirname(__DIR__).DIRECTORY_SEPARATOR.'log'.DIRECTORY_SEPARATOR.'req';

$date =  new DateTime();
$timestamp = $date->getTimestamp();
$dateFormat = "Y-m-d"; 

$fileWhat = (!empty($_POST)) ? 'post_' : ((!empty($_GET)) ? 'get_' : 'request_');
$fileType = '.txt';
$file = $dirname.DIRECTORY_SEPARATOR.$fileWhat.$date->format($dateFormat).$fileType;
// */ echo $date->format('[H:i | d M Y]');  //*/
$mess = $date->format('[H:i | d M Y]').' '.$_SERVER['REMOTE_ADDR'].' : '.$_SERVER['HTTP_USER_AGENT'].PHP_EOL.
               'COOKIE : '.$_SERVER['HTTP_COOKIE'].PHP_EOL.
               strtoupper($fileWhat).$_SERVER['SCRIPT_NAME'].PHP_EOL;

if(!empty($fileAll = array_values(array_diff(scandir($dirname),['.','..'])))){
    for($i=0;$i>-90;--$i){
        $date->modify("$i day");
        $fileDontDel[] =  'post_'.$date->format($dateFormat).$fileType; 
        $fileDontDel[] =  'get_'.$date->format($dateFormat).$fileType; 
        $fileDontDel[] = 'request_'.$date->format($dateFormat).$fileType; 
        $date->setTimestamp($timestamp);    
    }
    $fileDel = array_diff($fileAll,$fileDontDel);

    foreach($fileDel as $v){
        $fileDelThis = $dirname.DIRECTORY_SEPARATOR.$v;
        if(file_exists($fileDelThis)){unlink($fileDelThis);}
    }
}

if(755<=substr(sprintf('%o', fileperms($dirname)), -3)){ 
// */
if (!empty($_POST) || !empty($_GET) || !empty($_REQUEST)){
    $mess .= var_export($arrRequist = (!empty($_POST)) ? $_POST : ((!empty($_GET)) ? $_GET : $_REQUEST), true); 
    $mess .= PHP_EOL; for($i=0;$i<250;$i++){ $mess .= '-';} $mess .= PHP_EOL; 
    
    file_put_contents($file, $mess, FILE_APPEND);
// */
}} 
?>