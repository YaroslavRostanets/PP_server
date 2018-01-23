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
            $result = ParkPlace::addNewParkPlace(
                $_POST['photo_url'],
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

            header("Location: "."/admin/list/");

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
            move_uploaded_file($_FILES['file']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . 'uploads/tmp_places/' . $timestamp . "." . $format);
            $arrResult = array(
                "fileName" => $timestamp,
                "format" => $format
            );
            echo json_encode($arrResult);
        }
        return true;
    }

    public function ActionRemoveplace(){
        $id = $_GET['id'];
        $place = ParkPlace::getParkPlaceById($id);
        $photo_path_array = explode("/",$place['photo_url']);
        $img_name = array_pop($photo_path_array);
        unlink( PLACES . $img_name );
        $result = ParkPlace::removeParkPlace($id);

        if($result){
            header("Location: ".$_SERVER['HTTP_REFERER']);
        }

        return true;
    }

    public function ActionSignin(){
        $login = "";
        $password = "";
        $error_msg = "";

        if( isset($_POST['submit']) ){
            pri($_POST);
            $adminId = Admin::checkAdminData($login,$password);

            if($adminId = false){
                $error_msg = "Неправельные данные";
            }
        }

        include_once ROOT."/views/admin/signin.php";

        return true;
    }
}