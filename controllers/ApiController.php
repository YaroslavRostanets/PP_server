<?php
/**
 * Created by PhpStorm.
 * User: Yaroslav
 * Date: 09.02.2018
 * Time: 23:38
 */
class ApiController {
    public function actionFastlist(){
        if( isset($_GET) ){
            $FastParkingArray = Api::getPlacesByPoint($_GET['lat'],$_GET['lon'],$_GET['day_index']);
            pri($FastParkingArray);
        }


        return true;
    }

}