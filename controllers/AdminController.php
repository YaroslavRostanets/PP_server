<?php

class AdminController {
    public function actionIndex(){
        //include_once ROOT."/views/admin/list.php";
        return true;
    }

    public function actionDetail($parkId = NULL){
        session_start();
        $parkPlace = ParkPlace::getParkPlaceById($parkId);
        $referer = $_SERVER['HTTP_REFERER'];

        $photo_path_array = explode("/",$parkPlace['photo_url']);
        $filename = array_pop($photo_path_array);

        if( isset($_POST['submit']) ){
            ParkPlace::updateParkPlace(
                $_POST['id'],
                $_POST['filename'],
                $_POST['kind_of_place'],
                $_POST['weekday_from'],
                $_POST['weekday_to'],
                $_POST['saturday_from'],
                $_POST['saturday_to'],
                $_POST['sunday_from'],
                $_POST['sunday_to'],
                $_POST['time_interval'],
                $_POST['park_zone'],
                $_POST['X(coordinates)'],
                $_POST['Y(coordinates)'],
                (isset($_POST['hasnt_table'])) ? $_POST['hasnt_table'] : 0
            );

            if( isset($_SESSION['referer']) ){
                header("Location: ".$_SESSION['referer']);
            }
        } else {
            $_SESSION['referer'] = $_SERVER["HTTP_REFERER"];
        }

        include_once ROOT."/views/admin/detail.php";
        return true;
    }

    public function actionList(){
        $adminId = Admin::isLogged();
        if( $adminId !== FALSE ){
            $admin = Admin::getAdminById($adminId);
            $adminName = $admin['name'];
        } else {
            header("Location: "."/admin/signin/");
        }
        $pages = ceil(ParkPlace::getCountPlaces() / ParkPlace::PLACES_ON_PAGE);
        $page = (isset($_GET['page']))? $_GET['page'] : 1;

        $parkPlaces = ParkPlace::getAllParks($page);
        include_once ROOT."/views/admin/list.php";
        return true;
    }

    public function actionAddplace(){
        $adminId = Admin::isLogged();
        if( $adminId !== FALSE ){
            $admin = Admin::getAdminById($adminId);
            $adminName = $admin['name'];
        } else {
            header("Location: "."/admin/signin/");
        }

        if( isset($_POST['submit']) ){
            pri($_POST);

            $result = ParkPlace::addNewParkPlace(
                $_POST['kind_of_place'],
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
                $_POST['Y(coordinates)'],
                (isset($_POST['hasnt_table'])) ? $_POST['hasnt_table'] : 0
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

    public function ActionReplaceimg() {

        if ( 0 < $_FILES['file']['error'] ) {
            echo 'Error: ' . $_FILES['file']['error'] . '<br>';
        } else {
            if( file_exists($_SERVER['DOCUMENT_ROOT'] . 'uploads/places/' . $_GET['filename']) ){
                unlink( $_SERVER['DOCUMENT_ROOT'] . 'uploads/places/' . $_GET['filename']);
            }

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
        $adminId = Admin::isLogged();
        if( $adminId !== FALSE ){
            header("Location: "."/admin/list/");
        }

        $login = "";
        $password = "";
        $error_msg = "";

        if( isset($_POST['submit']) ){

            $login = $_POST['login'];
            $password = $_POST['password'];
            $adminRow = Admin::checkAdminData($login,$password);

            if((bool)$adminRow == FALSE){
                $error_msg = "<i class=\"fa fa-exclamation-triangle\" aria-hidden=\"true\"></i> Неправильные данные";
            } else {
                Admin::auth($adminRow['id']);
                header("Location: /admin/list/");
            }
        }

        include_once ROOT."/views/admin/signin.php";

        return true;
    }

    public function ActionLogout(){
        session_start();
        unset($_SESSION['adminId']);
        header("Location: /admin/signin/");

        return TRUE;
    }
}