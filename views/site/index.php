
<? include_once ROOT . "/layouts/public/header_site.php" ?>
<section class="tag-sec s-text" style="display: none; background-image: url(<?= TEMPLATE ?>assets/img/helsinki-bg.jpg)">
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="tag-content">
                    <img src="<?= TEMPLATE ?>assets/img/marker-text.png" class="img-responsive" alt="">
                    <h1><?= $seo['title_'.$language] ?></h1>
                    <p><?= $seo['description_'.$language] ?></p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="home-map">
    <div id="map"></div>

    <?
    echo requireToVar('Чтобы уточнить свое расположение, просто перемещайте маркер по карте',
        SITE_ROOT . 'views/modals/hint.php')
    ?>
    <?php
    require_once ROOT . "/layouts/public/tab_selector_site.php";
    ?>
</section>



<style>
    #map {
        height: calc( 100vh - 60px );
        min-height: 350px;
    }
</style>

<script>

    function dragHeandler() {
        google.maps.event.addListener(mark, 'dragend', function () {
            sessionStorage.setItem('lat', mark.position.lat());
            sessionStorage.setItem('lng', mark.position.lng());
            var lang = "<?= $language ?>";

            $('.js-hint').removeClass('animated fadeInDown').fadeOut('150', function(){
                $(this).remove();
            }) ;

            $.ajax({
                url: "/" + lang + "/ajax?fast&lat=" + mark.position.lat() + '&lng=' + mark.position.lng(),
                type: 'GET',
                cache: false,
                dataType: 'json',
                success: function(respond,status){

                    if(status == 'success'){
                        var markers = respond.places;
                        $('#fast-parking-tab').html(respond.html);
                        for (var i = 0; i < markersArr.length; i++) {
                            markersArr[i].setMap(null);
                        }
                        markerCluster.clearMarkers();
                        markersArr = [];
                        map.newMarkersResresh(respond.places);
                    }
                }
            });

        });
    }

    var options = {
        enableHighAccuracy: true,
        timeout: 10000,
        maximumAge: 0
    };

    function success(pos) {
        var crd = pos.coords;

        mark = new google.maps.Marker({
            position: {
                lat: +crd.latitude,
                lng: +crd.longitude
            },
            draggable:true,
            map: map
        });
        console.log('Your current position is:');
        console.log(`Latitude : ${crd.latitude}`);
        console.log(`Longitude: ${crd.longitude}`);
        console.log(`More or less ${crd.accuracy} meters.`);
        sessionStorage.setItem('lat', crd.latitude);
        sessionStorage.setItem('lng', crd.longitude);

        dragHeandler();
    };

    function error(err) {
        console.warn(`ERROR(${err.code}): ${err.message}`);
        $.ajax({
            url: "/api/location",
            type: 'GET',
            cache: false,
            dataType: 'json',
            success: function(respond,status){
                if(status == 'success'){
                    mark = new google.maps.Marker({
                        position: {
                            lat: +respond.latitude,
                            lng: +respond.longitude
                        },
                        draggable:true,
                        map: map
                    });

                    sessionStorage.setItem('lat', +respond.latitude);
                    sessionStorage.setItem('lng', +respond.longitude);

                    dragHeandler();

                }
                console.log(respond);
            }
        });
    };

    var markers = <?= json_encode($places) ?>;
    var map;
    var markersArr;
    var markerCluser;
    var infoWindow;

    function intervalRightFormat(place){
        var int = Number(place["time_interval"]);
        if (place["kind_of_place"] == 'FREE'){
            if( int >= 60 ){
                return (int / 60) + 'h';
            } else if (int == 0) {
                return 'P';
            } else {
                return int + 'm';
            }
        } else {
            return 'P'
        }
    }

    function timeRightFormat(time){
        return time.split(':').shift();
    }

    function signRender(sign){
        var origin = window.location.origin;
        switch(sign) {
            case 'FREE':
                return `<img src='${origin}/template/assets/img/thumb1.png' >`;
            case 'PAY':
                return `<img src="${origin}/template/assets/img/thumb2.png" >`;
            case 'FORBIDDEN':
                return `<img src="${origin}/template/assets/img/thumb3.png" >`;
            case 'FORBIDDEN_YELLOW':
                return `<img src="${origin}/template/assets/img/thumb4.png" >`;
            default:
                return '';
        }
    }

    function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: <?= $coords['lat'] ?>, lng: <?= $coords['lon'] ?>},
            zoom: 11,
            mapTypeControl: false,
            fullscreenControl: false,
            gestureHandling: 'greedy'
        });

        markersArr = markers.map(function(place, i) {

            var marker = new google.maps.Marker({
                position: {
                    'lat': +place.lat,
                    'lng': +place.lon
                },
                map: map,
                icon: {
                    url: '<?= TEMPLATE."assets/img/marker.png" ?>', // url
                    scaledSize: new google.maps.Size(30, 42), // scaled size
                    origin: new google.maps.Point(0,0), // origin
                    labelOrigin: new google.maps.Point(15, 16)
                    //anchor: new google.maps.Point(0, 10) // anchor
                },
                label: {
                    text: intervalRightFormat( place ),
                    color: '#677782',
                    fontSize: "12px",
                    fontWeight: 'bolder'
                },
                placeInfo: place,
                id: place.id
            });

            marker.addListener('click', function() {
                var point = marker['placeInfo'];
                console.log(point['friendly_url']);

                var href = '<?= "/$language" ?>' + '/detail/' + (point['friendly_url'] ? point['friendly_url'] : point['id']);

                infowindow.setContent(`<div class="info-window">
                                <div class="top">
                                    <div class="place-sign">
                                        ${signRender(point['kind_of_place'])}
                                    </div>
                                    <div class="time">
                                        <div class="hours">
                                            ${timeRightFormat(point['weekday_from'])}-${timeRightFormat(point['weekday_to'])}
                                        </div>
                                        <div class="hours">
                                            ( ${timeRightFormat(point['saturday_from'])}-${timeRightFormat(point['saturday_to'])} )
                                        </div>
                                        <div class="hours holiday">
                                            ${timeRightFormat(point['sunday_from'])}-${timeRightFormat(point['sunday_to'])}
                                        </div>
                                    </div>
                                </div>
                                <div class="btns">
                                    <a href="${href}" class="std-btn js-nice-transition">
                                        <i class="fa fa-info-circle" aria-hidden="true"></i>
                                    </a>
                                    <a href="javascript:void(0);" class="std-btn js-add-to-favorites ripple">
                                        <i class="fa fa-star-o" aria-hidden="true"></i>
                                    </a>
                                    <a
                                    href="http://maps.google.com/maps?q=${point['lat']},${point['lon']}&ll=${point['lat']},${point['lon']}&z=13"
                                    class="std-btn gm js-nice-transition">
                                        <i class="fa fa-map-o" aria-hidden="true"></i>
                                        Open in GM2
                                    </a>
                                </div>
                            </div>`);


                infowindow.open(map, marker);

                $('.info-window .js-nice-transition').on('click', function(e){
                    e.preventDefault();
                    var href = $(this).attr('href');
                    $('body').addClass('leave');
                    setTimeout(function(){
                        window.location.href = href;
                    },500);
                });

                $('.js-add-to-favorites').on('click', function(){
                    console.log(marker.placeInfo.id);
                    $.ajax({
                        url: "/favorites/add?placeId=" + marker.placeInfo.id,
                        type: 'GET',
                        cache: false,
                        dataType: 'html',
                        success: function(respond,status){
                            console.log(respond);
                            $('#confirm-modal').remove();
                            $('body').append(respond);
                            $('#confirm-modal').modal();

                            $.ajax({
                                url: "/favorites/index?count",
                                type: 'GET',
                                cache: false,
                                dataType: 'html',
                                success: function(respond){
                                    console.log(respond);
                                    if($('.js-show-favorites span').length){
                                        $('.js-show-favorites span').text(respond);
                                    } else {
                                        $('.js-show-favorites').append('<span></span>');
                                        $('.js-show-favorites span').text(respond);
                                    }
                                }
                            })
                        }
                    });

                });
            });

            return marker;

        });

        infowindow = new google.maps.InfoWindow({
            maxWidth: 110
        });

        markerCluster = new MarkerClusterer(map, markersArr,
            {
                imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m',
                minimumClusterSize: 3
            });

        map.clearMap = function(){
            for (var i = 0; i < markersArr.length; i++) {
                markersArr[i].setMap(null);
            }
            markerCluster.clearMarkers();
            //markerCluster.removeMarkers( markerCluster.getMarkers() );
            markersArr = [];
        };

        navigator.geolocation.getCurrentPosition(success, error, options);
    }

</script>

<script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"></script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBaVoLDDl1BcYSVmgOHRBWAiIo4GqDiSJo&callback=initMap"></script>

<? include_once ROOT . "/layouts/public/footer_site.php" ?>

