<?php
namespace App\Controller;

use Core\security\Auth;

class AbstractController {

    private $routes = [];

    function addRoutes($routes) {
        foreach($routes as $key => $value)
        {
            $this->routes[$key] = $value;
        }
    }

    function getRoutes()
    {
        return $this->routes;
    }

    function getPath($name, $params = [])
    {
        $route = current($this->routes);
        if(!empty($this->routes[$name])) $route = $this->routes[$name];
        foreach($params as $key => $param){
            $route .= "&$key=$param";
        }
        return URI.$route;
    }

    function redirectToRoute($name, $params = []) {
        $route = current($this->routes);
        if(!empty($this->routes[$name])) $route = $this->routes[$name];
        foreach($params as $key => $param){
            $route .= "&$key=$param";
        }
        header('Location:'.URI.$route);
    }

    function render($view) {
        return ROOT . "/App/View/" . $view;
    }

    public function __construct($model)
    {
        $this->model = $model;
        $this->auth = new Auth($model);
        $this->addRoutes([
            "home" => "",
            "register" => "?page=register",
            "login" => "?page=login",
            "friendssearch" => "?page=friendssearch",
            "poll_responses" => "?page=sondage",
            "sondage_result" => "?page=sondageResult",
        ]);
    }

}