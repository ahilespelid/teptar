<?php 
namespace App\Controllers ;
use App\Models;

class MainController{
    public      $view, $model;
    protected   $pageData = [];

    public function __construct() {
        //$this->view  = new App\View;
        $this->model = new \App\Models\PageModel();
    }
    public function index(){
        echo '<br>Главная страница<br>';
        //phpinfo();        
    }    
    public function notfound(){
        echo 
<<<HTEG
<style type="text/css">
body{background: #000;}
h1{color: #fff; width: 100%; text-align:center; font-size: 250px; margin: 0;} 
.vid{
    margin: 0 auto; width: 360px;
}
/*
video::-webkit-media-controls {
  display:none !important;
}
*/
</style>
<h1>404</h1>
<div class="vid">
<!--video controls="controls" width="360" height="640" autoplay="autoplay" loop="loop">
  <source src="/404.mp4" type='video/mp4' />
<video-->
<iframe src="//player.vimple.ru/iframe/682f85cb893d4a88b17c885a12a3846a?autoplay=1&loop=1" width="360" height="640" frameborder="0" style="z-index:2147483647;" allowfullscreen></iframe>
</div>        
HTEG;        
    }    
}