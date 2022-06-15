<?php
 namespace App\Views ;
 
class ProfileView extends \App\View{
    public $args = [
    'img' => ['Logotype' => '/assets/images/logotype-large.png'],
    
    ];
    public $layout;
    
    public function __construct() {
        $this->layout =  $GLOBALS['path']['temp']._DS_.'internal'._DS_. 'profile' ._DS_.'index.php';
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
