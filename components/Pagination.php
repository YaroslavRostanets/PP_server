
<?php
/**
 * Created by PhpStorm.
 * User: Yaroslav
 * Date: 25.06.2017
 * Time: 19:13
 */
class Pagination {
    public static function rendPagination($page = NULL, $pages = NULL, $route=''){
        $siteRedirectURI = str_replace(SITE_ROOT,'',$_SERVER['REDIRECT_URL']);
        $pagination = include ROOT."/layouts/pagination.php";
        ob_start();
        require_once(ROOT."/layouts/pagination.php");
        return ob_get_clean();
    }

}