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
        $id,$weekday_from,$weekday_to,$saturday_from,$saturday_to,$sunday_from,$sunday_to,$time_interval, $park_zone, $lat, $lon
    ) {
        $db = Db::getConnection();
        $sql = "UPDATE parking_place SET 
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
        $result->bindParam(':sign_weekday_from', $weekday_from, PDO::PARAM_STR);
        $result->bindParam(':sign_weekday_to', $weekday_to, PDO::PARAM_STR);
        $result->bindParam(':sign_saturday_from', $sign_saturday_from, PDO::PARAM_STR);
        $result->bindParam(':sign_saturday_to', $sign_saturday_to, PDO::PARAM_STR);
        $result->bindParam(':sign_sunday_from', $sign_sunday_from, PDO::PARAM_STR);
        $result->bindParam(':sign_sunday_to', $sign_sunday_to, PDO::PARAM_STR);

        return TRUE;
    }

    public static function addNewParkPlace(
        $kind_of_place,$photo_url,$weekday_from,$weekday_to,$saturday_from,$saturday_to,$sunday_from,$sunday_to,$time_interval,$park_zone,
        $lat, $lon
    ){
        copy(SRC_TMP_PLACES . $photo_url, PLACES . $photo_url);
        unlink(SRC_TMP_PLACES . $photo_url);

        pri($kind_of_place);

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