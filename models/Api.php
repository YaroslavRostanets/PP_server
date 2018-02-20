<?php
/**
 * Created by PhpStorm.
 * User: Yaroslav
 * Date: 09.02.2018
 * Time: 23:41
 */
class Api {
    public static function getPlacesListNearPoint($lat, $lon, $dayIndex){

        switch ($dayIndex) {
            case 0: //ВС
                $dayFromTo = "sunday_from !='' AND sunday_to !=''";
                break;
            case 6: //СБ
                $dayFromTo = "saturday_from !='' AND saturday_to !='' ";
                break;
            default:
                $dayFromTo = "weekday_from !='' AND weekday_to !='' ";
                break;
        }

        $db = Db::getConnection();

        $sql = "SELECT 
              id, 
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
              FROM parking_place WHERE $dayFromTo AND 
              kind_of_place='FREE' 
              ORDER BY geodist_pt( Point($lat, $lon), coordinates )";

        //http://1117158.kiray92.web.hosting-test.net/api/fastlist?lat=60.14902464279283&lon=24.913558959960938&day_index=2
        //SELECT *, geodist_pt( Point($lat, $lon), 	coordinates ) FROM parking_place

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
}