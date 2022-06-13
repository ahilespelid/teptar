<?php
 namespace App\Views ;
 
class VillageView extends \App\View{
    public $args = [
        'scripts' => [
            '/district/assets/js/script.js',
            '/district/blocks/content/body/body.js',
            '/district/blocks/content/body/__reports-title.js',
            '/district/blocks/content/body/__reports.js',
            '/district/blocks/content/body/__reports-footer.js',
            '/district/blocks/content/content.js'
        ],
        'css' => [
            '/reusable-blocks/menu/menu.css',
            '/reusable-blocks/header/header.css',
            '/district/assets/css/style.css',
            '/district/blocks/content/content.css',
            '/district/blocks/content/body/body.css',
            '/district/blocks/content/body/__reports-title.css',
            '/district/blocks/content/body/__reports-footer.css',
            '/district/blocks/content/body/__reports.css'
        ],
        'img' => [
            'expand_left_right' => '/assets/img/svg/expand_left_right.svg',
            'sort' => '/assets/img/svg/sort.svg',
            'setting' => '/assets/img/svg/setting.svg',
            'xlsx' => '/assets/img/svg/xlsx.svg',
            'word' => '/assets/img/svg/word.svg',
            'pdf' => '/assets/img/svg/pdf.svg'
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