<?php
/**
 * Created by PhpStorm.
 * User: Yaroslav
 * Date: 16.01.2018
 * Time: 23:11
 */
?>

<? include_once ROOT."/layouts/header.php" ?>
<? include_once ROOT."/layouts/sidebar.php" ?>

<div class="main-panel">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg " color-on-scroll="500">
        <div class=" container-fluid  ">
            <a class="navbar-brand" href="#pablo"> Парковки </a>
            <button href="" class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-bar burger-lines"></span>
                <span class="navbar-toggler-bar burger-lines"></span>
                <span class="navbar-toggler-bar burger-lines"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navigation">
                <ul class="nav navbar-nav mr-auto">
                    <li class="nav-item">
                        <a href="#" class="nav-link" data-toggle="dropdown">
                            <i class="nc-icon nc-palette"></i>
                            <span class="d-lg-none">Dashboard</span>
                        </a>
                    </li>
                    <li class="dropdown nav-item">
                        <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                            <i class="nc-icon nc-planet"></i>
                            <span class="notification">5</span>
                            <span class="d-lg-none">Notification</span>
                        </a>
                        <ul class="dropdown-menu">
                            <a class="dropdown-item" href="#">Notification 1</a>
                            <a class="dropdown-item" href="#">Notification 2</a>
                            <a class="dropdown-item" href="#">Notification 3</a>
                            <a class="dropdown-item" href="#">Notification 4</a>
                            <a class="dropdown-item" href="#">Another notification</a>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nc-icon nc-zoom-split"></i>
                            <span class="d-lg-block">&nbsp;Search</span>
                        </a>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#pablo">
                            <span class="no-icon">Account</span>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="http://example.com"
                           id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="no-icon">Dropdown</span>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <a class="dropdown-item" href="#">Something</a>
                            <a class="dropdown-item" href="#">Something else here</a>
                            <div class="divider"></div>
                            <a class="dropdown-item" href="#">Separated link</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#pablo">
                            <span class="no-icon">Log out</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- End Navbar -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">
                    <div class="card" style="padding: 20px;">
                        <div class="header">
                            <h4 class="title">Редактирование парковки</h4>
                        </div>
                        <div class="content">
                            <form action="#" method="post">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>ID (disabled)</label>
                                            <input type="text" class="form-control" readonly
                                                   name="id" value="<?= $parkPlace['id'] ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <h6>Будни</h6>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>От</label>
                                                    <input type="time"
                                                           class="form-control"
                                                           name="weekday_from"
                                                           value="<?= $parkPlace['weekday_from'] ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>До</label>
                                                    <input type="time"
                                                           class="form-control"
                                                           name="weekday_to"
                                                           value="<?= $parkPlace['weekday_to'] ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <h6>( Суббота )</h6>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>От</label>
                                                    <input type="time"
                                                           class="form-control"
                                                           name="saturday_from"
                                                           value="<?= $parkPlace['saturday_from'] ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>До</label>
                                                    <input type="time"
                                                           class="form-control"
                                                           name="saturday_to"
                                                           value="<?= $parkPlace['saturday_to'] ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <h6 style="color: red;">
                                            Воскресение
                                        </h6>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>От</label>
                                                    <input type="time"
                                                           class="form-control"
                                                           name="sunday_from"
                                                           value="<?= $parkPlace['sunday_from'] ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">До</label>
                                                    <input type="time"
                                                           class="form-control"
                                                           name="sunday_to"
                                                           value="<?= $parkPlace['sunday_to'] ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Интервал</label>
                                            <input type="text" class="form-control" name="time_interval"
                                                   value="<?= $parkPlace['time_interval'] ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Зона</label>
                                            <input type="text" class="form-control"
                                                   name="park_zone"
                                                   value="<?= $parkPlace['park_zone'] ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div id="map"></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Latitude (X coord)</label>
                                            <input type="text" class="form-control js-lat"
                                                   name="X(coordinates)"
                                                   value="<?= $parkPlace['X(coordinates)'] ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Longitude (Y coord)</label>
                                            <input type="text" class="form-control js-lon"
                                                   name="Y(coordinates)"
                                                   value="<?= $parkPlace['Y(coordinates)'] ?>">
                                        </div>
                                    </div>
                                </div>

                                <input type="submit" name="submit" class="btn btn-info btn-fill pull-right" value="Обновить парковку"></input>
                                <div class="clearfix"></div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-user">
                        <div class="image">
                            <img src="<?= $parkPlace['photo_url'] ?>" alt="..."/>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <footer class="footer">
        <div class="container">
            <nav>
                <ul class="footer-menu">
                    <li>
                        <a href="#">
                            Home
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            Company
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            Portfolio
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            Blog
                        </a>
                    </li>
                </ul>
                <p class="copyright text-center">
                    ©
                    <script>
                        document.write(new Date().getFullYear())
                    </script>
                    <a href="http://www.creative-tim.com">Creative Tim</a>, made with love for a better web
                </p>
            </nav>
        </div>
    </footer>
</div>

<script>
    function initMap(){
        console.log('test');

        var center = new google.maps.LatLng( <?= $parkPlace['X(coordinates)'] ?>, <?= $parkPlace['Y(coordinates)'] ?>);

        var parkPlace = {lat: <?= $parkPlace['X(coordinates)'] ?>, lng: <?= $parkPlace['Y(coordinates)'] ?>};

        var map = new google.maps.Map(document.getElementById('map'), {
            center: center,
            zoom: 13,
            scrollwheel: false
        });

        var marker = new google.maps.Marker({
            position: parkPlace,
            map: map,
            title: 'Hello World!'
        });

        google.maps.event.addListener(map, "click", function(event) {
            $('.js-lat').val(event.latLng.lat());
            $('.js-lon').val(event.latLng.lng());
            marker.setPosition( new google.maps.LatLng(event.latLng.lat(), event.latLng.lng()) );
        });

        $('.js-lat, .js-lon').focusout(function(){
            var lat = $('.js-lat').val();
            var lng = $('.js-lon').val();

            marker.setPosition( new google.maps.LatLng(lat, lng) );
            console.log(lat, lng);

            map.setCenter(new google.maps.LatLng(
                Number(lat), Number(lng) ) );
               
        });
    }
    $(document).ready(function(){
        $(".list-item").addClass("active");
    })
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDa557ija5pS08O4xsINwAEXTCyUzoB-js&callback=initMap" async defer></script>
<? include_once ROOT."/layouts/footer.php" ?>
