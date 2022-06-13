<?php
 namespace App\Views ;
 
class ReportsView extends \App\View{
    public $args = [
        'scripts' => [
            '/jquery-3.6.0.min.js',
            '/reports/assets/js/reports.js',
            '/reports/blocks/content/body/body.js',
            '/reports/blocks/content/body/__reports-title.js',
            '/reports/blocks/content/body/__reports.js',
            '/reports/blocks/content/body/__reports-footer.js',
            '/reports/blocks/content/content.js'
        ],
        'css' => [
            '/reports/assets/css/style.css',
            '/reusable-blocks/menu/menu.css',
            '/reusable-blocks/header/header.css',
            '/reports/blocks/content/content.css',
            '/reports/blocks/content/body/body.css',
            '/reports/blocks/content/body/__reports.css',
            '/reports/blocks/content/body/__reports-title.css',
            '/reports/blocks/content/body/__reports-footer.css'
        ],

        'img' => [
            'add_ring_light' => '/reports/assets/img/svg/add_ring_light.svg',
            'setting' => '/reports/assets/img/svg/setting.svg',
            'assistant' => '/reports/assets/img/avatar.jpg',
            'responsible' => '/reports/assets/img/avatar.jpg',
            'xlsx' => '/reports/assets/img/svg/xlsx.svg',
            'word' => '/reports/assets/img/svg/word.svg',
            'pdf' => '/reports/assets/img/svg/pdf.svg',
            'arrow_drop_down_black' => '/reports/assets/img/svg/arrow_drop_down_black.svg'
        ]
    ];
    public $layout;
    
    public function __construct() {
        $this->layout =  $GLOBALS['path']['layout'].'auth.php';
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