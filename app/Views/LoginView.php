<?php
 namespace App\Views ;
 
class LoginView extends \App\View{
    public $args = [
    'img' => ['Logotype' => '/assets/images/logotype-large.png'],
    
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