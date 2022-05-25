<?php
function pa(array $a){$backtrace = debug_backtrace(); $fileinfo = '';
    if(!empty($backtrace[0]) && is_array($backtrace[0])){
        $fileinfo = $backtrace[0]['file'] . ":" . $backtrace[0]['line'];
    }   
    echo $fileinfo.'<br>'.'<pre>'; print_r($a); echo '</pre>';
    return true;
}