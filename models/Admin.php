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

        $admin = $result->execute();

        pri($admin);
    }
}

?>