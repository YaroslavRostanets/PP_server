<?php
/**
 * Created by PhpStorm.
 * User: Yaroslav
 * Date: 31.07.2018
 * Time: 22:43
 */

class AjaxController {


    public function actionIndex(){
        if(isset($_GET['fast'])){
            $lat = $_GET['lat'];
            $lng = $_GET['lng'];
            $places = Api::getPlacesListNearPoint($lat, $lng);

            $template = requireToVar($places, SITE_ROOT . 'views/ajax/fast-parking-list.php');

            $arrResult = array(
                'places' => $places,
                'html' => $template
            );


            echo json_encode($arrResult);

        }

        if(isset($_GET['filter'])){
            pri($_GET);
            $MONFRY = $_GET['MONFRY'];
            $SAT = $_GET['SAT'];
            $SUN = $_GET['SUN'];
            $filterFrom = $_GET['filterFrom'];
            $filterTo = $_GET['filterTo'];
            $filterTimeFrom = intervalToSec($_GET['filterTimeFrom']);
            $resultArray = Api::getPlacesByFilter(
                $_GET['lat'],
                $_GET['lng'],
                $MONFRY,
                $SAT,
                $SUN,
                str_replace('-',':',$filterFrom),
                str_replace('-',':',$filterTo),
                $filterTimeFrom
            );
            echo $resultArray;
        }

        return TRUE;
    }
}