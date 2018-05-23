<?php
/**
 * Created by PhpStorm.
 * User: Yaroslav
 * Date: 09.02.2018
 * Time: 23:41
 */
class Api {
    public static function getPlacesListNearPoint($lat, $lon){

        function seconds_from_time($time) {
            list($h, $m, $s) = explode(':', $time);
            return ($h * 3600) + ($m * 60) + $s;
        }
        $day_index = date('w');
        $time_now_hour = seconds_from_time( date('H:m:s') );

        switch ($day_index) {
            case 0: //ВС
                $dayFromTo = "( TIME_TO_SEC(sunday_from) < $time_now_hour AND TIME_TO_SEC(sunday_to) > $time_now_hour AND kind_of_place = 'FREE' )
                 OR ( sunday_from = '' AND kind_of_place = 'PAY' )
                 OR ( TIME_TO_SEC(sunday_from) > $time_now_hour AND kind_of_place = 'PAY' ) 
                 OR ( TIME_TO_SEC(sunday_to) < $time_now_hour AND kind_of_place = 'PAY')
                 OR ( TIME_TO_SEC(sunday_from) > $time_now_hour AND kind_of_place = 'FORBIDDEN' )
                 OR ( TIME_TO_SEC(sunday_to) < $time_now_hour AND kind_of_place = 'FORBIDDEN')
                 OR ( TIME_TO_SEC(sunday_from) > $time_now_hour AND kind_of_place = 'FORBIDDEN_YELLOW' )
                 OR ( TIME_TO_SEC(sunday_to) < $time_now_hour AND kind_of_place = 'FORBIDDEN_YELLOW')
                 OR ( sunday_from = '' AND kind_of_place = 'FORBIDDEN_PAY' )
                 OR ( TIME_TO_SEC(sunday_from) > $time_now_hour AND kind_of_place = 'FORBIDDEN_PAY' ) 
                 OR ( TIME_TO_SEC(sunday_to) < $time_now_hour AND kind_of_place = 'FORBIDDEN_PAY')
                 ";
                break;
            case 6: //СБ
                $dayFromTo = "( TIME_TO_SEC(saturday_from) < $time_now_hour AND TIME_TO_SEC(saturday_to) > $time_now_hour AND kind_of_place = 'FREE' )
                 OR ( saturday_from = '' AND kind_of_place = 'PAY' )
                 OR ( TIME_TO_SEC(saturday_from) > $time_now_hour AND kind_of_place = 'PAY' ) 
                 OR ( TIME_TO_SEC(saturday_to) < $time_now_hour AND kind_of_place = 'PAY')
                 OR ( TIME_TO_SEC(saturday_from) > $time_now_hour AND kind_of_place = 'FORBIDDEN' )
                 OR ( TIME_TO_SEC(saturday_to) < $time_now_hour AND kind_of_place = 'FORBIDDEN')
                 OR ( TIME_TO_SEC(saturday_from) > $time_now_hour AND kind_of_place = 'FORBIDDEN_YELLOW' )
                 OR ( TIME_TO_SEC(saturday_to) < $time_now_hour AND kind_of_place = 'FORBIDDEN_YELLOW')
                 OR ( saturday_from = '' AND kind_of_place = 'FORBIDDEN_PAY' )
                 OR ( TIME_TO_SEC(saturday_from) > $time_now_hour AND kind_of_place = 'FORBIDDEN_PAY' ) 
                 OR ( TIME_TO_SEC(saturday_to) < $time_now_hour AND kind_of_place = 'FORBIDDEN_PAY')
                 ";
                break;
            default:
                $dayFromTo = "( TIME_TO_SEC(weekday_from) < $time_now_hour AND TIME_TO_SEC(weekday_to) > $time_now_hour AND kind_of_place = 'FREE' )
                 OR ( weekday_from = '' AND kind_of_place = 'PAY' )
                 OR ( TIME_TO_SEC(weekday_from) > $time_now_hour AND kind_of_place = 'PAY' ) 
                 OR ( TIME_TO_SEC(weekday_to) < $time_now_hour AND kind_of_place = 'PAY')
                 OR ( TIME_TO_SEC(weekday_from) > $time_now_hour AND kind_of_place = 'FORBIDDEN' )
                 OR ( TIME_TO_SEC(weekday_to) < $time_now_hour AND kind_of_place = 'FORBIDDEN')
                 OR ( TIME_TO_SEC(weekday_from) > $time_now_hour AND kind_of_place = 'FORBIDDEN_YELLOW' )
                 OR ( TIME_TO_SEC(weekday_to) < $time_now_hour AND kind_of_place = 'FORBIDDEN_YELLOW')
                 OR ( weekday_from = '' AND kind_of_place = 'FORBIDDEN_PAY' )
                 OR ( TIME_TO_SEC(weekday_from) > $time_now_hour AND kind_of_place = 'FORBIDDEN_PAY' ) 
                 OR ( TIME_TO_SEC(weekday_to) < $time_now_hour AND kind_of_place = 'FORBIDDEN_PAY')
                 ";
                break;
        }

        $db = Db::getConnection();

        $sql = "SELECT 
              id,
              kind_of_place,
              geodist_pt( Point($lat, $lon), coordinates ),
              time_interval, 
              weekday_from, 
              weekday_to,
              saturday_from,
              saturday_to,
              sunday_from,
              sunday_to,
              X(coordinates), 
              Y(coordinates)
              FROM parking_place WHERE $dayFromTo
              ORDER BY geodist_pt( Point($lat, $lon), coordinates )";

        //http://1117158.kiray92.web.hosting-test.net/api/fastlist?lat=60.14902464279283&lon=24.913558959960938
        //SELECT *, geodist_pt( Point($lat, $lon), 	coordinates ) FROM parking_place
        //AND kind_of_place='FREE'

        $result = $db->prepare($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        $arrResult = array();
        while($row = $result->fetch()){
            foreach ($row as $key => $value){
                if( strripos($key,"geodist_pt") !== FALSE ){
                    $row['geodist_pt'] = $row[$key];
                    unset($row[$key]);
                    break;
                }
            }
            $row['lat'] = $row['X(coordinates)'];
            $row['lon'] = $row['Y(coordinates)'];
            unset($row['X(coordinates)']);
            unset($row['Y(coordinates)']);
            $arrResult[] = $row;
        }
        $jsonResult = json_encode($arrResult, JSON_UNESCAPED_UNICODE);
        echo $jsonResult;
        return $arrResult;
    }

    public static function getPlaceById($id,$lat = 60.1700, $lon = 30.9359) {
        $db = Db::getConnection();

        $sql = "SELECT 
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

        return json_encode($arrResult, JSON_UNESCAPED_UNICODE);
    }

    public static function getPlacesByFilter ($lat, $lon){

        $db = Db::getConnection();

        $sql = "SELECT 
              id,
              kind_of_place,
              geodist_pt( Point($lat, $lon), coordinates ),
              time_interval, 
              weekday_from, 
              weekday_to,
              saturday_from,
              saturday_to,
              sunday_from,
              sunday_to,
              X(coordinates), 
              Y(coordinates)
              FROM parking_place";

        $result = $db->prepare($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        $arrResult = array();

        while($row = $result->fetch()){
            foreach ($row as $key => $value){
                if( strripos($key,"geodist_pt") !== FALSE ){
                    $row['geodist_pt'] = $row[$key];
                    unset($row[$key]);
                    break;
                }
            }
            $row['lat'] = $row['X(coordinates)'];
            $row['lon'] = $row['Y(coordinates)'];
            unset($row['X(coordinates)']);
            unset($row['Y(coordinates)']);
            array_push($arrResult,$row);
        }

        return json_encode($arrResult, JSON_UNESCAPED_UNICODE);
    }
}