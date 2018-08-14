<?php
/**
 * Created by PhpStorm.
 * User: Yaroslav
 * Date: 04.08.2018
 * Time: 18:45
 */
?>
<? include_once ROOT . "/layouts/public/header_site.php" ?>

<section class="title-transparent page-title" style="background:url(<?= TEMPLATE ?>/assets/img/helsinki.jpg);">
    <div class="container">
    </div>
</section>

    <section class="padd-0 add-place">
        <div class="container">
            <div class="col-md-10 translateY-60 col-sm-12 col-md-offset-1">

                <div class="add-listing-box edit-info mrg-bot-25 padd-bot-30 padd-top-25">
                    <div class="col-md-5">
                        <div class="upload-btn-wrapper">
                            <div class="img-cont">
                                <img src="<?= TEMPLATE . "/assets/img/upload.svg" ?>" class="js-change-photo" alt="">
                                <input type="file" name="myfile" class="js-file-upload">
                            </div>
                            <button class="btn theme-btn">Upload Photo</button>
                        </div>
                        <div class="help-block js-photo-error"></div>
                    </div>
                    <div class="col-md-7 right-column">
                        <form class="add-place">
                            <div class="row">
                                <div class="col-sm-7">
                                    <label>Latitude</label>
                                    <input type="text" class="form-control js-lat" readonly value="24.2323" name="latitude">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-7">
                                    <label>Longitude</label>
                                    <input type="text" class="form-control js-lng" readonly value="25.8888" name="longitude">
                                </div>
                            </div>
                            <div class="row" style="display: none;">
                                <div class="col-sm-7">
                                    <input type="text" class="js-place-photo" name="filename">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-12 map-contain">
                        <div id="map"></div>
                    </div>
                </div>

                <div class="text-center">
                    <a href="javaascript:void(0);" class="btn theme-btn js-save">
                        Save
                    </a>
                </div>
            </div>
        </div>
    </section>

    <?
        echo requireToVar('Чтобы указать расположение, просто перемещайте маркер по карте',
        SITE_ROOT . 'views/modals/hint.php')
    ?>

    <script>

        function initMap(){
            lat = sessionStorage.getItem('lat') ? sessionStorage.getItem('lat') : 60.168765;
            lng = sessionStorage.getItem('lng') ? sessionStorage.getItem('lng') : 24.938336;
            $('.js-lat').val(lat);
            $('.js-lng').val(lng);

            map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: +lat, lng: +lng},
                zoom: 13,
                mapTypeControl: false,
                //fullscreenControl: false
            });

            var marker = new google.maps.Marker({
                position: {lat: +lat, lng: +lng},
                map: map,
                icon: {
                    url: '<?= TEMPLATE . '/assets/img/marker-red.png' ?>', // url
                    scaledSize: new google.maps.Size(35, 35), // scaled size
                    origin: new google.maps.Point(0,0), // origin
                    labelOrigin: new google.maps.Point(17, 15)
                    //anchor: new google.maps.Point(0, 10) // anchor
                },
                draggable:true,
                animation: google.maps.Animation.DROP
            });

            google.maps.event.addListener(marker, 'dragend', function () {
                // you know you'd be better off with
                // marker.getPosition().lat(), right?
                /*$("#txtLat").val(marker.position.Ia);
                $("#txtLong").val(marker.position.Ja);*/
                $('.js-lat').val(marker.position.lat());
                $('.js-lng').val(marker.position.lng());

                console.log(marker.position.lat());

            });

        }

        $('.js-file-upload').on('change', function () {
            var file_data = this.files[0];

            var form_data = new FormData();

            form_data.append('place_photo', file_data);

            $.ajax({
                url: '?upload-photo',
                type: 'POST',
                data: form_data,
                cache: false,
                dataType: 'json',
                processData: false,
                contentType: false,
                success: function (respond, status, jqXHR) {
                    console.log(respond);
                    if(respond.errors){
                        console.log(respond.errorText);
                        $('.js-photo-error').addClass('has-error').text(respond.errorText);
                    } else {
                        $('.js-change-photo').attr('src', window.location.origin + '/uploads/tmp_offer_parking/' + respond.filename);
                        $('.js-place-photo').val(respond.filename);
                        $('.js-photo-error').removeClass('has-error').text('');
                    }
                },

                error: function (jqXHR, status, errorThrown) {
                    console.log('ОШИБКА AJAX запроса: ' + status, jqXHR);
                }

            });

            console.log(file_data);
        });

        $('.js-save').on('click', function(){
            var formData = $('.add-place').serialize();

            $.ajax({
                url: '?save-place',
                type: 'POST',
                data: formData,
                dataType: 'json',
                success: function (respond, status, jqXHR) {
                    console.log(respond);
                    if(+respond.errors){
                        $('.js-photo-error').addClass('has-error').text(respond.errorText);
                    } else {
                        $('#save-place').modal();
                    }
                },

                error: function (jqXHR, status, errorThrown) {
                    console.log('ОШИБКА AJAX запроса: ' + status, jqXHR);
                }

            });

        });

        $('.upload-btn-wrapper .theme-btn').on('click', function () {
           $('.js-file-upload').click();
        });

    </script>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBaVoLDDl1BcYSVmgOHRBWAiIo4GqDiSJo&callback=initMap"></script>
<? include_once ROOT . "/layouts/public/footer_site.php" ?>
<? include_once ROOT . "/views/modals/save-place.php" ?>
