<?php
function pa($a){$backtrace = debug_backtrace(); $fileinfo = '';
    if(!empty($backtrace[0]) && is_array($backtrace[0])){$fileinfo = $backtrace[0]['file'] . ":" . $backtrace[0]['line'];} 
    $a = (is_array($a)) ? $a : (array) $a;  
    echo $fileinfo.'<br><br><br><br><br><br>'.'<pre>'; print_r($a); echo '</pre>';
    return true;
}