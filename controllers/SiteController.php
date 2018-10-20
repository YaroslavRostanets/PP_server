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
        pri('lala');
        pri($result);
        return $result;
    }

    public function actionLangdefinition(){
        $public_routes = require_once ROOT."/config/public_routes.php";

        $public_router = new Public_Router($public_routes);
        $public_router->run( $public_router, $lang );

        return true;
    }

    public function actionAuth(){
        require_once ROOT."/views/site/auth.php";
        return true;
    }


}