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

                <div class="col-md-5">
                    <div class="upload-btn-wrapper">
                        <div class="img-cont">
                            <img src="<?= TEMPLATE . "/assets/img/upload.svg" ?>" alt="">
                        </div>
                        <button class="btn theme-btn">Upload Photo</button>
                        <input type="file" name="myfile">

                    </div>
                </div>
                <div class="col-md-7 right-column">
                    <form class="add-place">
                        <div class="row">
                            <div class="col-sm-6">
                                <label>Latitude</label>
                                <input type="text" class="form-control" value="24.2323">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <label>Longitude</label>
                                <input type="text" class="form-control" value="25.8888">
                            </div>
                        </div>
                    </form>
                </div>

                <div class="add-listing-box edit-info mrg-bot-25 padd-bot-30 padd-top-25">
                    <div id="map"></div>

                </div>


                <div class="text-center">
                    <a href="javaascript:void(0);" class="btn theme-btn js-update" title="Submit Listing">
                        Save
                    </a>
                </div>
            </div>
        </div>
    </section>

    <script>
        function initMap(){
            lat = sessionStorage.getItem('lat');
            lng = sessionStorage.getItem('lng');

            map = new google.maps.Map(document.getElementById('detail-map'), {
                center: {lat: lat, lng: lng},
                zoom: 13,
                mapTypeControl: false,
                //fullscreenControl: false
            });

            var marker = new google.maps.Marker({
                position: {lat: lat, lng: lng},
                map: map,
                icon: {
                    url: '<?= TEMPLATE."assets/img/marker.png" ?>', // url
                    scaledSize: new google.maps.Size(34, 42), // scaled size
                    origin: new google.maps.Point(0,0), // origin
                    labelOrigin: new google.maps.Point(17, 15)
                    //anchor: new google.maps.Point(0, 10) // anchor
                }
            });
        }
    </script>

<? include_once ROOT . "/layouts/public/footer_site.php" ?>