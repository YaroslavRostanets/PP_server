<?php
/**
 * Created by PhpStorm.
 * User: Yaroslav
 * Date: 22.07.2018
 * Time: 18:11
 */
class UserController {

    public function actionSigningoogle() {

        require SITE_ROOT . "libs/google-api-php-client-2.2.2_PHP54/vendor/autoload.php";

        $gClient = new Google_Client();

        $gClient->setClientId('215480803826-6g7j3t6hkjfi4uahfkhkdd5oml9n93ee.apps.googleusercontent.com');
        $gClient->setClientSecret('q0zf1hOn-wfZ-LQkkvmM58Aj');
        $gClient->setApplicationName('Park Panda');
        $gClient->setRedirectUri('http://1117158.kiray92.web.hosting-test.net/signin/google');

        $gClient->addScope('profile email');

        $loginUrl = $gClient->createAuthUrl();

        if($_GET['code']){
            $token = $gClient->fetchAccessTokenWithAuthCode($_GET['code']);
            $oAuth = new Google_Service_Oauth2($gClient);
            $userData = $oAuth->userinfo_v2_me->get();
            pri($userData);
            require_once SITE_ROOT . 'models/User.php';
            $user = User::isUserRegistered($userData['id'], 'GOOGLE');

            if( $user == FALSE ){ //Если такого пользователя нет, то регистрируем нового
                $status = User::addGoogleUser($userData['id'],$userData['familyName'],
                    $userData['givenName'],$userData['email'],$userData['link'],$userData['picture']);
            }

            $siteUser = User::getUserByGoogleId($userData['id']);
            User::auth($siteUser['id']);

            $redirectJS = <<<SCRIPT
<script>
if (sessionStorage.getItem("redirectUri")) {
  var redirectUri = sessionStorage.getItem("redirectUri");sessionStorage.removeItem("redirectUri"); window.location.href = redirectUri;
}
</script>
SCRIPT;

            echo $redirectJS;

        } else {
            header( "Location: $loginUrl" );
        }

        return true;
    }

    public function actionIndex() {


        return true;
    }
}

?>