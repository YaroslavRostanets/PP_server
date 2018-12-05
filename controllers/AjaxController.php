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
        $language = $this->lang;

        if(isset($_GET['fast'])){
            $lat = $_GET['lat'];
            $lng = $_GET['lng'];
            $places = Api::getPlacesListNearPoint($lat, $lng);


            $template = requireToVar(
                ['language' => $language,
                   'places' => $places],
                SITE_ROOT . 'views/ajax/fast-parking-list.php');

            $arrResult = array(
                'places' => $places,
                'html' => $template
            );


            echo json_encode($arrResult);

        }

        if(isset($_GET['search'])){
            $MONFRY = $_GET['MONFRY'];
            $SAT = $_GET['SAT'];
            $SUN = $_GET['SUN'];
            $filterFrom = $_GET['filterFrom'];
            $filterTimeFrom = $_GET['filterTimeFrom'];
            $places = Api::getPlacesByFilter(
                $_GET['lat'],
                $_GET['lng'],
                $MONFRY,
                $SAT,
                $SUN,
                str_replace('-',':',$filterFrom),
                $filterTimeFrom
            );

            if( count(json_decode($places)) ){
                $template = requireToVar(
                    ['language' => $language,
                    'places' => json_decode($places, TRUE)],
                    SITE_ROOT . 'views/ajax/fast-parking-list.php');
            } else {
                $template = requireToVar(null, SITE_ROOT . 'views/ajax/search-no-result.php');
            }

            echo json_encode(
                array(
                    'places'=>$places,
                    'template'=>$template
                )
            );
        }

        if( isset($_GET['isauth']) ) {
            if(!isset($_SESSION))
            {
                session_start();
            }
            if( isset($_SESSION['userId']) ) {
                echo json_encode(
                    array(
                        'isauth'=>'1'
                    )
                );
            } else {
                echo json_encode(
                    array(
                        'isauth'=>''
                    )
                );
            }
        }

        return TRUE;
    }
}