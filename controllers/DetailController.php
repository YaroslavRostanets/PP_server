<?php
/**
 * Created by PhpStorm.
 * User: Yaroslav
 * Date: 16.06.2017
 * Time: 0:56
 */



class DetailController {
    private $lang;
    function __construct($lang='fi') {
        $this->lang = $lang;
        $this->pageName = 'detail-page';
    }

    public function actionIndex($id) {
        $userId = User::isLogged();

        if($userId){
            $user = User::getUserById($userId);
        }

        $language = $this->lang;
        $coords = Api::getCoordsByIp();
        $place = ParkPlace::getPlaceById($id,$coords['lat'], $coords['lon']);

        require_once ROOT."/views/site/detail.php";

        //echo "DETAIL";
        return true;
    }
}