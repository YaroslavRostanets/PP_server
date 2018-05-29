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
            $FastParkingArray = Api::getPlacesListNearPoint($_GET['lat'],$_GET['lon']); //передаем координаты и день недели

        }

        return true;
    }

    public function actionLocation(){
        function getLocationByIp($ip){
            $locationJSON = file_get_contents(LOCATION_JSON . $ip);
            return $locationJSON;
        }

        if (isset($_SERVER['HTTP_CLIENT_IP'])){
            $ip = $_SERVER['HTTP_CLIENT_IP'];
            echo getLocationByIp($ip);
        }

        if (isset($_SERVER['REMOTE_ADDR'])){
            $ip = $_SERVER['REMOTE_ADDR'];
            echo getLocationByIp($ip);
            return true;
        }

        return true;
    }

    public function actionGetplace(){
        if( isset($_GET['id']) ){
            $onePlace = Api::getPlaceById($_GET['id'],$_GET['lat'], $_GET['lon']);
            echo $onePlace;
        }
        return true;
    }

    public function actionGetplacebyfilter(){
        //pri($_GET);
        if( isset($_GET) ){
            $MONFRY = $_GET['MONFRY'];
            $SAT = $_GET['SAT'];
            $SUN = $_GET['SUN'];
            $filterFrom = $_GET['filterFrom'];
            $filterTo = $_GET['filterTo'];
            $filterTimeFrom = intervalToSec($_GET['filterTimeFrom']);
            $resultArray = Api::getPlacesByFilter(
                $_GET['lat'],
                $_GET['lon'],
                $MONFRY,
                $SAT,
                $SUN,
                str_replace('-',':',$filterFrom),
                str_replace('-',':',$filterTo),
                $filterTimeFrom
                );
            echo $resultArray;
        }

        return true;
    }

    public function actionGetplacessearch(){
        if( isset($_GET) ){
            $MONFRY = $_GET['MONFRY'];
            $SAT = $_GET['SAT'];
            $SUN = $_GET['SUN'];
            $filterFrom = $_GET['filterFrom'];
            $filterTo = $_GET['filterTo'];
            $filterTimeFrom = intervalToSec($_GET['filterTimeFrom']);
            $distance = ( isset($_GET['distance']) )? $_GET['distance'] : 999;
            $resultArray = Api::getPlacesByFilter(
                $_GET['lat'],
                $_GET['lon'],
                $MONFRY,
                $SAT,
                $SUN,
                str_replace('-',':',$filterFrom),
                str_replace('-',':',$filterTo),
                $filterTimeFrom
            );
            echo $resultArray;
        }

        return true;
    }
}