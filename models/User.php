<?php
/**
 * Created by PhpStorm.
 * User: Yaroslav
 * Date: 23.07.2018
 * Time: 0:14
 */
require_once SITE_ROOT . 'components/Db.php';

class User {

    public static function  isUserRegistered($id, $social){

        $db = Db::getConnection();
        if($social == 'GOOGLE'){
            $sql = "SELECT * FROM user WHERE googleId=:id;";
        } elseif($social == 'FB'){
            $sql = "SELECT * FROM user WHERE fbId=:id;";
        }
        $result = $db->prepare($sql);

        $result->bindParam(':id', $id, PDO::PARAM_STR);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        $user = $result->fetch();

        return $user;
    }

    public static function auth($id){
        session_start();
        $_SESSION['userId'] = $id;
    }

    public static function getUserByGoogleId($googleId){
        $db = Db::getConnection();

        $sql = "SELECT * FROM user WHERE googleId=:id;";

        $result = $db->prepare($sql);

        $result->bindParam(':id', $googleId, PDO::PARAM_STR);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        $user = $result->fetch();

        return $user;
    }

    public static function  addGoogleUser($googleId,$familyName,$givenName,$email,$link,$picture){
        $db = Db::getConnection();

        $sql = "INSERT INTO user (googleId,familyName,givenName,email,link,picture)
                VALUES (
                    :googleId,
                    :familyName,
                    :givenName, 
                    :email, 
                    :link, 
                    :picture)
                    ;";

        $result = $db->prepare($sql);

        $result->bindParam(':googleId', $googleId, PDO::PARAM_INT);
        $result->bindParam(':familyName', $familyName, PDO::PARAM_STR);
        $result->bindParam(':givenName', $givenName, PDO::PARAM_STR);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->bindParam(':link', $link, PDO::PARAM_STR);
        $result->bindParam(':picture', $picture, PDO::PARAM_STR);

        $status = $result->execute();

        return $status;

    }

    public static function isLogged(){
        session_start();
        if( isset($_SESSION['adminId']) ){
            return $_SESSION['adminId'];
        }
        return false;
    }

    public static function getAdminById($id){
        $db = Db::getConnection();
        $sql = "SELECT * FROM admin WHERE id=:id;";
        $result = $db->prepare($sql);

        $result->bindParam(':id', $id, PDO::PARAM_STR);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        $admin = $result->fetch();

        return $admin;
    }
}

?>