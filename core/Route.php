<?php namespace App;
/*/ Определение маршрутизации адресса к экшенам /*/
class Route {
    private     $controllerPath,
                $routingRulesPath,
                $corPath,
                $conPath;
    protected   $rule,
                $defoultAction,
                $controllerFull;
    public      $uri,
                $controller,
                $action,
                $query;

    public function __construct() {
        (string) $this->corPath             = $GLOBALS['path']['core'];
        (string) $this->conPath             = $GLOBALS['path']['controller'];

        (string) $this->controllerPath      = $this->conPath._DS_;
        (string) $this->routingRulesPath    = $this->corPath._DS_.'RoutingRules.php';
        (string) $this->defoultAction       = 'index';
        (array) $this->uri                  = $this->getUri();                              /*/ пишем в свойство uri выбранный адресс /*/
        (array) $this->rule                 = $this->getRule();                             /*/ пишем в свойство rule правила из конфига /*/
        (array) $this->controllerFull       = $this->getController($this->uri);             /*/ берём контроллер массивом /*/
        (string) $this->controller          = $this->controllerFull['controller'];          /*/ берём контроллер /*/
        (string) $this->action              = $this->controllerFull['action'];              /*/ берём экшн /*/
        (array) $this->query                = $this->controllerFull['query'];               /*/ берём параметры запроса /*/
    }

    protected function getRule() { /*/ Метод взять правила /*/
        $fileRule = require ($this->routingRulesPath);
        return (is_array($fileRule) && !empty($fileRule)) ? $fileRule : ['index'=>['controller'=>'HomeController','action'=>'index']];
    }

    public function getUri() { /*/ Метод взять url /*/
        $_SERVER['REQUEST_URI'] = ('/' == $_SERVER['REQUEST_URI'][0]) ? substr($_SERVER['REQUEST_URI'], 1) : $_SERVER['REQUEST_URI'];   
        $uri = parse_url(urldecode(trim($_SERVER['REQUEST_URI'])));
        $uri['path']  = (!empty($uri['path'])) ? $uri['path']  : $this->defoultAction.'/';
        $uri['query'] = (isset($uri['query'])) ? $uri['query'] : '';
        
        $uri['path'] = ('/' == @$uri['path'][strlen($uri['path']) -1]) ? substr($uri['path'], 0, -1) : $uri['path'];
        $uriPathLen = (0 < strlen($uri['path'])) ? strlen($uri['path']) -1 : 0;

        return $uri;        
    }

    public function getController($url){ /*/ Метод распознать контроллер /*/
        $route = ''; $arrayReturn = [];
        $url['path']  = (isset($url['path']))  ? $url['path']  : $this->defoultAction;
        $url['query'] = (!empty($_POST) ? $_POST : (!empty($_GET) ? : false));
        
        foreach($this->rule as $route => $arrayReturn) {
            if ($url['path'] === $route) {
                $arrayReturn['query'] = $url['query']; return $arrayReturn;                           /*/ Нашёл контроллер молодец /*/
            } else {
                $arrayReturn = $this->rule['error']; $arrayReturn['query'] = $url['query'];       /*/ Если нет иди на хуй ) /*/
            }
        }        
        return $arrayReturn;
    }

    public function run() {
        $pathController     = $this->controllerPath;
        $fileController     = $this->controller.'.php';
        $actionController   = $this->action;
        $queryController    = $this->query;
        $appNameSpace       = __NAMESPACE__;

        $file = $pathController.$fileController;
        $class = $appNameSpace.'\\'.str_replace($GLOBALS['path']['app']._DS_, "", $this->conPath).'\\'.$this->controller; 

        /*/ echo $actionController; pa($queryController); /*/
        if(file_exists($file)){(new $class)->$actionController($queryController);}else{die('Файл '.$file.' не найти!');}
        return false;
    }
}
