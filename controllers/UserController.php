<?php
/**
 * Created by PhpStorm.
 * User: Yaroslav
 * Date: 22.07.2018
 * Time: 18:11
 */
class UserController {

    private $lang;
    function __construct($lang='fi') {
        $this->lang = $lang;
    }

    public function actionSigningoogle() {

        require SITE_ROOT . "libs/google-api-php-client-2.2.2_PHP54/vendor/autoload.php";

        $gClient = new Google_Client();

        $gClient->setClientId('215480803826-6g7j3t6hkjfi4uahfkhkdd5oml9n93ee.apps.googleusercontent.com');
        $gClient->setClientSecret('q0zf1hOn-wfZ-LQkkvmM58Aj');
        $gClient->setApplicationName('Park Panda');
        $gClient->setRedirectUri('http://park-panda.com/signin/google');

        $gClient->addScope('profile email');

        $loginUrl = $gClient->createAuthUrl();

        if($_GET['code']){
            $token = $gClient->fetchAccessTokenWithAuthCode($_GET['code']);
            $oAuth = new Google_Service_Oauth2($gClient);
            $userData = $oAuth->userinfo_v2_me->get();

            foreach ($userData as $key => $value) {
                if (is_null($value)) {
                    $userData[$key] = "";
                }
            }

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

    public function actionProfile() {
        if(isset($_GET['upload-ava'])){
            $file = User::uploadAvatar();
            echo $file;

            return true;
        }

        if(isset($_GET['profile-update'])){
            session_start();

            if(isset($_POST) && $_SESSION['userId']){
                $result = User::updateProfile(
                    $_SESSION['userId'],
                    $_POST['name'],
                    $_POST['surname'],
                    $_POST['filename']
                );
            }

            return true;
        }

        $language = $this->lang;

        if(isset($_GET['logout'])){
            User::logout();
            return true;
        }

        $userId = User::isLogged();

        if($userId){
            $user = User::getUserById($userId);
        }

        require_once SITE_ROOT . "views/site/profile.php";

        return true;
    }

    public function actionSigninfacebook() {

        $id = '1590095447769249';
        $secret = '916d68a9feb7b52dd8b975192becf4ba';
        $redirect_url = 'https://park-panda.com/signin/facebook/';
        $grant_type='client_credentials';

        $api_url = "https://www.facebook.com/v2.9/dialog/oauth?client_id={$id}&redirect_uri={$redirect_url}&grant_type=$grant_type&scope=email,public_profile";

        if(isset($_GET['code'])) {
            $result = get_web_page( "https://graph.facebook.com/v2.9/oauth/access_token?client_id=$id&redirect_uri=$redirect_url&client_secret=$secret&code=$_GET[code]" );

            if ( $result['http_code'] == 200 ){
                $token = json_decode($result['content'], true);
                if(TRUE){
                    $userData = get_web_page( "https://graph.facebook.com/v3.1/me?access_token=$token[access_token]&fields=id,name,email,last_name,first_name,picture.type(large)" );
                    $userData = json_decode($userData['content'], true);

                    $picture = file_get_contents($userData['picture']['data']['url']);

                    $pictureName = time() . '.jpg';
                    file_put_contents (AVATARS . $pictureName, $picture);
                    $pictureUrl = HTTP_AVATARS . $pictureName;

                    $checkUser = User::isUserRegistered($userData['id'], 'FACEBOOK');

                    if( $checkUser == FALSE ){ //Если такого пользователя нет, то регистрируем нового
                        $status = User::addFacebookUser($userData['id'], $userData['last_name'],
                            $userData['first_name'],$userData['email'], ( isset($userData['link']) )? $userData['link'] : ''  ,$pictureUrl);
                    }

                    $siteUser = User::getUserByFacebookId($userData['id']);
                    User::auth($siteUser['id']);

                    $redirectJS = <<<SCRIPT
                        <script>
                            if (sessionStorage.getItem("redirectUri")) {
                              var redirectUri = sessionStorage.getItem("redirectUri");sessionStorage.removeItem("redirectUri"); window.location.href = redirectUri;
                            }
                        </script>
SCRIPT;

                    echo $redirectJS;

                }
            } else {
                echo "error";
            }

            return TRUE;
        }
        header( "Location: $api_url" );

        return TRUE;
    }

    public function actionAjax(){

        if(isset($_GET['name'])){
            echo User::checkName($_GET['name']);
        }
        if(isset($_GET['surname'])){
            echo User::checkName($_GET['surname']);
        }
        return TRUE;
    }

}

?>