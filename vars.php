<?php

define("ROOT",dirname(__FILE__));
//define("SITE_ROOT","/php/cms/");
define("GM_API_KEY","AIzaSyBueyERw9S41n4lblw5fVPAc9UqpAiMgvM");
define("GEOCODE_URI","https://maps.googleapis.com/maps/api/geocode/json?");
define("SITE_ROOT","");
define("TEMPLATE",SITE_ROOT."/template/");
define("UPLOADS",SITE_ROOT."/uploads/");
define("SRC_TMP_PLACES",$_SERVER['DOCUMENT_ROOT']."/uploads/tmp_places/");
define("PLACES",$_SERVER['DOCUMENT_ROOT']."/uploads/places/");
define("OFFER_PLACES",$_SERVER['DOCUMENT_ROOT'].'uploads/offer_parking/');
define("HTTP_PLACES",'https://'.$_SERVER['HTTP_HOST'].'/uploads/places/');
define("TMP_PLACES",'https://'.$_SERVER['HTTP_HOST'].'/uploads/tmp_places/');
define("HTTP_OFFER_PLACES",'https://'.$_SERVER['HTTP_HOST'].'/uploads/offer_parking/');

define("TMP_AVATARS",$_SERVER['DOCUMENT_ROOT'].'/uploads/tmp_avatars/');
define("AVATARS", $_SERVER['DOCUMENT_ROOT'].'/uploads/avatars/');
define("HTTP_AVATARS",'https://'.$_SERVER['HTTP_HOST'].'/uploads/avatars/');

define("LOCATION_JSON",'https://freegeoip.net/json/');

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

function intervalToSec($param){
    if( strpos($param, 'min') !== FALSE ){
        $param = preg_replace("/[^0-9]/", '', $param);
        return $param * 60;
    } elseif ( strpos($param, 'h') !== FALSE ) {
        $param = preg_replace("/[^0-9]/", '', $param);
        return $param * 60 * 60;
    }
}

function object_to_array($obj) {
    if(is_object($obj)) $obj = (array) $obj;
    if(is_array($obj)) {
        $new = array();
        foreach($obj as $key => $val) {
            $new[$key] = object_to_array($val);
        }
    }
    else $new = $obj;
    return $new;
}

function get_web_page( $url )
{
    $user_agent='Mozilla/5.0 (Windows NT 6.1; rv:8.0) Gecko/20100101 Firefox/8.0';

    $options = array(

        CURLOPT_CUSTOMREQUEST  =>"GET",        //set request type post or get
        CURLOPT_POST           =>false,        //set to GET
        CURLOPT_USERAGENT      => $user_agent, //set user agent
        CURLOPT_COOKIEFILE     =>"cookie.txt", //set cookie file
        CURLOPT_COOKIEJAR      =>"cookie.txt", //set cookie jar
        CURLOPT_RETURNTRANSFER => true,     // return web page
        CURLOPT_HEADER         => false,    // don't return headers
        CURLOPT_FOLLOWLOCATION => true,     // follow redirects
        CURLOPT_ENCODING       => "",       // handle all encodings
        CURLOPT_AUTOREFERER    => true,     // set referer on redirect
        CURLOPT_CONNECTTIMEOUT => 120,      // timeout on connect
        CURLOPT_TIMEOUT        => 120,      // timeout on response
        CURLOPT_MAXREDIRS      => 10,       // stop after 10 redirects
    );

    $ch      = curl_init( $url );
    curl_setopt_array( $ch, $options );
    $content = curl_exec( $ch );
    $err     = curl_errno( $ch );
    $errmsg  = curl_error( $ch );
    $header  = curl_getinfo( $ch );
    curl_close( $ch );

    $header['errno']   = $err;
    $header['errmsg']  = $errmsg;
    $header['content'] = $content;
    return $header;
}

function requireToVar($places, $language, $file){
    ob_start();
    require_once($file);
    return ob_get_clean();
}
