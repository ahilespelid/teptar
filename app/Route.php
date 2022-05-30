<?php namespace App;
/*/ Определение маршрутизации адресса к экшенам /*/
class Route {
    private   $devPath,
              $controllerPath,
              $routingRules,
              $appPath,
              $corPath,
              $conPath,
              $modPath,
              $viePath;
    protected $rule, 
              $defoultAction, 
              $controllerFull;
    public    $uri, 
              $controller, 
              $action, 
              $query; 
    public function __construct(){
       (string) $this->devPath          = $GLOBALS['path']['dev'];
       (string) $this->corPath          = $GLOBALS['path']['cor'];
       (string) $this->appPath          = $GLOBALS['path']['app'];
       (string) $this->conPath          = $GLOBALS['path']['con'];
       (string) $this->modPath          = $GLOBALS['path']['mod'];
       (string) $this->viePath          = $GLOBALS['path']['vie'];
       
       (string) $this->controllerPath   = $this->devPath.
                                          $this->appPath._DS_.
                                          $this->conPath._DS_;
       (string) $this->routingRules     = $this->corPath._DS_.'RoutingRules.php';
       (string) $this->defoultAction    = 'index';
        (array) $this->uri              = $this->getUri();                                     /*/ пишем в свойство uri выбранный адресс /*/
        (array) $this->rule             = $this->getRule();                                    /*/ пишем в свойство rule правила из конфига /*/
        (array) $this->controllerFull   = $this->getController($this->uri);                    /*/ берём контроллер массивом /*/
       (string) $this->controller       = $this->controllerFull['controller'];                 /*/ берём контроллер /*/
       (string) $this->action           = $this->controllerFull['action'];                     /*/ берём экшн /*/
       (string) $this->query            = $this->controllerFull['query'];                      /*/ берём параметры запроса /*/
    }

    protected function getRule(){                                                               /*/ Метод взять правила /*/
        $fileRule = require ($this->devPath.$this->routingRules);
        return (is_array($fileRule) && !empty($fileRule)) ? $fileRule : ['index'=>['controller'=>'MainController','action'=>'index']];     
    }
    
    public function getUri(){                                                                    /*/ Метод взять url /*/
        $_SERVER['REQUEST_URI'] = ('/' == $_SERVER['REQUEST_URI'][0]) ? substr($_SERVER['REQUEST_URI'], 1) : $_SERVER['REQUEST_URI'];   
        $uri = parse_url(urldecode(trim($_SERVER['REQUEST_URI'])));
        $uri['path']  = (!empty($uri['path'])) ? $uri['path']  : $this->defoultAction.'/';
        $uri['query'] = (isset($uri['query'])) ? $uri['query'] : '';
        
        $uri['path'] = ('/' == @$uri['path'][strlen($uri['path']) -1]) ? substr($uri['path'], 0, -1) : $uri['path'];
        $uriPathLen = (0 < strlen($uri['path'])) ? strlen($uri['path']) -1 : 0;

        return $uri;        
    }
    
    public function getController($url){                                                        /*/ Метод распознать контроллер /*/
        $route = ''; $arrayReturn = [];
        $url['path']  = (isset($url['path']))  ? $url['path']  : $this->defoultAction;
        $url['query'] = (isset($url['query'])) ? $url['query'] : ''; 
        
        foreach($this->rule as $route => $arrayReturn){
            if($url['path'] === $route){
                $arrayReturn['query'] = $url['query']; return $arrayReturn;                     /*/ Нашёл контроллер молодец /*/
            }else{
                $arrayReturn = $this->rule['404']; $arrayReturn['query'] = $url['query'];       /*/ Если нет иди на хуй ) /*/
            }
        }        
        return $arrayReturn;
    }
    
    public function run(){
        $pathController     = $this->controllerPath;
        $fileController     = $this->controller.'.php';
        $actionController   = $this->action;
        $queryController    = $this->query;
        $appPathController  = ucfirst($this->appPath);
        
        $file = ($file = $pathController.$fileController) ? $file : '';
        
        if(file_exists($file)){
            include_once($file);
            if(array_key_exists($this->conPath,\pn()[$appPathController])){
                $class = $appPathController.'\\'.$this->conPath.'\\'.$this->controller;
                if(in_array($class, array_slice(pn(false),0))){
                    $run = new $class;
                    $run->$actionController();
                }
            }             
        }
        return false;
        
    echo $fileController;
    echo '<br>';
    echo $actionController;
    echo '<br>';
    echo $queryController;
    echo '<br>';
           
    \pa(get_declared_classes()); 
    \pa($this->rule); 
    \pa($GLOBALS);  
    \pa($_SERVER); 
    \pa($this->getController($this->uri));
    \pa($db->conn()->query("SELECT * FROM users;")->fetch(PDO::FETCH_ASSOC));
    \pa(PDO::getAvailableDrivers()); \pa(get_defined_functions()); \pn(); \pn(false);
    
    }
}