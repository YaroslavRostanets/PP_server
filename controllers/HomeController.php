<?php
/**
 * Created by PhpStorm.
 * User: Yaroslav
 * Date: 16.06.2017
 * Time: 0:56
 */
require_once ROOT."/components/public_router.php";

class HomeController {

    private $lang;
    function __construct($lang='fi') {
        $this->lang = $lang;
    }

    public function actionIndex(){

        $language = $this->lang;
        $coords = Api::getCoordsByIp();
        $places = Api::getPlacesListNearPoint($coords['lat'], $coords['lon']);

        $isHomePage = TRUE;

        require_once ROOT."/views/site/index.php";
        return true;
    }

}