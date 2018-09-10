<?php
    include_once ROOT . "/localization/header_site.php";
    $languages = require ROOT."/config/languages.php";

?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html lang="<?= $language ?>">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description " content="<?= isset($seo)? $seo['description_' . $language] : '' ?>">
    <meta name="keywords" content="<?= isset($seo)? $seo['keywords_' . $language] : '' ?>">
    <meta name="robots" content="<?
        echo (isset($seo) && $seo['robots_index'] == 1)? 'index' : 'noindex';
    ?>,<?
        echo (isset($seo) && $seo['robots_follow'] == 1)? 'follow' : 'nofollow';
    ?>">
    <?
    $lang_url = ( isset($_SERVER['REDIRECT_URL']))? $_SERVER['REDIRECT_URL'] : '/';

    foreach ($languages as $key => $value) {
        $lang_url = str_replace("/$key", '', $lang_url);
    }

    ?>
    <? foreach ($languages as $lng => $value ) : ?>
        <link rel="alternate" hreflang="<?= $lng ?>" href="<?= SITE_URL . "/$lng" . "$lang_url" ?>" />
        <? if($language != $lng) : ?>
            
        <? endif; ?>
    <? endforeach; ?>

    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">

    <title><?= isset($seo)? $seo['title_' . $language] : '' ?></title>

    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="<?= TEMPLATE ?>assets/plugins/bootstrap/css/bootstrap.min.css">

    <!-- Bootstrap Select Option css -->
    <link rel="stylesheet" href="<?= TEMPLATE ?>assets/plugins/bootstrap/css/bootstrap-select.min.css">

    <!-- Icons -->
    <link href="<?= TEMPLATE ?>assets/plugins/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="<?= TEMPLATE ?>assets/plugins/themify-icons/css/themify-icons.css" rel="stylesheet">
    <link href="<?= TEMPLATE ?>assets/plugins/line-icons/css/line-font.css" rel="stylesheet">

    <!-- Animate -->
    <link href="<?= TEMPLATE ?>assets/plugins/animate/animate.min.css" rel="stylesheet">

    <!-- Bootsnav -->
    <link href="<?= TEMPLATE ?>assets/plugins/bootstrap/css/bootsnav.min.css" rel="stylesheet">

    <!-- Slick Slider -->
    <link href="<?= TEMPLATE ?>assets/plugins/slick-slider/slick.css" rel="stylesheet">

    <!-- Form Styles -->
    <link href="<?= TEMPLATE ?>assets/plugins/form-styler/jquery.formstyler.theme.css" rel="stylesheet">

    <!-- nouislider -->
    <link href="<?= TEMPLATE ?>assets/plugins/nouislider/nouislider.min.css" rel="stylesheet">

    <!-- Time Picker -->
    <link href="<?= TEMPLATE ?>assets/plugins/bootstrap-material-datetimepicker/bootstrap-material-datetimepicker.css" rel="stylesheet">

    <!-- Custom style -->
    <link href="<?= TEMPLATE ?>assets/css/style.min.css" rel="stylesheet">
    <link href="<?= TEMPLATE ?>assets/css/responsiveness.css" rel="stylesheet">
    <link  type="text/css" rel="stylesheet" id="jssDefault" href="<?= TEMPLATE ?>assets/css/colors/main.min.css">
    
    <link href="<?= TEMPLATE ?>assets/css/fix.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="<?= TEMPLATE ?>js/html5shiv.min.js"></script>
    <script src="<?= TEMPLATE ?>js/respond.min.js"></script>
    <![endif]-->
    <!-- Jquery js-->
    <script src="<?= TEMPLATE ?>assets/js/jquery.min.js"></script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-124208588-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-124208588-1');
    </script>
</head>
<body class="<?= ( isset($this->pageName) )? $this->pageName : '' ?> showed" >
<div class="wrapper">
    <!-- Start Navigation -->
    <nav class="navbar navbar-default navbar-fixed white bootsnav
<?= isset($this->pageName) && $this->pageName == 'home-page' ? '' : 'navbar-transparent' ?>">
        <div class="container-fluid">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
                <i class="ti-align-left"></i>
            </button>

            <!-- Start Header Navigation -->
            <div class="navbar-header">
                <a class="navbar-brand" href="/<?= $language ?>">

                    <img src="<?= TEMPLATE ?>assets/img/<?= isset($isHomePage) ? 'logo.png' : 'logo-white.png' ?>" class="logo logo-display" alt="">
                    <img src="<?= TEMPLATE ?>assets/img/logo.png" class="logo logo-scrolled" alt="">
                </a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="navbar-menu">
                <ul class="nav navbar-nav navbar-center" data-in="fadeInDown" data-out="fadeOutUp">
                    <li>
                        <a href="/<?= $language ?>" hreflang="<?= $language ?>" class="js-nice-transition">
                            <?= $lang[$language]['home'] ?>
                        </a>
                    </li>
                    <li class="dropdown">
                        <a href="/<?= $language . "/about" ?>" hreflang="<?= $language ?>" class="js-nice-transition">
                            <?= $lang[$language]['about'] ?>
                        </a>
                    </li>
                    <? if($userId) : ?>
                        <li class="dropdown">
                            <a href="javascript:void(0);"
                               class="js-show-favorites">
                                <?= $lang[$language]['favorites'] ?>
                                <? if( isset($_SESSION['userId']) && count(Favorites::getFavoritesByUserId($_SESSION['userId'])) ): ?>
                                    <span><?= count(Favorites::getFavoritesByUserId($_SESSION['userId'])) ?></span>
                                <? endif; ?>
                            </a>
                        </li>
                        <li>
                            <a href="/<?= $language . "/addplace" ?>" hreflang="<?= $language ?>" class="js-nice-transition">
                                <?= $lang[$language]['add_place'] ?>
                            </a>
                        </li>
                    <? else : ?>
                        <li class="dropdown">
                            <a href="javascript:void(0);"
                               class="disabled"
                               data-toggle="modal"
                               data-target="#no-sign">
                                <?= $lang[$language]['favorites'] ?>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0);"
                               class="disabled"
                               data-toggle="modal"
                               data-target="#no-sign">
                                <?= $lang[$language]['add_place'] ?>
                            </a>
                        </li>
                    <? endif; ?>
                </ul>
                <ul class="nav navbar-nav navbar-right" data-in="fadeInDown" >
                    <li class="no-pd">

                        <? include_once ROOT . "/components/langSelect.php"; ?>

                        <? if( isset($user) ): ?>
                            <div class="user-auth-wrap js-user-auth-wrap">
                                <div class="user-auth">
                                    <div class="img-responsive img-circle avater-img">
                                        <div style="background-image: url(<?= $user['picture'] ?>)"
                                             class="js-avatar-img">
                                        </div>
                                    </div>
                                    <strong><?= $user['givenName'] . ' ' . $user['familyName'] ?></strong>
                                </div>
                                <ul class="profile-menu">
                                    <li>
                                        <a href="/<?= $language ?>/profile" hreflang="<?= $language ?>" class="js-nice-transition">
                                            <i class="fa fa-user-circle-o" aria-hidden="true"></i>
                                            Profile
                                        </a>
                                    </li>
                                    <li>
                                        <a href="/<?= $language ?>/profile?logout" hreflang="<?= $language ?>" class="js-nice-transition">
                                            <i class="fa fa-sign-out" aria-hidden="true"></i>
                                            Log Out
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        <? else : ?>
                            <a href="javascript:void(0)" class="addlist desctop-sign" data-toggle="modal" data-target="#signup">
                                <i class="ti-user" aria-hidden="true"></i><?= $lang[$language]['sign_in'] ?>
                            </a>
                        <? endif; ?>

                    </li>

                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
    </nav>
