<?php
/**
 * Created by PhpStorm.
 * User: Yaroslav
 * Date: 16.06.2017
 * Time: 0:56
 */
require_once ROOT."/components/public_router.php";
class SiteController {
    public function setLangTest($lang, $langArr){
        $result = FALSE;
        foreach ( $langArr as $value ) {
            $pos = array_search( strtoupper($lang), $value);
            if ( $pos ) {
                $result = $pos;
                break;
            }
        }
        return $result;
    }
    public function actionLangdefinition(){
        $public_routes = require_once ROOT."/config/public_routes.php";
        if( isset($_SERVER['REDIRECT_URL']) ){
            $uri_arr = explode("/", trim($_SERVER['REDIRECT_URL'],'/') );
        }
        if( !empty($uri_arr) ){
            $langArr = require ROOT."/config/languages.php";
            $lang = $uri_arr[0];
            if( self::setLangTest($lang, $langArr) ){ // Если в УРЛ задан язык
                $lang = array_shift($uri_arr);
                session_start();
                $_SESSION['lang'] = $lang;
            } else {
                session_start();
                $lang = $_SESSION['lang'];
                if(isset($_SESSION['lang']) && $_SESSION['lang'] != 'fi'){
                    header( "Location: /". $_SESSION['lang'] . $_SERVER['REDIRECT_URL']  );
                }
            }
            $public_router = new Public_Router($public_routes);
            $public_router->run( implode('/', $uri_arr), $lang );
        } else {
            session_start();
            if(isset($_SESSION['lang']) && $_SESSION['lang'] != 'fi'){
                header( "Location: /". $_SESSION['lang'] . $_SERVER['REDIRECT_URL']  );
            }
            $public_router = new Public_Router($public_routes);
            $public_router->run( implode('/', []), 'fi' );
        }
        return true;
    }
    public function actionAuth(){
        require_once ROOT."/views/site/auth.php";
        return true;
    }
}