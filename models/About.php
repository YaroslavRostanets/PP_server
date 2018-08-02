<?php
/**
 * Created by PhpStorm.
 * User: Yaroslav
 * Date: 31.07.2018
 * Time: 3:20
 */

class About {

    public static function getContentByLang($lang){
        $db = Db::getConnection();

        $sql = "SELECT * FROM about WHERE lang=:lang";
        $result = $db->prepare($sql);
        $result->bindParam(':lang', $lang, PDO::PARAM_STR);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();

        return $result->fetch();
    }

    public static function getContent(){
        $db = Db::getConnection();

        $sql = "SELECT * FROM about";
        $result = $db->prepare($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();

        $arrResult = [];

        while($row = $result->fetch()) {
            $arrResult[] = $row;
        }

        return $arrResult;
    }

    public static function updateAbout($title,$text,$lang){
        $db = Db::getConnection();

        $sql = "UPDATE about
                SET title = :title, text = :text
                WHERE lang = :lang;";

        $result = $db->prepare($sql);
        $result->bindParam(':title', $title, PDO::PARAM_STR);
        $result->bindParam(':text', $text, PDO::PARAM_STR);
        $result->bindParam(':lang', $lang, PDO::PARAM_STR);

        $result->execute();
        $result->fetch();

        return true;
    }

    public static function getAbout(){

        return true;
    }
}

?>