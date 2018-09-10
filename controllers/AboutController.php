<?php
/**
 * Created by PhpStorm.
 * User: Yaroslav
 * Date: 30.07.2018
 * Time: 17:20
 */

class AboutController {

    private $lang;
    function __construct($lang='fi') {
        $this->lang = $lang;
        $this->pageName = 'about-page';
    }

    public function actionIndex(){
        $userId = User::isLogged();

        if($userId){
            $user = User::getUserById($userId);
        }

        if(isset($_SESSION['lang']) && $_SESSION['lang'] != 'fi'){
            header( "Location: /". $_SESSION['lang'] . $_SERVER['REDIRECT_URL']  );
        }

        $language = $this->lang;
        $seo = Seo::getMetaByPageName('About');

        $aboutContent = About::getContentByLang($language);

        include_once SITE_ROOT . "views/site/about.php";
        return true;
    }
}