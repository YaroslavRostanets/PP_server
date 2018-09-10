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
        $this->pageName = 'home-page';
    }

    public function actionIndex(){
        $userId = User::isLogged();

        if($userId){
            $user = User::getUserById($userId);
        }

        $language = $this->lang;
        $coords = Api::getCoordsByIp();
        $places = Api::getPlacesListNearPoint($coords['lat'], $coords['lon']);
        $seo = Seo::getMetaByPageName('Home');

        $isHomePage = TRUE;

        $allPlacesForSEO = ParkPlace::getAllPlaces();

        require_once ROOT."/views/site/index.php";
        return true;
    }

}