
<?php
/**
 * Created by PhpStorm.
 * User: Yaroslav
 * Date: 20.01.2018
 * Time: 15:03
 */
?>


<? include_once ROOT."/layouts/header.php" ?>
<? include_once ROOT."/layouts/sidebar.php" ?>

<div class="main-panel">
    <!-- Navbar -->
    <? include_once ROOT."/layouts/navbar.php" ?>
    <!-- End Navbar -->
    <div class="content">
        <div class="container-fluid">
            <form id="add-park-form" action="#" method="post">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card" style="padding: 20px;">
                            <div class="header">
                                <h4 class="title">Добавление парковки</h4>
                            </div>
                            <div class="content">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <h6>Будни</h6>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>От</label>
                                                        <input type="text"
                                                               data-time
                                                               class="form-control"
                                                               name="weekday_from"
                                                               value="">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>До</label>
                                                        <input type="text"
                                                               data-time
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
                                                        <input type="text"
                                                               data-time
                                                               class="form-control"
                                                               name="saturday_from"
                                                               value="">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>До</label>
                                                        <input type="text"
                                                               data-time
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
                                                        <input type="text"
                                                               data-time
                                                               class="form-control"
                                                               name="sunday_from"
                                                               value="">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">До</label>
                                                        <input type="text"
                                                               data-time
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
                                                    <option value="1440">24h</option>
                                                </select>
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
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label>
                                                    friendly_URL
                                                </label>
                                                <input type="text"
                                                       class="form-control js-friendly-url"
                                                       data-id="<?= $currentId ?>"
                                                       name="friendly_url">
                                            </div>
                                            <div class="form-group">
                                                <label>Address EN</label>
                                                <input type="text" id="address_en" class="form-control" name="address_en">
                                            </div>
                                            <div class="form-group">
                                                <label>Address FI</label>
                                                <input type="text" id="address_fi" class="form-control" name="address_fi">
                                            </div>
                                            <div class="form-group">
                                                <label>Адрес RU</label>
                                                <input type="text" id="address_ru" class="form-control" name="address_ru">
                                            </div>
                                            <div class="form-group">
                                                <label>Адреса UA</label>
                                                <input type="text" id="address_uk" class="form-control" name="address_uk">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <a href="javascript:void(0);"
                                                   class="btn btn-warning btn-fill js-get-address">
                                                    <i class="fa fa-map-marker" aria-hidden="true"></i>
                                                    Получить адрес
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card card-user">
                            <div class="cont">
                                <div class="js-upload-photo">
                                    <img src="<?= TEMPLATE ?>img/upload_photo.png" alt="Нет фото">
                                </div>
                                <div class="image" style="display: none;">
                                    <img src="" alt="">
                                </div>
                                <input type="file" class="js-upload-img" multiple="multiple" accept=".txt,image/*">
                            </div>
                            <div class="place-card">
                                <h4>Знак</h4>
                                <div class="signs">
                                    <div class="radio">
                                        <label>
                                            <img src="<?= TEMPLATE ?>img/thumb1.png" alt="">
                                            <input type="radio" value="FREE" checked required name="kind_of_place">
                                        </label>
                                        <label class="without-table">
                                            <div>Знак без таблички</div>
                                            <input type="checkbox" name="hasnt_table" value="1">
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <img src="<?= TEMPLATE ?>img/thumb2.png" alt="">
                                            <input type="radio" value="PAY" required name="kind_of_place">
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <img src="<?= TEMPLATE ?>img/thumb3.png" alt="">
                                            <input type="radio" value="FORBIDDEN" required name="kind_of_place">
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <img src="<?= TEMPLATE ?>img/thumb4.png" alt="">
                                            <input type="radio"  value="FORBIDDEN_YELLOW" required name="kind_of_place">
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
                            <button class="btn btn-info btn-fill pull-right" onclick="window.history.back();">Назад</button>
                            <input type="submit" name="submit" style="margin-right: 10px" class="btn btn-success btn-fill pull-right" value="Сохранить"></input>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <?php

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
        var geocoder = new google.maps.Geocoder;
        console.log('test');

        var center = new google.maps.LatLng( 60.16318816140338, 24.941539764404297);

        var parkPlace = {
            lat: <?= $previous['X(coordinates)'] || 60.16318816140338 ?>,
            lng: <?= $previous['Y(coordinates)'] || 24.941539764404297 ?>};
        $('.js-lat').val( parkPlace.lat );
        $('.js-lon').val( parkPlace.lon );
        var map = new google.maps.Map(document.getElementById('map'), {
            center: center,
            zoom: 13,
            scrollwheel: false
        });

        var marker = new google.maps.Marker({
            position: parkPlace,
            map: map
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

        function setAddresValue(langCode, params){
            params.language = langCode;

            $.ajax({
                url: '<?= GEOCODE_URI ?>' + $.param(params),
            }).done(function(result) {
                if(result.status == 'OK'){
                    console.log(result.results);
                    if(result.results[0]){
                        $('#address_' + langCode).val( result.results[0].formatted_address );
                        if(langCode == 'en'){
                            var url = (result.results[0].address_components[1].long_name +
                                '-' +
                                + result.results[0].address_components[0].long_name + '-' +
                                + $('.js-friendly-url').attr('data-id')).toLowerCase().replace( / /g, "-" ).replace( /'/g, "" );

                            url = url.normalize('NFD').replace(/[\u0300-\u036f]/g, "");

                            $('.js-friendly-url').val(url);
                        }
                    }
                } else {
                    window.alert('Geocoder failed due to: ' + status);
                }
            });
        }

        $('.js-get-address').on('click', function(){
            var lat = $('.js-lat').val();
            var lon = $('.js-lon').val();

            var params = {
                'latlng': lat + ',' + lon,
                'language': 'en',
                'key': '<?= GM_API_KEY ?>'
            };

            setAddresValue('en', params);
            setAddresValue('fi', params);
            setAddresValue('ru', params);
            setAddresValue('uk', params);

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

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBaVoLDDl1BcYSVmgOHRBWAiIo4GqDiSJo&callback=initMap" async defer></script>
<? include_once ROOT."/layouts/footer.php" ?>

<script>
    $('[data-time]').mask('00:00');
</script>