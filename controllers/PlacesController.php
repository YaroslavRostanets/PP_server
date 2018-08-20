<?php
/**
 * Created by PhpStorm.
 * User: Yaroslav
 * Date: 04.08.2018
 * Time: 17:51
 */

class PlacesController {

    private $lang;
    function __construct($lang='fi') {
        $this->lang = $lang;
        $this->pageName = 'addplace-page';
    }

    public function actionAdd() {

        $userId = User::isLogged();

        if($userId){
            $user = User::getUserById($userId);
        } else {
            header( "Location: ". SITE_URL . '/' . $this->lang );

        }

        $language = $this->lang;

        if(isset($_GET['upload-photo'])){
            if ( !empty($_FILES) && 0 < $_FILES['place_photo']['error'] ) {
                $error = array(
                    'error' => $_FILES['file']['error']
                );
                echo json_encode($error);
            } else {
                if($_FILES['place_photo']['size'] > 1000000){
                    echo json_encode(
                        array(
                            'errors'=>1,
                            'errorText'=>'Размер фото не должен превышать 1 mb'
                        )
                    );
                } else {
                    $timestamp = time();
                    $fileArr = explode(".",$_FILES['place_photo']['name']);
                    $fileName = $fileArr[0] . $timestamp;
                    $format = $fileArr[1];
                    move_uploaded_file($_FILES['place_photo']['tmp_name'], TMP_OFFER_PARKING . $fileName . "." . $format);

                    echo json_encode(
                        array(
                            'errors'=>0,
                            'filename'=> $fileName . '.' . $format
                        )
                    );
                }
            }

            return TRUE;
        }

        if(isset($_GET['save-place'])){
            $lat = $_POST['latitude'];
            $lon = $_POST['longitude'];

            if( isset($_POST['filename']) && $_POST['filename'] != '' ){

                copy(TMP_OFFER_PARKING . $_POST['filename'], OFFER_PLACES . $_POST['filename']);
                unlink(TMP_OFFER_PARKING . $_POST['filename']);
                $plase_photo_url = HTTP_OFFER_PLACES . $_POST['filename'];

                $result = OfferPlaces::saveOfferPlace($lat, $lon, $plase_photo_url, $userId);

                echo json_encode(
                    array(
                        'errors' => 0,
                        'fn' => $_POST['filename']
                    )
                );
            } else {
                echo json_encode(
                    array(
                        'errors' => 1,
                        'errorText' => 'Нужно загрузить изображение'
                    )
                );
            }



            return TRUE;
        }



        include_once SITE_ROOT . "views/site/addplace.php";

        return TRUE;
    }
}