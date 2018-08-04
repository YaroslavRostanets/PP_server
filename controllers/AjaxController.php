<?php
/**
 * Created by PhpStorm.
 * User: Yaroslav
 * Date: 31.07.2018
 * Time: 22:43
 */

class AjaxController {

    private $lang;
    function __construct($lang='fi') {
        $this->lang = $lang;
    }


    public function actionIndex(){

        if(isset($_GET['fast'])){
            $language = $this->lang;
            $lat = $_GET['lat'];
            $lng = $_GET['lng'];
            $places = Api::getPlacesListNearPoint($lat, $lng);


            $template = requireToVar($places, $language, SITE_ROOT . 'views/ajax/fast-parking-list.php');

            $arrResult = array(
                'places' => $places,
                'html' => $template
            );


            echo json_encode($arrResult);

        }

        if(isset($_GET['filter'])){
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

            echo json_encode(
                array(
                    'places'=>$resultArray
                )
            );
        }

        if(isset($_GET['search'])){
            $language = $this->lang;
            $MONFRY = $_GET['MONFRY'];
            $SAT = $_GET['SAT'];
            $SUN = $_GET['SUN'];
            $filterFrom = $_GET['filterFrom'];
            $filterTo = $_GET['filterTo'];
            $filterTimeFrom = intervalToSec($_GET['filterTimeFrom']);
            $places = Api::getPlacesByFilter(
                $_GET['lat'],
                $_GET['lng'],
                $MONFRY,
                $SAT,
                $SUN,
                str_replace('-',':',$filterFrom),
                str_replace('-',':',$filterTo),
                $filterTimeFrom
            );

            if( count(json_decode($places)) ){
                $template = requireToVar(json_decode($places, TRUE),$language , SITE_ROOT . 'views/ajax/fast-parking-list.php');
            } else {
                $template = requireToVar(null, null, SITE_ROOT . 'views/ajax/search-no-result.php');
            }

            echo json_encode(
                array(
                    'places'=>$places,
                    'template'=>$template
                )
            );
        }

        return TRUE;
    }
}