<?php
class Main{
    public $favico,$title, $content, $footer, $route, $startTime;
    public function __construct(){
        $this->route = self::getRoute();
        
        $this->favico  = (empty($this->favico))  ? $this->favico  : '';
        $this->title   = (empty($this->title))   ? $this->title   : '';
        $this->content = (empty($this->content)) ? $this->content : '';
        $this->footer  = (empty($this->footer))  ? $this->footer  : '';
        
        $this->startTime = microtime(true);
    }
    public function getMainModel(){
        $main = new App\Models\MainModel;
        return (is_object($main)) ? $main : false;
    }
    public function getRoute(){
        $r = (array_key_exists('r', $_REQUEST)) ?  $_REQUEST['r'] : '';
        if(is_array($r) && 1 < count($r)){
            $r = explode('/', $r); unset($r[0]); 
            return $r = array_values($r);
        }
        return false;
    }
    public function getContent(){
        $mainContent = new App\Views\MainModel;
        return (is_object($mainContent)) ? $mainContent : false;
    }
    
    public function return_view(){}
}