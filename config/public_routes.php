<?php
/**
 * Created by PhpStorm.
 * User: Yaroslav
 * Date: 15.07.2018
 * Time: 17:31
 */

return array(
    "signin/google" => "user/signingoogle",
    "signin/facebook" => "user/signinfacebook",
    "profile/ajax" => "user/ajax",
    "profile" => "user/profile",

    "detail/([0-9]+)" => "detail/index/$1",
    "" => "home/index"
);