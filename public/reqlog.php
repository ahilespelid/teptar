<?php
$file_get = $GLOBALS['path']['log'].'/get.log';
$file_post =  $GLOBALS['path']['log'].'/post.log';

if (!empty($_POST)) {
    $fw = fopen($file_post, "a");
    fwrite($fw, "POST " . var_export($_POST, true));
    fclose($fw);
}
if (!empty($_GET)) {
    $fw = fopen($file_get, "a");
    fwrite($fw, "GET " . var_export($_GET, true));
    fclose($fw);
}

?>