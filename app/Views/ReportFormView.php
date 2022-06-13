<?php
 namespace App\Views ;
 
class ReportFormView extends \App\View{
    public $args = [
        'scripts' => [
            '/jquery-3.6.0.min.js',
            '/report-form/blocks/content/body/body.js',
            '/report-form/blocks/content/body/reports-title.js',
            '/report-form/blocks/content/body/reports-form.js',
            '/report-form/blocks/content/body/__body.js',
            '/report-form/blocks/content/body/__footer.js',
            '/report-form/blocks/content/content.js'
        ],

        'css' => [
            '/report-form/assets/css/style.css',
            '/reusable-blocks/menu/menu.css',
            '/reusable-blocks/header/header.css',
            '/blocks/content/content.css',
            '/blocks/content/body/body.css',
            '/blocks/content/body/reports-title.css',
            '/blocks/content/body/reports-form.css',
            '/blocks/content/body/__body.css',
            '/blocks/content/body/__footer.css'
        ],

        'img' => [
            'import_light' => '/assets/img/svg/import_light.svg',
            'rename_light' => '/assets/img/svg/light/rename_light.svg',
            'rename' => '/assets/img/svg/rename.svg',
            'add_ring_light' => '/assets/img/svg/add_ring_light.svg',
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