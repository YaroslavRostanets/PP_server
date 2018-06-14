<?php
/**
 * Created by PhpStorm.
 * User: Yaroslav
 * Date: 12.06.2018
 * Time: 14:24
 */

class OfferPlaces {
    const PLACES_ON_PAGE = 20;

    public static function getOfferPlaceById($id){
        $db = Db::getConnection();
        $sql = "SELECT *, X(coordinates), Y(coordinates) FROM offer_parking WHERE id=:id";
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();

        $arrResult = array();
        while($row = $result->fetch()){
            $arrResult[] = $row;
        }

        return $arrResult[0];

    }

    public static function removeOfferPlace($id){
        $db = Db::getConnection();
        $sql = "DELETE FROM offer_parking WHERE id=:id;";
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        return $result->execute();
    }

    public static function getCountPlaces() {
        $db = Db::getConnection();
        $sql = "SELECT COUNT(*) from offer_parking;";
        $result = $db->prepare($sql);
        $result->setFetchMode(PDO::FETCH_NUM);
        $result->execute();
        $arrResult = $result->fetch();

        return $arrResult[0];
    }

    public static function getAllParks($page) {
        $offset = self::PLACES_ON_PAGE * (--$page);

        $db = Db::getConnection();
        $sql = "SELECT *, X(coordinates), Y(coordinates) FROM offer_parking LIMIT " . self::PLACES_ON_PAGE . " OFFSET $offset ";
        $result = $db->prepare($sql);
        $result->bindParam(':page', $page, PDO::PARAM_INT);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        $arrResult = array();
        while($row = $result->fetch()){
            $arrResult[] = $row;
        }
        return $arrResult;
    }
}