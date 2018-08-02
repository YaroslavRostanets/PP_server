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
    }

    public function actionIndex(){
        $language = $this->lang;

        $aboutContent = About::getContentByLang($language);

        include_once SITE_ROOT . "views/site/about.php";
        return true;
    }
}