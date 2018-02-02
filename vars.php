<?php

define("ROOT",dirname(__FILE__));
//define("SITE_ROOT","/php/cms/");
define("SITE_ROOT","");
define("TEMPLATE",SITE_ROOT."/template/");
define("UPLOADS",SITE_ROOT."/uploads/");
define("SRC_TMP_PLACES",$_SERVER['DOCUMENT_ROOT']."/uploads/tmp_places/");
define("PLACES",$_SERVER['DOCUMENT_ROOT']."/uploads/places/");
define("HTTP_PLACES",'http://'.$_SERVER['HTTP_HOST'].'/uploads/places/');
define("TMP_PLACES",'http://'.$_SERVER['HTTP_HOST'].'/uploads/tmp_places/');
function pri($obj){
    echo '<pre>';
    print_r($obj);
    echo '</pre>';
};

function minToHours($min){
    if($min >= 60) {
        return floor( ($min / 60) ) . "h";
    } elseif ($min == 0){
        return "-";
    } else {
        return floor( $min ) . "m";
    }
}

function clearDirectory($path){
    $filesArray = array_diff( scandir( $path ), array('..', '.'));

    foreach ($filesArray as $filename) {
        unlink($path . $filename);
    }
}