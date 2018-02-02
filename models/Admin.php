<?php
/**
 * Created by PhpStorm.
 * User: Yaroslav
 * Date: 23.01.2018
 * Time: 22:34
 */
class Admin {

    public static function  checkAdminData($login,$password){
        $db = Db::getConnection();
        $sql = "SELECT * FROM admin WHERE login=:login AND password=:password;";
        $result = $db->prepare($sql);

        $result->bindParam(':login', $login, PDO::PARAM_STR);
        $result->bindParam(':password', $password, PDO::PARAM_STR);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        $admin = $result->fetch();

        return $admin;

    }

    public static function auth($id){
        session_start();
        $_SESSION['adminId'] = $id;
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