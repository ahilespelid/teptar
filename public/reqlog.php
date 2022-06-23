<?php
$dirname = dirname(__DIR__).DIRECTORY_SEPARATOR.'log'.DIRECTORY_SEPARATOR.'req';

$date =  new DateTime();
$timestamp = $date->getTimestamp();
$dateFormat = "Y-m-d"; 

$fileWhat = (!empty($_POST)) ? 'post_' : ((!empty($_GET)) ? 'get_' : 'request_');
$fileType = '.txt';
$file = $dirname.DIRECTORY_SEPARATOR.$fileWhat.$date->format($dateFormat).$fileType;
$mess = $_SERVER['REMOTE_ADDR'].' : '.$_SERVER['HTTP_USER_AGENT'].PHP_EOL.
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
}
foreach($fileDel as $v){
    $fileDelThis = $dirname.DIRECTORY_SEPARATOR.$v;
    if(file_exists($fileDelThis)){unlink($fileDelThis);}
}

if (!empty($_POST) || !empty($_GET) || !empty($_REQUEST)) {$fw = fopen($file, "a");
    $arr = (!empty($_POST)) ? $_POST : ((!empty($_GET)) ? $_GET : $_REQUEST);
    
    $mess .= var_export($arr, true); 
    $mess .= PHP_EOL; for($i=0;$i<250;$i++){ $mess .= '-';} $mess .= PHP_EOL; 
    
    fwrite($fw, $mess);
    fclose($fw);
}
?>