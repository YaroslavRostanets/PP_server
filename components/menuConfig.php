<?php
/**
 * Created by PhpStorm.
 * User: Yaroslav
 * Date: 29.12.2017
 * Time: 15:11
 */
$count = OfferPlaces::getCountPlaces();

$menu = array(
    "ParkList" => [
        "link" => "/admin/list/",
        "route" => "/admin/list",
        "title" => "Список парковок",
        "class" => "list-item",
        "icon" => "nc-icon nc-notes"
    ],
    "User" => [
        "link" => "/",
        "route" => "/admin/user",
        "title" => "Пользователи",
        "class=" => "user-item",
        "icon" => "nc-icon nc-single-02"
    ],
    "OfferedParking" => [
        "link" => "/admin/offerlist/",
        "route" => "/admin/offerlist",
        "title" => "Новые",
        "class=" => "user-item",
        "icon" => "fa fa-plus-square-o",
        "count" => $count
    ],
    "About" => [
        "link" => "/admin/about/",
        "route" => "/admin/about",
        "title" => "О нас",
        "class=" => "user-item",
        "icon" => "fa-align-justify"
    ],
    "SEO" => [
        "link" => "/admin/seo/",
        "route" => "/admin/seo",
        "title" => "SEO",
        "class=" => "user-item",
        "icon" => "fa-align-justify"
    ],
);

?>

