<?php

class Public_Router {
    private $routes;
    function __construct($routes){
        $this->routes = $routes;
    }

    public function run($gen_url, $lang) {
        $url = $gen_url;

        foreach ($this->routes as $key => $value){
            if(preg_match( "~$key~", $url)){

                $str = preg_replace("~$key~",$value,$url);
                $str = trim($str,"/");
                $params = explode("/", $str);
                $controllerName = ucfirst(array_shift($params))."Controller";
                $actionName = "action".ucfirst(array_shift($params));
                if(file_exists(ROOT."/controllers/$controllerName".".php")){
                    include_once (ROOT."/controllers/$controllerName".".php");
                    $controllerObj = new $controllerName($lang);
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