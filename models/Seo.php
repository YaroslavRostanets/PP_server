<?php
/**
 * Created by PhpStorm.
 * User: Yaroslav
 * Date: 08.08.2018
 * Time: 21:24
 */

class Seo {

    public static function getMetaByPageName($templateName){
        $db = Db::getConnection();

        $sql = "SELECT * FROM seo WHERE template_name=:template_name";
        $result = $db->prepare($sql);
        $result->bindParam(':template_name', $templateName, PDO::PARAM_STR);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();

        return $result->fetch();
    }

    public static function getAllTemplates() {
        $db = Db::getConnection();

        $sql = "SELECT * FROM seo;";
        $result = $db->prepare($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();

        $arrResult = [];

        while($row = $result->fetch()) {
            $arrResult[] = $row;
        }

        return $arrResult;
    }

    public static function updateSeoData($values) {
        $index = isset($_POST['robots_index'])? 1 : 0;
        $follow = isset($_POST['robots_follow'])? 1 : 0;

        $db = Db::getConnection();
        $sql = "UPDATE seo
                SET 
                title_ru = :title_ru, 
                description_ru = :description_ru,
                keywords_ru = :keywords_ru,
                title_en = :title_en,
                description_en = :description_en,
                keywords_en = :keywords_en,
                robots_index = :robots_index,
                robots_follow = :robots_follow
                WHERE template_name = :template_name;";

        $result = $db->prepare($sql);
        $result->bindParam(':robots_index', $index, PDO::PARAM_INT);
        $result->bindParam(':robots_follow', $follow, PDO::PARAM_INT);

        $result->bindParam(':title_ru', $_POST['title_ru'], PDO::PARAM_STR);
        $result->bindParam(':description_ru', $_POST['description_ru'], PDO::PARAM_STR);
        $result->bindParam(':keywords_ru', $_POST['keywords_ru'], PDO::PARAM_STR);

        $result->bindParam(':title_en', $_POST['title_en'], PDO::PARAM_STR);
        $result->bindParam(':description_en', $_POST['description_en'], PDO::PARAM_STR);
        $result->bindParam(':keywords_en', $_POST['keywords_en'], PDO::PARAM_STR);

        $result->bindParam(':template_name', $_POST['template_name'], PDO::PARAM_STR);

        $result->execute();

        return $result->fetch();
    }

}