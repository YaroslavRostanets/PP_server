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
        if( intval($id) ){
            $place = ParkPlace::getPlaceById($id,$coords['lat'], $coords['lon']);
        } else {
            $place = ParkPlace::getPlaceByFriendlyUrl($id,$coords['lat'], $coords['lon']);
        }

        $seo = Seo::getMetaByPageName('Detail');
        $seo['title_' . $language] = str_replace( '@address' , $place['address_' . $language], $seo['title_' . $language] );
        $seo['description_' . $language] = str_replace( '@address' , $place['address_' . $language], $seo['description_' . $language] );
        $seo['keywords_' . $language] = str_replace( '@address' , $place['address_' . $language], $seo['keywords_' . $language] );

        require_once ROOT."/views/site/detail.php";

        return true;
    }
}