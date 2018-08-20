<?php
/**
 * Created by PhpStorm.
 * User: Yaroslav
 * Date: 28.07.2018
 * Time: 16:08
 */
class Favorites {
    public static function isThisPlaceExist($userId, $placeId){
        $db = Db::getConnection();
        $sql = "SELECT * FROM favorites WHERE user_id = :userId AND place_id = :placeId;";

        $result = $db->prepare($sql);

        $result->bindParam(':userId', $userId, PDO::PARAM_INT);
        $result->bindParam(':placeId', $placeId, PDO::PARAM_INT);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();

        return $result->fetch();
    }

    public static function addPlaceToFavorite($userId, $placeId){
        $placeExist = self::isThisPlaceExist($userId, $placeId);

        if( $placeExist == FALSE ){
            $db = Db::getConnection();
            $sql = "INSERT INTO favorites (
                    user_id,
                    place_id ) 
                VALUES (
                    :userId,
                    :placeId
                    );";

            $result = $db->prepare($sql);

            $result->bindParam(':userId', $userId, PDO::PARAM_STR);
            $result->bindParam(':placeId', $placeId, PDO::PARAM_STR);

            $status = $result->execute();

            if($status){
                return array(
                    'errors' => 0,
                    'type' => 'OK',
                    'text' => 'парковка добавленна в избранное'
                );
            } else {
                return array(
                    'errors' => 1,
                    'type' => 'ERROR',
                    'text' => 'Ошибка при добавлении парковки в избранное'
                );
            }

        } else {
            return array(
                'errors' => 1,
                'type' => 'WARNING',
                'text' => 'Парковка уже в избранном'
            );
        }

    }

    public static function getFavoritesByUserId($userId,$lat = 60.172852,$lng = 4.9381472){
        $db = Db::getConnection();
        $sql = "SELECT * FROM favorites WHERE user_id = :userId;";
        $result = $db->prepare($sql);
        $result->bindParam(':userId', $userId, PDO::PARAM_INT);

        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();

        $arrResult = [];
        while($row = $result->fetch()) {
            $elem = json_decode(Api::getPlaceById($row['place_id'], $lat, $lng), true);
            $elem['place_id'] = $row['place_id'];
            $elem['id'] = $row['id'];
            $arrResult[] = $elem;
        }

        return $arrResult;
    }

    public static function removeFromFavorites($id, $userId){
        $db = Db::getConnection();
        $sql = "DELETE FROM favorites WHERE id=:id;";
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $status = $result->execute();

        if($status){
            $favoriteArr = self::getFavoritesByUserId($userId);
            return $favoriteArr;
        }

        return TRUE;

    }


}