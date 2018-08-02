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

    "favorites/add" => "favorites/addfavoriteplace",
    "favorites" => "favorites/index",

    "about" => "about/index",
    "ajax" => "ajax/index",

    "detail/([0-9]+)" => "detail/index/$1",
    "" => "home/index"
);