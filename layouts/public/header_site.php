<?php
    include_once ROOT . "/localization/header_site.php";

?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html lang="zxx">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="robots" content="index,follow">

    <title>Listing Hub - Listing & Directory Template | ThemezHub</title>

    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="<?= TEMPLATE ?>assets/plugins/bootstrap/css/bootstrap.min.css">

    <!-- Bootstrap Select Option css -->
    <link rel="stylesheet" href="<?= TEMPLATE ?>assets/plugins/bootstrap/css/bootstrap-select.min.css">

    <!-- Icons -->
    <link href="<?= TEMPLATE ?>assets/plugins/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="<?= TEMPLATE ?>assets/plugins/themify-icons/css/themify-icons.css" rel="stylesheet">
    <link href="<?= TEMPLATE ?>assets/plugins/line-icons/css/line-font.css" rel="stylesheet">

    <!-- Animate -->
    <link href="<?= TEMPLATE ?>assets/plugins/animate/animate.css" rel="stylesheet">

    <!-- Bootsnav -->
    <link href="<?= TEMPLATE ?>assets/plugins/bootstrap/css/bootsnav.css" rel="stylesheet">

    <!-- Slick Slider -->
    <link href="<?= TEMPLATE ?>assets/plugins/slick-slider/slick.css" rel="stylesheet">

    <!-- Form Styles -->
    <link href="<?= TEMPLATE ?>assets/plugins/form-styler/jquery.formstyler.theme.css" rel="stylesheet">

    <!-- nouislider -->
    <link href="<?= TEMPLATE ?>assets/plugins/nouislider/nouislider.min.css" rel="stylesheet">

    <!-- Time Picker -->
    <link href="<?= TEMPLATE ?>assets/plugins/bootstrap-material-datetimepicker/bootstrap-material-datetimepicker.css" rel="stylesheet">

    <!-- Custom style -->
    <link href="<?= TEMPLATE ?>assets/css/style.css" rel="stylesheet">
    <link href="<?= TEMPLATE ?>assets/css/responsiveness.css" rel="stylesheet">
    <link  type="text/css" rel="stylesheet" id="jssDefault" href="<?= TEMPLATE ?>assets/css/colors/main.css">
    
    <link href="<?= TEMPLATE ?>assets/css/fix.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="<?= TEMPLATE ?>js/html5shiv.min.js"></script>
    <script src="<?= TEMPLATE ?>js/respond.min.js"></script>
    <![endif]-->
    <!-- Jquery js-->
    <script src="<?= TEMPLATE ?>assets/js/jquery.min.js"></script>
</head>
<body class="<?= ( isset($this->pageName) )? $this->pageName : '' ?>" >
<div class="wrapper">
    <!-- Start Navigation -->
    <nav class="navbar navbar-default navbar-fixed navbar-transparent white bootsnav">
        <div class="container-fluid">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
                <i class="ti-align-left"></i>
            </button>

            <!-- Start Header Navigation -->
            <div class="navbar-header">
                <a class="navbar-brand" href="../../index.php">
                    <img src="<?= TEMPLATE ?>assets/img/logo.png" class="logo logo-display" alt="">
                    <img src="<?= TEMPLATE ?>assets/img/logo.png" class="logo logo-scrolled" alt="">
                </a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="navbar-menu">
                <ul class="nav navbar-nav navbar-center" data-in="fadeInDown" data-out="fadeOutUp">
                    <li>
                        <a href="/<?= $language ?>"><?= $lang[$language]['home'] ?></a>
                    </li>
                    <li class="dropdown">
                        <a href="/<?= $language . "/about" ?>"><?= $lang[$language]['about'] ?></a>
                    </li>
                    <li class="dropdown">
                        <a href="/"><?= $lang[$language]['favorites'] ?></a>
                    </li>
                    <li><a href="#"><?= $lang[$language]['add_place'] ?></a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right" data-in="fadeInDown" >
                    <li class="no-pd">

                        <? include_once ROOT . "/components/langSelect.php"; ?>

                        <? if( isset($user) ): ?>
                            <div class="user-auth-wrap js-user-auth-wrap">
                                <div class="user-auth">
                                    <div style="background-image: url(<?= $user['picture'] ?>)"
                                         class="img-responsive img-circle avater-img js-avatar-img">
                                    </div>
                                    <strong><?= $user['givenName'] . ' ' . $user['familyName'] ?></strong>
                                </div>
                                <ul class="profile-menu">
                                    <li>
                                        <a href="/<?= $language ?>/profile">
                                            <i class="fa fa-user-circle-o" aria-hidden="true"></i>
                                            Profile
                                        </a>
                                    </li>
                                    <li>
                                        <a href="/<?= $language ?>/profile?logout">
                                            <i class="fa fa-sign-out" aria-hidden="true"></i>
                                            Log Out
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        <? else : ?>
                            <a href="javascript:void(0)" class="addlist" data-toggle="modal" data-target="#signup">
                                <i class="ti-user" aria-hidden="true"></i><?= $lang[$language]['sign_in'] ?>
                            </a>
                        <? endif; ?>

                    </li>

                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
    </nav>
