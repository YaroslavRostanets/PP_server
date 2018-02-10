<?php
/**
 * Created by PhpStorm.
 * User: Yaroslav
 * Date: 09.02.2018
 * Time: 23:41
 */
class Api {
    public static function getPlacesByPoint($lat, $lon, $dayIndex){

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
        $sql = "SELECT *, geodist_pt( Point($lat, $lon), coordinates ) FROM parking_place WHERE $dayFromTo AND kind_of_place='FREE'";
        echo $sql;
        //http://1117158.kiray92.web.hosting-test.net/api/fastlist?lat=60.14902464279283&lon=24.913558959960938&day_index=2
        //SELECT *, geodist_pt( Point($lat, $lon), 	coordinates ) FROM parking_place

        $result = $db->prepare($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        $arrResult = array();
        while($row = $result->fetch()){
            $arrResult[] = $row;
        }
        return $arrResult;
    }
}