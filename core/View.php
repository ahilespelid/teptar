<?php
namespace App;

abstract class View{
    private $templatePath;

    function __construct(){}

    public function imgBase($imgPath= ''){
       $imgPath = $GLOBALS['path']['layout'].$imgPath;              
       $imgPath = (file_exists($imgPath)) ? $imgPath : $GLOBALS['path']['pub']._DS_.'favicon.ico';
       
       $ext = mb_strtolower(pathinfo($imgPath)['extension']);
     
        if (in_array($ext, array('jpeg', 'jpg', 'gif', 'png', 'webp', 'svg'))){
            if ($ext == 'svg'){
                $img = 'data:image/svg+xml;base64,' . base64_encode(file_get_contents($imgPath));
            }else{
                $img = 'data:' . getimagesize($imgPath)['mime'] . ';base64,' . base64_encode(file_get_contents($imgPath));
        }}
        return ((!empty($img)) ? $img : false);}

    public function scriptCompilator($scripts = [], $path = '') {
        if(!is_array($scripts) && empty($scripts) && is_array(current($scripts))
            && empty($path) && !file_exists($path)) {return false;}

        $path = ('/' == $path[count($path) - 1]) ? trim($path[count($path) - 1] = ' ') : $path;

        foreach ($scripts as $item) {
            file_get_contents($path . $item);
        }

    }

}