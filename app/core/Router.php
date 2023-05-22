<?php

namespace app\core;

class Router
{
    protected $routes = [];
    protected $params = [];
    function __construct()
    {
        $arr = require 'app/configuration/routes.php';
        foreach ($arr as $key => $val){
            $this->add($key, $val);
        }
        $this->start();
    }

    public function add($route, $params){
        $route = preg_replace('/{([a-z]+):([^\}]+)}/', '(?P<\1>\2)', $route);
        $route = '#^'.$route.'$#';
        $this->routes[$route] = $params;
    }
    public function match() {
        $url = trim($_SERVER['REQUEST_URI'], '/');
        foreach ($this->routes as $route => $params) {
            if (preg_match($route, $url, $matches)) {   //сравнивает рут и юрл если совпадает то собираеь параметры
                foreach ($matches as $key => $match) {
                    if (is_string($key)) {
                        if (is_numeric($match)) {
                            $match = (int) $match;
                        }
                        $params[$key] = $match;
                    }
                }
                $this->params = $params;
                return true;
            }
        }
        return false;
    }
    public function start(){
        if($this->match()){   //если все сработало отправляем
            $path = "app\controllers\\".ucfirst($this->params['controller']).'Controller';
            if(class_exists($path)){  //если существует такой класс такого контроллера то идем дальше иначе выдаем ошибку
                $action = $this->params["action"].'Action';
                //debug($action);
                if(method_exists($path, $action)){//берем метод из параметров, если он существует то кайф
                    $controller = new $path($this->params); //создаем контроллер  String class = ''
                    $controller->$action();  //запускаем действие отношительно него   new class
                }
                else{
                    View::errorCode(404);
                }
            } else{

                View::errorCode(404);
            }

        } else{
            View::errorCode(404);
        }
    }
}