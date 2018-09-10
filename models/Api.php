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
                $dayFromTo = "(hasnt_table = 1 AND kind_of_place = 'FREE')
                 OR ( TIME_TO_SEC(sunday_from) < $time_now_hour AND TIME_TO_SEC(sunday_to) > $time_now_hour AND kind_of_place = 'FREE' )
                 OR ( sunday_from = '' AND kind_of_place = 'PAY' )
                 OR ( TIME_TO_SEC(sunday_from) > $time_now_hour AND kind_of_place = 'PAY' ) 
                 OR ( TIME_TO_SEC(sunday_to) < $time_now_hour AND kind_of_place = 'PAY')
                 OR ( sunday_from = '' AND kind_of_place = 'FORBIDDEN' )
                 OR ( TIME_TO_SEC(sunday_from) > $time_now_hour AND kind_of_place = 'FORBIDDEN' )
                 OR ( TIME_TO_SEC(sunday_to) < $time_now_hour AND kind_of_place = 'FORBIDDEN')
                 OR ( sunday_from = '' AND kind_of_place = 'FORBIDDEN_YELLOW' )
                 OR ( TIME_TO_SEC(sunday_from) > $time_now_hour AND kind_of_place = 'FORBIDDEN_YELLOW' )
                 OR ( TIME_TO_SEC(sunday_to) < $time_now_hour AND kind_of_place = 'FORBIDDEN_YELLOW')
                 OR ( sunday_from = '' AND kind_of_place = 'FORBIDDEN_PAY' )
                 OR ( TIME_TO_SEC(sunday_from) > $time_now_hour AND kind_of_place = 'FORBIDDEN_PAY' ) 
                 OR ( TIME_TO_SEC(sunday_to) < $time_now_hour AND kind_of_place = 'FORBIDDEN_PAY')
                 OR ( sunday_from = '' AND kind_of_place = 'FORBIDDEN_YELLOW_PAY' )
                 OR ( TIME_TO_SEC(sunday_from) > $time_now_hour AND kind_of_place = 'FORBIDDEN_YELLOW_PAY' ) 
                 OR ( TIME_TO_SEC(sunday_to) < $time_now_hour AND kind_of_place = 'FORBIDDEN_YELLOW_PAY')
                 ";
                break;
            case 6: //СБ
                $dayFromTo = "(hasnt_table = 1 AND kind_of_place = 'FREE')
                 OR ( TIME_TO_SEC(saturday_from) < $time_now_hour AND TIME_TO_SEC(saturday_to) > $time_now_hour AND kind_of_place = 'FREE' )
                 OR ( saturday_from = '' AND kind_of_place = 'PAY' )
                 OR ( TIME_TO_SEC(saturday_from) > $time_now_hour AND kind_of_place = 'PAY' ) 
                 OR ( TIME_TO_SEC(saturday_to) < $time_now_hour AND kind_of_place = 'PAY')
                 OR ( saturday_from = '' AND kind_of_place = 'FORBIDDEN' )
                 OR ( TIME_TO_SEC(saturday_from) > $time_now_hour AND kind_of_place = 'FORBIDDEN' )
                 OR ( TIME_TO_SEC(saturday_to) < $time_now_hour AND kind_of_place = 'FORBIDDEN')
                 OR ( saturday_from = '' AND kind_of_place = 'FORBIDDEN_YELLOW' )
                 OR ( TIME_TO_SEC(saturday_from) > $time_now_hour AND kind_of_place = 'FORBIDDEN_YELLOW' )
                 OR ( TIME_TO_SEC(saturday_to) < $time_now_hour AND kind_of_place = 'FORBIDDEN_YELLOW')
                 OR ( saturday_from = '' AND kind_of_place = 'FORBIDDEN_PAY' )
                 OR ( TIME_TO_SEC(saturday_from) > $time_now_hour AND kind_of_place = 'FORBIDDEN_PAY' ) 
                 OR ( TIME_TO_SEC(saturday_to) < $time_now_hour AND kind_of_place = 'FORBIDDEN_PAY')
                 OR ( saturday_from = '' AND kind_of_place = 'FORBIDDEN_YELLOW_PAY' )
                 OR ( TIME_TO_SEC(saturday_from) > $time_now_hour AND kind_of_place = 'FORBIDDEN_YELLOW_PAY' ) 
                 OR ( TIME_TO_SEC(saturday_to) < $time_now_hour AND kind_of_place = 'FORBIDDEN_YELLOW_PAY')
                 ";
                break;
            default:
                $dayFromTo = "(hasnt_table = 1 AND kind_of_place = 'FREE')
                 OR ( TIME_TO_SEC(weekday_from) < $time_now_hour AND TIME_TO_SEC(weekday_to) > $time_now_hour AND kind_of_place = 'FREE' )
                 OR ( weekday_from = '' AND kind_of_place = 'PAY' )
                 OR ( TIME_TO_SEC(weekday_from) > $time_now_hour AND kind_of_place = 'PAY' ) 
                 OR ( TIME_TO_SEC(weekday_to) < $time_now_hour AND kind_of_place = 'PAY')
                 OR ( weekday_from = '' AND kind_of_place = 'FORBIDDEN' )
                 OR ( TIME_TO_SEC(weekday_from) > $time_now_hour AND kind_of_place = 'FORBIDDEN' )
                 OR ( TIME_TO_SEC(weekday_to) < $time_now_hour AND kind_of_place = 'FORBIDDEN')
                 OR ( weekday_from = '' AND kind_of_place = 'FORBIDDEN_YELLOW' )
                 OR ( TIME_TO_SEC(weekday_from) > $time_now_hour AND kind_of_place = 'FORBIDDEN_YELLOW' )
                 OR ( TIME_TO_SEC(weekday_to) < $time_now_hour AND kind_of_place = 'FORBIDDEN_YELLOW')
                 OR ( weekday_from = '' AND kind_of_place = 'FORBIDDEN_PAY' )
                 OR ( TIME_TO_SEC(weekday_from) > $time_now_hour AND kind_of_place = 'FORBIDDEN_PAY' ) 
                 OR ( TIME_TO_SEC(weekday_to) < $time_now_hour AND kind_of_place = 'FORBIDDEN_PAY')
                 OR ( weekday_from = '' AND kind_of_place = 'FORBIDDEN_YELLOW_PAY' )
                 OR ( TIME_TO_SEC(weekday_from) > $time_now_hour AND kind_of_place = 'FORBIDDEN_YELLOW_PAY' ) 
                 OR ( TIME_TO_SEC(weekday_to) < $time_now_hour AND kind_of_place = 'FORBIDDEN_YELLOW_PAY')
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
              friendly_url,
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
        //echo $jsonResult;
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
              friendly_url,
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

    public static function getPlacesByFilter ($lat, $lon, $MONFRY, $SAT, $SUN, $FilterFrom, $FilterTo, $FilterTimeFrom, $distance = 999){
        //pri($FilterTimeFrom);
        $hour24sec = 86400;

        function time_to_sec($time){
            $timeArr = explode(':',$time);
            $hours = $timeArr[0];
            $min = $timeArr[1];
            return ($hours*60 + $min) * 60;
        }

        $FilterFromSec = time_to_sec($FilterFrom);
        $FilterToSec = time_to_sec($FilterTo);

        function sql_template($lat, $lon, $type){
            $sql_template = "(SELECT 
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
              friendly_url,
              X(coordinates), 
              Y(coordinates)
              FROM parking_place WHERE $type )";

            return $sql_template;
        }

        $free = "(hasnt_table = 1 AND $FilterTimeFrom <= time_to_sec(time_interval) AND kind_of_place = 'FREE')";
        $pay = "(FALSE)";
        $forbidden = "(FALSE)";
        $forbidden_yellow = "(FALSE)";
        $forbidden_pay = "(FALSE)";
        $forbidden_yellow_pay = "(FALSE)";

        if ($MONFRY == 'true') {
            $free .= " 
            OR ( time_to_sec(weekday_from) <= $FilterFromSec AND $FilterToSec <= (time_to_sec(weekday_to) + time_interval * 60 ) 
                AND $FilterTimeFrom <= time_to_sec(time_interval) AND kind_of_place = 'FREE' )
            ";

            $pay .= " OR ( 0 <= $FilterFromSec AND $FilterToSec <= time_to_sec(weekday_from) AND $FilterTimeFrom <= time_interval * 60 AND kind_of_place = 'PAY' )
            OR ( time_to_sec(weekday_to) <= $FilterFromSec AND $FilterTimeFrom <= time_interval * 60 AND kind_of_place = 'PAY' )
            ";

            $forbidden .= " OR ( 0 <= $FilterFromSec AND $FilterToSec <= time_to_sec(weekday_from) AND $FilterTimeFrom <= time_interval * 60 AND kind_of_place = 'FORBIDDEN' )
            OR ( time_to_sec(weekday_to) <= $FilterFromSec AND $FilterTimeFrom <= time_interval * 60 AND kind_of_place = 'FORBIDDEN' )
            ";

            $forbidden_yellow .= " OR ( 0 <= $FilterFromSec AND $FilterToSec <= time_to_sec(weekday_from) AND $FilterTimeFrom <= time_interval * 60 AND kind_of_place = 'FORBIDDEN_YELLOW' )
            OR ( time_to_sec(weekday_to) <= $FilterFromSec AND $FilterTimeFrom <= time_interval * 60 AND kind_of_place = 'FORBIDDEN_YELLOW' )
            ";

            $forbidden_pay .= " OR ( 0 <= $FilterFromSec AND $FilterToSec <= time_to_sec(weekday_from) AND $FilterTimeFrom <= time_interval * 60 AND kind_of_place = 'FORBIDDEN_PAY' )
            OR ( time_to_sec(weekday_to) <= $FilterFromSec AND $FilterTimeFrom <= time_interval * 60 AND kind_of_place = 'FORBIDDEN_PAY' )
            ";

            $forbidden_yellow_pay .= " OR ( 0 <= $FilterFromSec AND $FilterToSec <= time_to_sec(weekday_from) AND $FilterTimeFrom <= time_interval * 60 AND kind_of_place = 'FORBIDDEN_YELLOW_PAY' )
            OR ( time_to_sec(weekday_to) <= $FilterFromSec AND $FilterTimeFrom <= time_interval * 60 AND kind_of_place = 'FORBIDDEN_YELLOW_PAY' )
            ";

        }
        if ($SAT == 'true') {
            $free .= "
            OR ( time_to_sec(saturday_from) <= $FilterFromSec AND $FilterToSec <= (time_to_sec(saturday_to) + time_interval * 60 ) 
            AND $FilterTimeFrom <= time_interval * 60 AND kind_of_place = 'FREE' )
             ";

            $pay .= " OR ( 0 <= $FilterFromSec AND $FilterToSec <= time_to_sec(saturday_from) AND $FilterTimeFrom <= time_interval * 60 AND kind_of_place = 'PAY' )
            OR ( time_to_sec(saturday_to) <= $FilterFromSec AND $FilterTimeFrom <= time_interval * 60 AND kind_of_place = 'PAY' )
            ";

            $forbidden .= " OR ( 0 <= $FilterFromSec AND $FilterToSec <= time_to_sec(saturday_from) AND $FilterTimeFrom <= time_interval * 60 AND kind_of_place = 'FORBIDDEN' )
            OR ( time_to_sec(saturday_to) <= $FilterFromSec AND $FilterTimeFrom <= time_interval * 60 AND kind_of_place = 'FORBIDDEN' )
            ";

            $forbidden_yellow .= " OR ( 0 <= $FilterFromSec AND $FilterToSec <= time_to_sec(saturday_from) AND $FilterTimeFrom <= time_interval * 60 AND kind_of_place = 'FORBIDDEN_YELLOW' )
            OR ( time_to_sec(saturday_to) <= $FilterFromSec AND $FilterTimeFrom <= time_interval * 60 AND kind_of_place = 'FORBIDDEN_YELLOW' )
            ";

            $forbidden_pay .= " OR ( 0 <= $FilterFromSec AND $FilterToSec <= time_to_sec(saturday_from) AND $FilterTimeFrom <= time_interval * 60 AND kind_of_place = 'FORBIDDEN_PAY' )
            OR ( time_to_sec(saturday_to) <= $FilterFromSec AND $FilterTimeFrom <= time_interval * 60 AND kind_of_place = 'FORBIDDEN_PAY' )
            ";

            $forbidden_yellow_pay .= " OR ( 0 <= $FilterFromSec AND $FilterToSec <= time_to_sec(saturday_from) AND $FilterTimeFrom <= time_interval * 60 AND kind_of_place = 'FORBIDDEN_YELLOW_PAY' )
            OR ( time_to_sec(saturday_to) <= $FilterFromSec AND $FilterTimeFrom <= time_interval * 60 AND kind_of_place = 'FORBIDDEN_YELLOW_PAY' )
            ";

        }
        if ($SUN == 'true') {
            $free .= "
            OR ( time_to_sec(sunday_from) <= $FilterFromSec AND $FilterToSec <= (time_to_sec(sunday_to) + time_interval * 60 ) 
            AND $FilterTimeFrom <= time_interval * 60 AND kind_of_place = 'FREE' )
            ";

            $pay .= " OR ( 0 <= $FilterFromSec AND $FilterToSec <= time_to_sec(sunday_from) AND $FilterTimeFrom <= time_interval * 60 AND kind_of_place = 'PAY' )
            OR ( time_to_sec(sunday_to) <= $FilterFromSec AND $FilterTimeFrom <= time_interval * 60 AND kind_of_place = 'PAY' )
            ";

            $forbidden .= " OR ( 0 <= $FilterFromSec AND $FilterToSec <= time_to_sec(sunday_from) AND $FilterTimeFrom <= time_interval * 60 AND kind_of_place = 'FORBIDDEN' )
            OR ( time_to_sec(sunday_to) <= $FilterFromSec AND $FilterTimeFrom <= time_interval * 60 AND kind_of_place = 'FORBIDDEN' )
            ";

            $forbidden_yellow .= " OR ( 0 <= $FilterFromSec AND $FilterToSec <= time_to_sec(sunday_from) AND $FilterTimeFrom <= time_interval * 60 AND kind_of_place = 'FORBIDDEN_YELLOW' )
            OR ( time_to_sec(sunday_to) <= $FilterFromSec AND $FilterTimeFrom <= time_interval * 60 AND kind_of_place = 'FORBIDDEN_YELLOW' )
            ";

            $forbidden_pay .= " OR ( 0 <= $FilterFromSec AND $FilterToSec <= time_to_sec(sunday_from) AND $FilterTimeFrom <= time_interval * 60 AND kind_of_place = 'FORBIDDEN_PAY' )
            OR ( time_to_sec(sunday_to) <= $FilterFromSec AND $FilterTimeFrom <= time_interval * 60 AND kind_of_place = 'FORBIDDEN_PAY' )
            ";

            $forbidden_yellow_pay .= " OR ( 0 <= $FilterFromSec AND $FilterToSec <= time_to_sec(sunday_from) AND $FilterTimeFrom <= time_interval * 60 AND kind_of_place = 'FORBIDDEN_YELLOW_PAY' )
            OR ( time_to_sec(sunday_to) <= $FilterFromSec AND $FilterTimeFrom <= time_interval * 60 AND kind_of_place = 'FORBIDDEN_YELLOW_PAY' )
            ";
        }


        $db = Db::getConnection();

        $sql = sql_template($lat, $lon,$free) .
            ' UNION ' . sql_template($lat, $lon,$pay) .
            ' UNION ' . sql_template($lat, $lon, $forbidden) .
            ' UNION ' . sql_template($lat, $lon, $forbidden_yellow) .
            ' UNION ' . sql_template($lat, $lon, $forbidden_pay).
            ' UNION ' . sql_template($lat, $lon, $forbidden_yellow_pay);
        //echo $sql;

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

    public static function addOfferParking($lat, $lon, $photo_url, $from_user_id) {
        $db = Db::getConnection();

        $sql = "INSERT INTO offer_parking (from_user_id, photo_url, coordinates) VALUES (
        :from_user_id,
        :photo_url,
        Point(:lat, :lon)
        )";

        $result = $db->prepare($sql);

        $result->bindParam(':from_user_id', $from_user_id, PDO::PARAM_STR);
        $result->bindParam(':photo_url', $photo_url, PDO::PARAM_STR);
        $result->bindParam(':lat', $lat, PDO::PARAM_STR);
        $result->bindParam(':lon', $lon, PDO::PARAM_STR);
        $requestStatus = $result->execute();

        return $requestStatus;
    }


    public static function getCoordsByIp() {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }

        $geoplugin = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip='.$ip));

        $coords = [
            'lat' => $geoplugin['geoplugin_latitude'],
            'lon' => $geoplugin['geoplugin_longitude']
        ];

        return $coords;
    }

}