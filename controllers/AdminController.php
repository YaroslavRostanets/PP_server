<?php

class AdminController {
    public function actionIndex(){
        //include_once ROOT."/views/admin/list.php";
        return true;
    }

    public function actionDetail($parkId = NULL){

        $parkPlace = ParkPlace::getParkPlaceById($parkId);

        if( isset($_POST['submit']) ){
            ParkPlace::updateParkPlace(
                $_POST['id'],
                $_POST['weekday_from'],
                $_POST['weekday_to'],
                $_POST['saturday_from'],
                $_POST['saturday_to'],
                $_POST['sunday_from'],
                $_POST['sunday_to'],
                $_POST['time_interval'],
                $_POST['park_zone'],
                $_POST['X(coordinates)'],
                $_POST['Y(coordinates)']
            );
        }
        pri($_POST);

        include_once ROOT."/views/admin/detail.php";
        return true;
    }

    public function actionList(){
        $parkPlaces = ParkPlace::getAllParks();
        include_once ROOT."/views/admin/list.php";
        return true;
    }

    public function actionAddplace(){
        if( isset($_POST['submit']) ){
            pri($_POST);
            ParkPlace::addNewParkPlace(
                $_POST['weekday_from'],
                $_POST['weekday_to'],
                $_POST['saturday_from'],
                $_POST['saturday_to'],
                $_POST['sunday_from'],
                $_POST['sunday_to'],
                $_POST['time_interval'],
                $_POST['park_zone'],
                $_POST['X(coordinates)'],
                $_POST['Y(coordinates)']
            );
        }

        include_once ROOT."/views/admin/add_place.php";
        return true;
    }

    public function ActionUploadplaceimg() {
        if ( 0 < $_FILES['file']['error'] ) {
            echo 'Error: ' . $_FILES['file']['error'] . '<br>';
        }
        else {
            $timestamp = time();
            $format = explode(".",$_FILES['file']['name']);
            $format = array_pop( $format );
            move_uploaded_file($_FILES['file']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . 'uploads/places/' . $timestamp . "." . $format);
            $arrResult = array(
                "fileName" => $timestamp,
                "format" => $format
            );
            echo json_encode($arrResult);
        }
        return true;
    }
}