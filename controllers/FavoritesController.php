<?php
/**
 * Created by PhpStorm.
 * User: Yaroslav
 * Date: 28.07.2018
 * Time: 16:11
 */
class FavoritesController {

    private $lang;
    function __construct($lang='fi') {
        $this->lang = $lang;
    }

    public function actionAddfavoriteplace(){
        session_start();
        $language = $this->lang;

        if(isset($_GET['placeId']) && isset($_SESSION['userId'])){
            $respond = Favorites::addPlaceToFavorite($_SESSION['userId'], $_GET['placeId']);
            if (!$respond['errors']){
                $confirm = TRUE;
            } else {
                $confirm = FALSE;
            }
            $text = $respond['text'];
            $type = $respond['type'];
            include_once SITE_ROOT . "views/modals/confirm.php";
        }

        return true;
    }

    public function actionIndex() {
        session_start();
        $language = $this->lang;
        if(isset($_GET['get-list-modal']) && isset($_SESSION['userId'])){
            $userId = $_SESSION['userId'];
            $list = Favorites::getFavoritesByUserId($userId);
            include_once SITE_ROOT . "views/modals/favorites-list.php";

            return true;
        }

        if(isset($_GET['remove_from_favorites']) && isset($_SESSION['userId'])){
            $removeId = $_GET['remove_from_favorites'];
            $userId = $_SESSION['userId'];

            $remainder = Favorites::removeFromFavorites($removeId, $userId);

            if(count($remainder) == 0){
                require_once SITE_ROOT . "views/modals/no-favorites.php";
                echo json_encode(
                    array(
                        'countFavorites' => 0,
                        'html' => text()
                    )
                );
            } else {
                echo json_encode(
                    array(
                        'countFavorites' => count($remainder),
                        'html' => ''
                    )
                );
            }

            return true;
        }


        if(isset($_GET['count']) && isset($_SESSION['userId'])){
            echo count( Favorites::getFavoritesByUserId($_SESSION['userId']) );
        }

        return true;
    }
}