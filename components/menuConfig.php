<?php
/**
 * Created by PhpStorm.
 * User: Yaroslav
 * Date: 29.12.2017
 * Time: 15:11
 */
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
        "link" => "/",
        "route" => "/admin/offeredparking",
        "title" => "Новые",
        "class=" => "user-item",
        "icon" => "fa fa-plus-square-o"
    ],
);

?>

