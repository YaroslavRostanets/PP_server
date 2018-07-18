<?php
/**
 * Created by PhpStorm.
 * User: Yaroslav
 * Date: 16.07.2018
 * Time: 20:30
 */
class Page404Controller {

    public function actionIndex() {
        pri('404');

        return true;
    }
}