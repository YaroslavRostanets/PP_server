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
    }

    public function actionAdd() {
        $language = $this->lang;

        include_once SITE_ROOT . "views/site/addplace.php";

        return TRUE;
    }
}