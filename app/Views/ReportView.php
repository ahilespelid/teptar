<?php
 namespace App\Views ;
 
class ReportView extends \App\View{
    public $args = [
        'scripts' => [
            '/jquery-3.6.0.min.js',
            '/reusable-blocks/menu/menu.js',
            '/reusable-blocks/menu/__main.js',
            '/reusable-blocks/menu/__header.js',
            '/reusable-blocks/menu/__body.js',
            '/reusable-blocks/menu/__footer.js',
        ],

        'css' => [
            '/font.css',
            '/reusable-blocks/menu/menu.css',
            '/reusable-blocks/menu/__main.css',
            '/reusable-blocks/menu/__header.css',
            '/reusable-blocks/menu/__body.css',
            '/reusable-blocks/menu/__footer.css',
        ],

        'img' => [
            'logo' => '/assets/img/logo.svg',

        ]
    ];

    public function render(array $vars = [], string $temp=''){/*/ extract($vars, EXTR_REFS); /*/       
        $temp = (empty($temp)) ? $GLOBALS['path']['layout'].'auth.php' : $temp;
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