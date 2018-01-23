<?php
/**
 * Created by PhpStorm.
 * User: Yaroslav
 * Date: 20.01.2018
 * Time: 15:03
 */
?>
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
                            <h4 class="title">Добавление парковки</h4>
                        </div>
                        <div class="content">
                            <form id="add-park-form" action="#" method="post">
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
                                                           value="">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>До</label>
                                                    <input type="time"
                                                           class="form-control"
                                                           name="weekday_to"
                                                           value="">
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
                                                           value="">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>До</label>
                                                    <input type="time"
                                                           class="form-control"
                                                           name="saturday_to"
                                                           value="">
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
                                                           value="">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">До</label>
                                                    <input type="time"
                                                           class="form-control"
                                                           name="sunday_to"
                                                           value="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Интервал</label>
                                            <input type="text" class="form-control time-interval" name="time_interval"
                                                   required
                                                   value="">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Зона</label>
                                            <input type="text"
                                                   required
                                                   class="form-control park-zone"
                                                   name="park_zone"
                                                   value="">
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
                                            <input type="text"
                                                   required
                                                   class="form-control js-lat"
                                                   name="X(coordinates)"
                                                   value="">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Longitude (Y coord)</label>
                                            <input type="text"
                                                   required
                                                   class="form-control js-lon"
                                                   name="Y(coordinates)"
                                                   value="">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>filename</label>
                                            <input type="text" readonly
                                                   required
                                                   class="form-control js-filename"
                                                   name="photo_url"
                                                   value="">
                                        </div>
                                    </div>
                                </div>

                                <button class="btn btn-info btn-fill pull-right" onclick="window.history.back();">Назад</button>
                                <input type="submit" name="submit" style="margin-right: 10px" class="btn btn-success btn-fill pull-right" value="Сохранить"></input>
                                <div class="clearfix"></div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-user">
                        <div class="js-upload-photo">
                            <img src="<?= TEMPLATE ?>img/upload_photo.png" alt="Нет фото">
                        </div>
                        <div class="image" style="display: none;">
                            <img src="" alt="">
                        </div>
                        <input type="file" class="js-upload-img" multiple="multiple" accept=".txt,image/*">
                    </div>
                </div>

            </div>
        </div>
    </div>
    <?php

    pri($_SERVER);

    ?>
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

        var center = new google.maps.LatLng( 60.16318816140338, 24.941539764404297);

        var parkPlace = {lat: 60.16318816140338, lng: 24.941539764404297};
        $('.js-lat').val(60.16318816140338);
        $('.js-lon').val(24.941539764404297);
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

            map.setCenter(new google.maps.LatLng(
                Number(lat), Number(lng) ) );

        });
    }
    $(document).ready(function(){
        $(".list-item").addClass("active");

        $(".js-lat, .js-lon, .time-interval, .park-zone").keypress(function (e) {
            if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                return false;
            }
        });
    });

    /*--Загрузка картинки--*/
    $('.js-upload-photo').on("click", function () {
       $(".js-upload-img").click();
    });

    $('.js-upload-img').on('change', function(){
        var file_data = this.files[0];
        console.log(file_data);
        var form_data = new FormData();
        form_data.append('file', file_data);
        $.ajax({
            url: window.location.origin + '/admin/uploadplaceimg',
            dataType: 'text',
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            success: function(data,textStatus,XHR){
                var file = JSON.parse( data );
                var fullFileName = file['fileName'] + "." + file['format'];
                $(".js-filename").val( fullFileName );
                $(".js-upload-photo").hide();
                $(".card-user .image img").attr("src","<?= TMP_PLACES ?>" + fullFileName);
                $(".card-user .image").show();
            }
        });

    });
    /*--конец Загрузка картинки--*/

    /*--Валидация--*/
    $('#add-park-form').validator();
    /*--конец Валидация--*/
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDa557ija5pS08O4xsINwAEXTCyUzoB-js&callback=initMap" async defer></script>
<? include_once ROOT."/layouts/footer.php" ?>

