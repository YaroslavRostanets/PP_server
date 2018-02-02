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
<?php
    $arrUrl = explode("/",$parkPlace['photo_url']);
    $filename = array_pop( $arrUrl );
?>

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
            <form action="#" method="post">
                <div class="row">
                <div class="col-md-8">
                    <div class="card" style="padding: 20px;">
                        <div class="header">
                            <h4 class="title">Редактирование парковки</h4>
                        </div>
                        <div class="content">

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
                                            <select name="time_interval" class="form-control time-interval" id="">
                                                <option selected value="0">Нет интервала</option>
                                                <option value="10">10m</option>
                                                <option value="15">15m</option>
                                                <option value="30">30m</option>
                                                <option value="60">1h</option>
                                                <option value="120">2h</option>
                                                <option value="180">3h</option>
                                                <option value="240">4h</option>
                                                <option value="360">6h</option>
                                                <option value="720">12h</option>
                                                <option value="1140">24h</option>
                                            </select>
                                            <script>
                                                $(".time-interval").val(
                                                    <?= $parkPlace['time_interval'] ?>
                                                );
                                            </script>
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
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>filename</label>
                                            <input type="text" readonly
                                                   required
                                                   class="form-control js-filename"
                                                   name="filename"
                                                   value="<?= $filename ?>">
                                        </div>
                                    </div>
                                </div>

                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-user">
                        <div class="image js-replace-image">
                            <img src="<?= $parkPlace['photo_url'] ?>" alt="..."/>
                        </div>
                        <input type="file" class="js-upload-img" multiple="multiple" accept=".txt,image/*">
                        <div class="place-card">
                            <h4>Знак</h4>
                            <div class="signs">
                                <div class="radio">
                                    <label>
                                        <img src="<?= TEMPLATE ?>img/thumb1.png" alt="">
                                        <input type="radio"
                                               value="FREE"
                                               <?= ($parkPlace['kind_of_place'] === 'FREE')? "checked" : "" ?>
                                               required
                                               name="kind_of_place">
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <img src="<?= TEMPLATE ?>img/thumb2.png" alt="">
                                        <input type="radio"
                                               value="PAY"
                                               <?= ($parkPlace['kind_of_place'] === 'PAY')? "checked" : "" ?>
                                               required
                                               name="kind_of_place">
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <img src="<?= TEMPLATE ?>img/thumb3.png" alt="">
                                        <input type="radio"
                                               value="FORBIDDEN"
                                               <?= ($parkPlace['kind_of_place'] === 'FORBIDDEN')? "checked" : "" ?>
                                               required
                                               name="kind_of_place">
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <img src="<?= TEMPLATE ?>img/thumb4.png" alt="">
                                        <input type="radio"
                                               value="FORBIDDEN_YELLOW"
                                               <?= ($parkPlace['kind_of_place'] === 'FORBIDDEN_YELLOW')? "checked" : "" ?>
                                               required
                                               name="kind_of_place">
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <img src="<?= TEMPLATE ?>img/thumb3.png" alt="">
                                        <input type="radio"
                                               value="FORBIDDEN_PAY"
                                               <?= ($parkPlace['kind_of_place'] === 'FORBIDDEN_PAY')? "checked" : "" ?>
                                               required
                                               name="kind_of_place">
                                    </label>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
                <div class="row" style="margin-top: 30px;">
                    <div class="col-md-12">
                        <div class="card card-block">
                            <button class="btn btn-info btn-fill pull-right" style="margin-left: 10px;" onclick="window.history.back();">Назад</button>
                            <input type="submit" name="submit" class="btn btn-info btn-fill pull-right" value="Обновить парковку"></input>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </form>
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

    /*--Замена картинки--*/
    $('.js-upload-photo, .js-replace-image').on("click", function () {
        $(".js-upload-img").click();
    });

    $('.js-upload-img').on('change', function(){
        var file_data = this.files[0];
        console.log(file_data);
        var form_data = new FormData();
        form_data.append('file', file_data);
        $.ajax({
            url: window.location.origin + '/admin/replaceimg?filename=<?= $filename ?>',
            dataType: 'text',
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            success: function(data,textStatus,XHR){
                console.log(data);
                var file = JSON.parse( data );
                var fullFileName = file['fileName'] + "." + file['format'];
                $(".js-filename").val( fullFileName );
                $(".card-user .js-replace-image img").attr("src","<?= TMP_PLACES ?>" + fullFileName);
            }
        });

    });
    /*--конец Загрузка картинки--*/

    $(document).ready(function(){
        $(".list-item").addClass("active");
    })
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDa557ija5pS08O4xsINwAEXTCyUzoB-js&callback=initMap" async defer></script>
<? include_once ROOT."/layouts/footer.php" ?>

