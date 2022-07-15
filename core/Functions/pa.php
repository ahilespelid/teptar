<?php
function pa($a, int $br = 0){$backtrace = debug_backtrace(); $fileinfo = '';
    if(!empty($backtrace[0]) && is_array($backtrace[0])){$fileinfo = $backtrace[0]['file'] . ":" . $backtrace[0]['line'];} 
    $a = (is_array($a)) ? $a : (array) $a; $sbr = ''; for($i=0; $i<$br; $i++){$sbr .= '<br>';}  
    echo $fileinfo.$sbr.'<pre>'; print_r($a); echo '</pre>';
    return true;
}