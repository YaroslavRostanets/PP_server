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
            $locationJSON = file_get_contents('http://api.ipstack.com/'.$ip.'?access_key=c7b2f24eb3a08f6b82ed5d683ff8c767');
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

    public static function actionOfferparking(){
        //Name, key,

        if ( !empty($_FILES) && 0 < $_FILES['file']['error'] ) {
            $error = array(
                'error' => $_FILES['file']['error']
            );
            echo json_encode($error);
        }

        else {

            $timestamp = time();
            $fileArr = explode(".",$_FILES['file']['name']);
            $fileName = $fileArr[0] . $timestamp;
            $format = $fileArr[1];
            move_uploaded_file($_FILES['file']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . 'uploads/offer_parking/' . $fileName . "." . $format);

            $location = json_decode($_POST['location'], TRUE);
            $photo_url = HTTP_OFFER_PLACES . $fileName . "." . $format;
            $from_user_id = $_POST['from_user_id'];

            Api::addOfferParking($location['lat'], $location['lon'], $photo_url, $from_user_id);
        }


        return true;
    }
}