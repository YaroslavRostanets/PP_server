<?php
/**
 * Created by PhpStorm.
 * User: Yaroslav
 * Date: 16.06.2017
 * Time: 0:56
 */
class SiteController {
    public function actionIndex(){
        require_once ROOT."/views/site/index.php";
        return true;
    }
    public function actionAuth(){
        require_once ROOT."/views/site/auth.php";
        return true;
    }
}