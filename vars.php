<?php

define("ROOT",dirname(__FILE__));
//define("SITE_ROOT","/php/cms/");
define("SITE_ROOT","");
define("TEMPLATE",SITE_ROOT."/template/");
define("UPLOADS",SITE_ROOT."/uploads/");
function pri($obj){
    echo '<pre>';
    print_r($obj);
    echo '</pre>';
};