<?php

class Router {
    private $routes;
    function __construct($routes){
        $this->routes = $routes;
    }
    private function getUrl() {
        if(!empty($_SERVER['REQUEST_URI'])){
            $str = str_replace(SITE_ROOT, '', trim($_SERVER['REQUEST_URI']));
            $getParams = strstr($str,'?');
            $str = str_replace($getParams,'',$str);
            return $str;
        }
    }
    public function run() {
        $url = $this->getUrl();
        foreach ($this->routes as $key => $value){
            if(preg_match( "~$key~", $url)){
                $str = preg_replace("~$key~",$value,$url);
                $str = trim($str,"/");
                $params = explode("/", $str);
                $controllerName = ucfirst(array_shift($params))."Controller";
                $actionName = "action".ucfirst(array_shift($params));
                if(file_exists(ROOT."/controllers/$controllerName".".php")){
                    include_once (ROOT."/controllers/$controllerName".".php");
                    $controllerObj = new $controllerName;
                    $result = call_user_func_array(array($controllerObj,$actionName),$params);
                    if($result != null) break;
                }
            }
            else {
                //echo "404";
                //break;
            }
        }
    }
}