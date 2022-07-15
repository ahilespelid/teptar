<?php namespace App;
/*/ Определение маршрутизации адресса к экшенам /*/

use App\Service\Security;

class Route {
    private     $controllerPath,
                $routingPath,
                $rulesPath,
                $conPath,
                $corPath
    ;

    protected   $controllerFull,
                $defaultAction,
                $routes,
                $rules
    ;

    public      $controller,
                $action,
                $query,
                $uri
    ;

    public function __construct() {
        (string) $this->conPath             = $GLOBALS['path']['controller'];
        (string) $this->corPath             = $GLOBALS['path']['core'];

        (string) $this->controllerPath      = $this->conPath._DS_;
        (string) $this->routingPath         = $this->corPath._DS_.'routing.php';
        (string) $this->rulesPath           = $this->corPath._DS_.'rules.php';

        (string) $this->defaultAction       = 'index';
        (array)  $this->uri                 = $this->getUri();                              /*/ пишем в свойство uri выбранный адресс /*/
        (array)  $this->routes              = $this->getRoutes();                           /*/ пишем в свойство routes правила из конфига /*/
        (array)  $this->controllerFull      = $this->getController($this->uri);             /*/ берём контроллер массивом /*/
        (string) $this->controller          = $this->controllerFull['controller'];          /*/ берём контроллер /*/
        (string) $this->action              = $this->controllerFull['action'];              /*/ берём экшн /*/
        (array)  $this->query               = $this->controllerFull['query'];               /*/ берём параметры запроса /*/
    }

    protected function getRoutes() { /*/ Метод взятия роутов /*/
        $routesFile = require ($this->routingPath);
        return (is_array($routesFile) && !empty($routesFile)) ? $routesFile : ['index'=>['controller'=>'HomeController','action'=>'index']];
    }

    public function getUri() { /*/ Метод взять url /*/
        $_SERVER['REQUEST_URI'] = (!empty($_SERVER['REQUEST_URI'])) ? $_SERVER['REQUEST_URI'] : '/';
        $_SERVER['REQUEST_URI'] = ('/' == $_SERVER['REQUEST_URI'][0]) ? substr($_SERVER['REQUEST_URI'], 1) : $_SERVER['REQUEST_URI'];

        $uri = parse_url(urldecode(trim($_SERVER['REQUEST_URI'])));
        $uri['path']  = (!empty($uri['path'])) ? $uri['path']  : $this->defaultAction.'/';
        $uri['query'] = (isset($uri['query'])) ? $uri['query'] : '';

        $uri['path'] = ('/' == @$uri['path'][strlen($uri['path']) -1]) ? substr($uri['path'], 0, -1) : $uri['path'];
        $uriPathLen = (0 < strlen($uri['path'])) ? strlen($uri['path']) -1 : 0;

        return $uri;
    }

    public function getController($url) { /*/ Метод распознать контроллер /*/
        $route = ''; $arrayReturn = [];
        $url['path']  = (isset($url['path']))  ? $url['path']  : $this->defaultAction;
        $url['query'] = (!empty($_POST) ? $_POST : (!empty($_GET) ? : false));

        foreach($this->routes as $route => $arrayReturn) {
            if ($url['path'] === $route) {
                $arrayReturn['query'] = $url['query']; return $arrayReturn;                           /*/ Нашёл контроллер молодец /*/
            }
        }
        return $arrayReturn;
    }

    public function run() {
        $actionController   = $this->action;
        $queryController    = $this->query;
        $appNameSpace       = __NAMESPACE__;
        $class = $appNameSpace.'\\'.str_replace($GLOBALS['path']['app']._DS_, "", $this->conPath).'\\'.$this->controller;
        $security = new Security();

        if ($security->rightToAccess()) {
            (new $class)->$actionController($queryController);
        } else {
            $security->error();
        }
    }
}
