<?php
namespace app\core;
class View
{
    public $path;
    public $route;
    public $layout = 'default';
    public function __construct($route)
    {
        $this->route = $route;
        $this->path = $route['controller'] . '/' . $route['action'];  //вид называет ся точно также как название
    }                                                                 //контроллера с методом
    public function render($title, $vars = [])
    {
        extract($vars);    //распоковывает асоциативный массив создавая пары переменная - значение
        if (file_exists('app/views/' . $this->path . '.php')) {//проверка на существование файла вида
            ob_start();
            require 'app/views/' . $this->path . '.php'; //загрузка вида в буфер ??
            $content = ob_get_clean();
            if($this->route['controller'] == 'Admin'){
                $this->layout = 'admin';                 //лайаут админский
            }
            require 'app/views/layouts/' . $this->layout . '.php';
        } else {
            self::errorCode(403);
        }
    }
    public function redirect($url){
        header('location: '.$url); //через js
        exit;
    }
    public static function errorCode($code){
        http_response_code($code);
        require 'app/views/errors/' . $code . '.php';
        exit;
    }

    public function message($status, $message){        //через js
        exit(json_encode(['status' => $status, 'message' => $message]));
    }
    public function location($url) {              //через js
        exit(json_encode(['url' => $url]));
    }
}

