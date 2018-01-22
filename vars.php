<?php

define("ROOT",dirname(__FILE__));
//define("SITE_ROOT","/php/cms/");
define("SITE_ROOT","");
define("TEMPLATE",SITE_ROOT."/template/");
define("UPLOADS",SITE_ROOT."/uploads/");
define("SRC_PLACES",$_SERVER['DOCUMENT_ROOT']."/uploads/tmp_places/");
define("PLACES",$_SERVER['DOCUMENT_ROOT']."/uploads/places/");
define("HTTP_PLACES",'http://'.$_SERVER['HTTP_HOST'].'/uploads/places/');
define("TMP_PLACES",'http://'.$_SERVER['HTTP_HOST'].'/uploads/tmp_places/');
function pri($obj){
    echo '<pre>';
    print_r($obj);
    echo '</pre>';
};