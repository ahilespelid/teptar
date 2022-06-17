<?php
 namespace App\Views ;
 
class DistrictView extends \App\View{
    public $args = [
        'scripts' => [
            '/jquery-3.6.0.min.js',
            '/districts/assets/js/script.js',
            '/districts/blocks/content/body/reports.js',
            '/districts/blocks/content/content.js',
            '/districts/blocks/content/body/reports-title.js',
            '/districts/blocks/content/body/reports-list.js',
            '/districts/blocks/content/body/body.js',
            '/districts/blocks/content/body/__footer.js'
        ],

        'css' => [
            '/reusable-blocks/menu/menu.css',
            '/reusable-blocks/header/header.css',
            '/districts/assets/css/style.css',
            '/districts/blocks/content/body/body.css',
            '/districts/blocks/content/content.css',
            '/districts/blocks/content/body/reports-title.css',
            '/districts/blocks/content/body/reports-list.css',
            '/districts/blocks/content/body/reports.css',
            '/districts/blocks/content/body/__footer.css'
        ],
        'img' => [
            'sort' => '/districts/assets/img/svg/sort.svg'
        ]
    
    ];
    public $layout;
    
    public function __construct() {
        $this->layout =  $GLOBALS['path']['layout'].'/blocks/districts/districts.php';
    }

    public function render(array $vars = [], string $temp=''){/*/ extract($vars, EXTR_REFS); /*/       
        $temp = (is_string($temp) && !empty($temp)) ? $temp :  $this->layout;
        $vars = array_merge($this->args, $vars);
        
        if(is_array($vars['img']) && !empty($vars['img'])){
            foreach($vars['img'] as $k => $v){
                $vars['img'][$k] = $this->imgBase($v);
        }}

        extract($vars, EXTR_REFS);
        ob_start();
        include $temp;
        $buffer = ob_get_contents();
        ob_end_clean();

        echo $buffer;}
        
}