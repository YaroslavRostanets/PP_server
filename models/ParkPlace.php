<?php
/**
 * Created by PhpStorm.
 * User: Yaroslav
 * Date: 14.01.2018
 * Time: 15:51
 */
class ParkPlace {
    const PLACES_ON_PAGE = 20;

    public static function getParkPlaceById($id) {
        $db = Db::getConnection();
        $result = $db->query("SELECT *, X(coordinates), Y(coordinates) FROM parking_place WHERE id=$id");
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result = $result->fetch();

        return $result;
    }

    public static function getPlaceById($id,$lat = 60.1700, $lon = 30.9359) {
        $db = Db::getConnection();

        $sql = "SELECT 
              id,
              kind_of_place,
              geodist_pt( Point($lat, $lon), coordinates ),
              photo_url,
              time_interval, 
              weekday_from, 
              weekday_to,
              saturday_from,
              saturday_to,
              sunday_from,
              sunday_to,
              park_zone,
              address_en,
              address_fi,
              address_ru,
              address_uk,
              X(coordinates), 
              Y(coordinates)
              FROM parking_place WHERE id=$id";

        $result = $db->prepare($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        $arrResult = $result->fetch();
        foreach ($arrResult as $key => $value){
            if( strripos($key,"geodist_pt") !== FALSE ){
                $arrResult['geodist_pt'] = $arrResult[$key];
                unset($arrResult[$key]);
                break;
            }
        }

        return $arrResult;
    }

    public static function getPlaceByFriendlyUrl($url ,$lat = 60.1700, $lon = 30.9359){
        $db = Db::getConnection();
        $url = trim($url);
        $sql = "SELECT 
                  id,
                  kind_of_place,
                  geodist_pt( Point($lat, $lon), coordinates ),
                  photo_url,
                  time_interval, 
                  weekday_from, 
                  weekday_to,
                  saturday_from,
                  saturday_to,
                  sunday_from,
                  sunday_to,
                  park_zone,
                  address_en,
                  address_fi,
                  address_ru,
                  address_uk,
                  X(coordinates), 
                  Y(coordinates)
              FROM parking_place WHERE friendly_url='$url';";

        $result = $db->prepare($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        $arrResult = $result->fetch();
        foreach ($arrResult as $key => $value){
            if( strripos($key,"geodist_pt") !== FALSE ){
                $arrResult['geodist_pt'] = $arrResult[$key];
                unset($arrResult[$key]);
                break;
            }
        }

        return $arrResult;
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
        $id, $filename, $kind_of_place, $weekday_from,$weekday_to,$saturday_from,
        $saturday_to,$sunday_from,$sunday_to,$time_interval, $park_zone, $lat, $lon,$hasnt_table
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
                coordinates=Point(:lat, :lon),
                hasnt_table=:hasnt_table
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
        $result->bindParam(':hasnt_table', $hasnt_table, PDO::PARAM_STR);
        $result->execute();

        return TRUE;
    }

    public static function addNewParkPlace(
        $kind_of_place,$photo_url,$weekday_from,$weekday_to,$saturday_from,$saturday_to,$sunday_from,$sunday_to,$time_interval,$park_zone,
        $fliendly_url, $address_en, $address_fi, $address_ru, $address_uk, $lat, $lon, $hasnt_table
    ){

        $db = Db::getConnection();
        $sql = "INSERT INTO parking_place (
                    kind_of_place, photo_url, weekday_from, weekday_to, saturday_from, saturday_to, sunday_from, sunday_to,
                    time_interval, park_zone, friendly_url, address_en, address_fi, address_ru, address_uk, coordinates, hasnt_table)
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
                    :friendly_url,
                    :address_en,
                    :address_fi,
                    :address_ru,
                    :address_uk,
                    Point(:lat, :lon),
                    :hasnt_table
                    )
                    ;";

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
        $result->bindParam(':friendly_url', $fliendly_url, PDO::PARAM_STR);
        $result->bindParam(':address_en', $address_en, PDO::PARAM_STR);
        $result->bindParam(':address_fi', $address_fi, PDO::PARAM_STR);
        $result->bindParam(':address_ru', $address_ru, PDO::PARAM_STR);
        $result->bindParam(':address_uk', $address_uk, PDO::PARAM_STR);
        $result->bindParam(':lat', $lat, PDO::PARAM_STR);
        $result->bindParam(':lon', $lon, PDO::PARAM_STR);
        $result->bindParam(':hasnt_table', $hasnt_table, PDO::PARAM_INT);

        $result->execute();

        return TRUE;

    }

    public static function getCurrentIdPlace(){
        $db = Db::getConnection();
        $sql = "SELECT MAX(id) FROM parking_place;";
        $result = $db->prepare($sql);
        $result->execute();

        return $result->fetch();

    }

    public static function removeParkPlace($id){
        $db = Db::getConnection();
        $sql = "DELETE FROM parking_place WHERE id=:id;";
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        return $result->execute();
    }

}