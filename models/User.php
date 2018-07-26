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
        if( isset($_SESSION['userId']) ){
            return $_SESSION['userId'];
        }
        return false;
    }

    public static function logout(){
        session_start();
        unset($_SESSION['userId']);
        $redirectUrl = $_SERVER['REDIRECT_URL'];

        header("Location: /");

        return TRUE;
    }

    public static function getUserById($id){
        $db = Db::getConnection();
        $sql = "SELECT * FROM user WHERE id=:id;";
        $result = $db->prepare($sql);

        $result->bindParam(':id', $id, PDO::PARAM_STR);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        $user = $result->fetch();

        return $user;
    }

    public static function uploadAvatar(){
        if( isset($_FILES) && isset($_FILES['avatar']) ){
            if( $_FILES['avatar']['size'] > 1000000 ) {
                return json_encode(
                    array('error'=>'max size is 1mb')
                );
            }
            if ( 0 < $_FILES['avatar']['error'] ) {
                return json_encode(
                    array('errorm'=>$_FILES['avatar']['error'])
                );
            }
            else {
                $timestamp = time();
                $format = explode(".",$_FILES['avatar']['name']);
                $format = array_pop( $format );
                move_uploaded_file($_FILES['avatar']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . 'uploads/tmp_avatars/' . $timestamp . "." . $format);
                $arrResult = array(
                    "fileName" => $timestamp,
                    "format" => $format
                );
                return json_encode($arrResult);
            }
        }
    }

    public static function updateProfile($id, $name, $surname, $filename){
        $db = Db::getConnection();

        if($filename != ''){
            $user = self::getUserById($id);
            $oldAvatarNameArr = explode('/', $user['picture']);
            $oldAvatarName = array_pop($oldAvatarNameArr);
            echo $oldAvatarName;

            copy(TMP_AVATARS . $_POST['filename'], AVATARS . $_POST['filename']);
            unlink(TMP_AVATARS . $_POST['filename']);
            $avaPath = HTTP_AVATARS . $filename;

            if(file_exists(AVATARS . $oldAvatarName)){
                unlink(AVATARS . $oldAvatarName );     //Удаляем старую аватарку
            }

            $sql = "UPDATE user SET 
                picture=:filename
                WHERE id=:id";

            $result = $db->prepare($sql);

            $result->bindParam(':id', $id, PDO::PARAM_INT);
            $result->bindParam(':filename', $avaPath, PDO::PARAM_STR);

            echo $result->execute();
        }

        $sql = "UPDATE user SET 
                givenName=:name,
                familyName=:surname
                WHERE id=:id";

        echo $sql;
        $result = $db->prepare($sql);

        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':surname', $surname, PDO::PARAM_STR);

        $result->execute();
    }

    public static function checkName($value){
        $length = mb_strlen($value,'UTF-8');
        if($length <= 2){
            return json_encode(array(
                'errors' => '1',
                'textError' => 'Поле должно быть больше 2 символов'
            ));
        } elseif ($length > 32){
            return json_encode(array(
                'errors' => '1',
                'textError' => 'Поле должно быть меньше 32 символов'
            ));
        } else {
            return json_encode(array(
                'errors' => '0',
            ));
        }
    }

}

?>