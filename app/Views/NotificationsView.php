<?php
 namespace App\Views ;
 
class NotificationsView extends \App\View{
    public $args = [
        'scripts' => [
            '/jquery-3.6.0.min.js',
            '/notifications/assets/js/script.js',
            '/notifications/blocks/content/content.js',
            '/notifications/blocks/content/body/body.js',
            '/notifications/blocks/content/body/__reports-title.js',
            '/notifications/blocks/content/body/__notification__notices.js',
            '/notifications/blocks/content/body/__notification__districts.js'
        ],

        'css' => [
            '/notifications/assets/css/style.css'
            '/reusable-blocks/menu/menu.css',
            '/reusable-blocks/header/header.css',
            '/notifications/blocks/content/body/body.css',
            '/notifications/blocks/content/body/__reports-title.css',
            '/notifications/blocks/content/body/__notification__districts.css',
            '/notifications/blocks/content/body/__notification__notices.css'
        ],
        'img' => [
          'avatar' => '/assets/img/avatar.jpg'
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