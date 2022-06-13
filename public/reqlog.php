<?php 
$dirname = dirname(__DIR__).DIRECTORY_SEPARATOR.'log'.DIRECTORY_SEPARATOR.'req';

$date =  new DateTime();
$timestamp = $date->getTimestamp();
$dateFormat = "Y-m-d"; 

$fileWhat = (!empty($_POST)) ? 'post_' : ((!empty($_GET)) ? 'get_' : 'request_');
$fileType = '.txt';
$file = $dirname.DIRECTORY_SEPARATOR.$fileWhat.$date->format($dateFormat).$fileType;

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

if (!empty($_POST)) {
    $fw = fopen($file, "a");
    fwrite($fw, "POST " . var_export($_POST, true));
    fclose($fw);
}
if (!empty($_GET)) {
    $fw = fopen($file, "a");
    fwrite($fw, "GET " . var_export($_GET, true));
    fclose($fw);
}
?>