<?php
/**
 * Created by PhpStorm.
 * User: Yaroslav
 * Date: 14.01.2018
 * Time: 15:51
 */
class ParkPlace {
    const PLACES_ON_PAGE = 4;

    public static function getParkPlaceById($id) {
        $db = Db::getConnection();
        $result = $db->query("SELECT *, X(coordinates), Y(coordinates) FROM parking_place WHERE id=$id");
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result = $result->fetch();

        return $result;
    }

    public static function getCountPlaces() {
        $db = Db::getConnection();
        $sql = "SELECT COUNT(*) from parking_place;";
        $result = $db->prepare($sql);
        $result->setFetchMode(PDO::FETCH_NUM);
        $result->execute();
        $arrResult = $result->fetch();

        return $arrResult[0];
    }

    public static function getAllParks($page) {
        $offset = self::PLACES_ON_PAGE * (--$page);

        $db = Db::getConnection();
        $sql = "SELECT *, X(coordinates), Y(coordinates) FROM parking_place LIMIT " . self::PLACES_ON_PAGE . " OFFSET $offset";
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

    public static function updateParkPlace(
        $id, $filename, $kind_of_place, $weekday_from,$weekday_to,$saturday_from,$saturday_to,$sunday_from,$sunday_to,$time_interval, $park_zone, $lat, $lon
    ) {

        if( file_exists(SRC_TMP_PLACES . $filename) ){
            copy(SRC_TMP_PLACES . $filename, PLACES . $filename);
            clearDirectory(SRC_TMP_PLACES);
        }

        $http_places = HTTP_PLACES.$filename;

        $db = Db::getConnection();
        $sql = "UPDATE parking_place SET 
                photo_url=:photo_url,
                kind_of_place=:kind_of_place,
                weekday_from=:weekday_from, 
                weekday_to=:weekday_to, 
                saturday_from=:saturday_from, 
                saturday_to=:saturday_to,
                sunday_from=:sunday_from,
                sunday_to=:sunday_to, 
                time_interval=:time_interval,
                park_zone=:park_zone,
                coordinates=Point(:lat, :lon)
                 WHERE id=:id";

        $result = $db->prepare($sql);

        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':photo_url', $http_places, PDO::PARAM_STR);
        $result->bindParam(':kind_of_place', $kind_of_place, PDO::PARAM_STR);
        $result->bindParam(':weekday_from', $weekday_from, PDO::PARAM_STR);
        $result->bindParam(':weekday_to', $weekday_to, PDO::PARAM_STR);
        $result->bindParam(':saturday_from', $saturday_from, PDO::PARAM_STR);
        $result->bindParam(':saturday_to', $saturday_to, PDO::PARAM_STR);
        $result->bindParam(':sunday_from', $sunday_from, PDO::PARAM_STR);
        $result->bindParam(':sunday_to', $sunday_to, PDO::PARAM_STR);
        $result->bindParam(':time_interval', $time_interval, PDO::PARAM_INT);
        $result->bindParam(':park_zone', $park_zone, PDO::PARAM_INT);
        $result->bindParam(':lat', $lat, PDO::PARAM_STR);
        $result->bindParam(':lon', $lon, PDO::PARAM_STR);

        $result->execute();

        return TRUE;
    }

    public static function addNewParkPlace(
        $kind_of_place,$photo_url,$weekday_from,$weekday_to,$saturday_from,$saturday_to,$sunday_from,$sunday_to,$time_interval,$park_zone,
        $lat, $lon
    ){

        copy(SRC_TMP_PLACES . $photo_url, PLACES . $photo_url);
        clearDirectory(SRC_TMP_PLACES);

        $db = Db::getConnection();
        $sql = "INSERT INTO parking_place (
                    kind_of_place, photo_url, weekday_from, weekday_to, saturday_from, saturday_to, sunday_from, sunday_to,
                    time_interval, park_zone, coordinates)
                VALUES (
                    :kind_of_place,
                    :photo_url,
                    :weekday_from, 
                    :weekday_to, 
                    :saturday_from, 
                    :saturday_to,
                    :sunday_from,
                    :sunday_to, 
                    :time_interval,
                    :park_zone,
                    Point(:lat, :lon) );";

        $result = $db->prepare($sql);

        $http_places = HTTP_PLACES.$photo_url;

        $result->bindParam(':kind_of_place', $kind_of_place, PDO::PARAM_STR);
        $result->bindParam(':photo_url', $http_places, PDO::PARAM_STR);
        $result->bindParam(':weekday_from', $weekday_from, PDO::PARAM_STR);
        $result->bindParam(':weekday_to', $weekday_to, PDO::PARAM_STR);
        $result->bindParam(':saturday_from', $saturday_from, PDO::PARAM_STR);
        $result->bindParam(':saturday_to', $saturday_to, PDO::PARAM_STR);
        $result->bindParam(':sunday_from', $sunday_from, PDO::PARAM_STR);
        $result->bindParam(':sunday_to', $sunday_to, PDO::PARAM_STR);
        $result->bindParam(':time_interval', $time_interval, PDO::PARAM_INT);
        $result->bindParam(':park_zone', $park_zone, PDO::PARAM_INT);
        $result->bindParam(':lat', $lat, PDO::PARAM_STR);
        $result->bindParam(':lon', $lon, PDO::PARAM_STR);

        $result->execute();

        return TRUE;

    }

    public static function removeParkPlace($id){
        $db = Db::getConnection();
        $sql = "DELETE FROM parking_place WHERE id=:id;";
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        return $result->execute();
    }

}