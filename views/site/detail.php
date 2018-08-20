<?php
/**
 * Created by PhpStorm.
 * User: Yaroslav
 * Date: 20.07.2018
 * Time: 0:01
 */

function rightTimeFormat($time){
    $arr = explode(":", $time);
    return $arr[0]; //Возвращает часы
}

function rightInterval($min) {
    if($min >= 60) {
        return floor( ($min / 60) ) . " h";
    } elseif ($min == 0){
        return "-";
    } else {
        return floor( $min ) . " min";
    }
}

?>
<? include_once ROOT . "/layouts/public/header_site.php" ?>
<?php
include_once ROOT . "/localization/detail.php";
?>

<section class="detail-section" style="background:url(<?= TEMPLATE . "assets/img/slider-3.jpg" ?>);">
    <div class="overlay" style="background-color: rgb(36, 36, 41); opacity: 0.5;"></div>
    <div class="profile-cover-content">
        <div class="container">
            <div class="cover-buttons">
                <ul>
                    <? if($place['address_'.$language] != '') :?>
                        <li>
                            <div class="buttons medium button-plain address-cont">
                                <i class="fa fa-map-marker"></i><?= $place['address_'.$language] ?>
                            </div>
                        </li>
                    <? endif; ?>
                    <li>
                        <div class="inside-rating buttons listing-rating theme-btn button-plain js-distance-duration">
                            <span class="value js-distance">
                                <?= $place['geodist_pt'] ?>
                            </span>
                            <sup class="out-of js-distance-sup">
                                km
                            </sup>
                            <span class="js-duration-wrap">
                                <i class="fa fa-clock-o" aria-hidden="true"></i>
                                <span class="js-duration">
                                    -
                                </span>
                            </span>

                        </div>
                    </li>
                    <li>
                        <a href="http://maps.google.com/maps?q=<?= $place['X(coordinates)'] ?>,<?= $place['Y(coordinates)'] ?>&ll=<?= $place['X(coordinates)'] ?>,<?= $place['Y(coordinates)'] ?>&z=13" class="buttons btn-outlined medium get-direct">
                            <i class="fa fa-map-o" aria-hidden="true"></i>
                            <?= $lang[$language]['open_in_google_maps'] ?>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="buttons btn-outlined add-to-wishlist">
                            <i class="fa fa-star-o"></i>
                                <?= $lang[$language]['to_favorites'] ?>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="listing-owner">
                <div class="listing-owner-detail">
                    <?
                    switch ($place['kind_of_place']) {
                        case 'FREE':
                            echo '<img class="sign" src='. TEMPLATE . 'assets/img/thumb1.png >';
                            break;
                        case 'PAY':
                            echo '<img class="sign" src='. TEMPLATE . 'assets/img/thumb2.png >';
                            break;
                        case 'FORBIDDEN':
                            echo '<img class="sign" src='. TEMPLATE . 'assets/img/thumb3.png >';
                            break;
                        case 'FORBIDDEN_YELLOW':
                            echo '<img class="sign" src='. TEMPLATE . 'assets/img/thumb4.png >';
                            break;
                        case 'FORBIDDEN_PAY':
                            echo '<img class="sign" src='. TEMPLATE . 'assets/img/thumb5.png >';
                            break;
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="list-detail">
    <div class="container">
        <div class="row detail-flex">
            <div class="col-xs-12 col-sm-8 col-md-8">
                <div class="detail-wrapper">
                    <div class="detail-wrapper-header">
                        <h4>Location</h4>
                    </div>
                    <div class="detail-wrapper-body">
                        <? if( $place['address_'.$language] != '') : ?>
                            <a href="#listing-location" class="listing-address">
                                <i class="ti-location-pin mrg-r-5"></i>
                                <?= $place['address_'.$language] ?>
                            </a>
                        <? endif; ?>
                        <div id="detail-map"></div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-4">

                <div class="widget-boxed right-part">
                    <div class="img-detail">
                        <img src="<?= $place['photo_url'] ?>" alt="фото парковки">
                    </div>
                    <div class="widget-boxed-body">
                        <div class="side-list">
                            <ul>
                                <li>
                                    Time interval
                                    <span>
                                        <?= rightInterval($place['time_interval'])  ?>
                                    </span>
                                </li>
                                <li>Mon-Fry
                                    <span>
                                        <?= rightTimeFormat($place['weekday_from']) ?> - <?= rightTimeFormat($place['weekday_to']) ?>
                                    </span>
                                </li>
                                <li>Saturday
                                    <span>
                                        (<?= rightTimeFormat($place['saturday_from']) ?> - <?= rightTimeFormat($place['saturday_to']) ?>)
                                    </span>
                                </li>
                                <li class="sunday">Sunday
                                    <span>
                                        <?= rightTimeFormat($place['sunday_from']) ?> - <?= rightTimeFormat($place['sunday_to']) ?>
                                    </span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<script>
    var lang = {
        'm' : '<?= $lang[$language]['m'] ?>',
        'km' : '<?= $lang[$language]['km'] ?>',
        'min' : '<?= $lang[$language]['min'] ?>',
        'h' : '<?= $lang[$language]['h'] ?>'
    };

    function distanceRightFormat(distance){
        if(+distance >= 1000){
            return {
                'value': (+distance / 1000).toFixed(1),
                'sup': lang.km
            };
        } else {
            return {
                'value': +distance,
                'sup': lang.m
            }
        }
    }

    function durationRightFormat(duration){
        var h = duration/3600 ^ 0;
        var hText = h ? h + '<sup>' + lang.h + '</sup>' : false;
        var m = ((duration-h*3600)/60 ^ 0) ? (duration-h*3600)/60 ^ 0 : false;
        var mText = m ? ((duration-h*3600)/60 ^ 0) + '<sup class="out-of">' + lang.min + '</sup>' : false;

        return h ? hText : '' + mText;
    }

    var directionsService;
    var directionsDisplay;

    function intervalRightFormat(interval){
        var int = Number(interval);
        if( int >= 60 ){
            return (int / 60) + 'h';
        } else {
            return int + 'm';
        }
    }

    function calcRoute(start, end) {
        var request = {
            origin:start,
            destination:end,
            travelMode: 'DRIVING'
        };
        directionsService.route(request, function(response, status) {
            if (status == 'OK') {
                var distance = response.routes[0].legs[0].distance.value;
                var duration = response.routes[0].legs[0].duration;

                distance = distanceRightFormat(distance);
                duration = durationRightFormat(duration.value);

                $('.js-distance').text(distance.value);
                $('.js-distance-sup').text(distance.sup);
                $('.js-duration').html(duration);
                directionsDisplay.setDirections(response);
            }
        });
    }

    function initMap(){
        map = new google.maps.Map(document.getElementById('detail-map'), {
            center: {lat: <?= $place['X(coordinates)'] ?>, lng: <?= $place['Y(coordinates)'] ?>},
            zoom: 13,
            mapTypeControl: false,
            //fullscreenControl: false
        });

        directionsService = new google.maps.DirectionsService();
        directionsDisplay = new google.maps.DirectionsRenderer({
            suppressMarkers: true
        });

        directionsDisplay.setMap(map);


        var marker = new google.maps.Marker({
            position: {lat: <?= $place['X(coordinates)'] ?>, lng: <?= $place['Y(coordinates)'] ?>},
            map: map,
            icon: {
                url: '<?= TEMPLATE."assets/img/marker.png" ?>', // url
                scaledSize: new google.maps.Size(34, 42), // scaled size
                origin: new google.maps.Point(0,0), // origin
                labelOrigin: new google.maps.Point(17, 15)
                //anchor: new google.maps.Point(0, 10) // anchor
            },
            label: {
                text: intervalRightFormat( <?= $place['time_interval'] ?> ),
                color: '#677782',
                fontSize: "12px",
                fontWeight: 'bolder'
            },
        });

        if(sessionStorage.getItem('lat') && sessionStorage.getItem('lng') ){
            var lat = +sessionStorage.getItem('lat');
            var lng = +sessionStorage.getItem('lng');

            var userMarker = new google.maps.Marker({
                position: {lat: lat, lng: lng},
                map: map,
                draggable: true
            });

            calcRoute({'lat': lat, 'lng': lng},
                {'lat':<?= $place['X(coordinates)'] ?>, 'lng':<?= $place['Y(coordinates)'] ?>});

        } else {
            var options = {
                enableHighAccuracy: true,
                timeout: 10000,
                maximumAge: 0
            };

            function success(pos) {
                var crd = pos.coords;

                userMarker = new google.maps.Marker({
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

                calcRoute({'lat': +crd.latitude, 'lng': +crd.longitude},
                    {'lat':<?= $place['X(coordinates)'] ?>, 'lng':<?= $place['Y(coordinates)'] ?>});
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
                            userMarker = new google.maps.Marker({
                                position: {
                                    lat: +respond.latitude,
                                    lng: +respond.longitude
                                },
                                draggable:true,
                                map: map
                            });

                            sessionStorage.setItem('lat', +respond.latitude);
                            sessionStorage.setItem('lng', +respond.longitude);

                            calcRoute({'lat': +respond.latitude, 'lng': +respond.longitude},
                                {'lat':<?= $place['X(coordinates)'] ?>, 'lng':<?= $place['Y(coordinates)'] ?>});

                        }
                        console.log(respond);
                    }
                });
            };
            navigator.geolocation.getCurrentPosition(success, error, options);

        }

        google.maps.event.addListener(userMarker, 'dragend', function () {
            var lat = userMarker.position.lat();
            var lng = userMarker.position.lng();
            sessionStorage.setItem('lat', lat);
            sessionStorage.setItem('lng', lng);
            var lang = "<?= $language ?>";

            calcRoute({'lat': +lat, 'lng': +lng},
                {'lat':<?= $place['X(coordinates)'] ?>, 'lng':<?= $place['Y(coordinates)'] ?>});

        });

    }

    $('.add-to-wishlist').on('click', function(){

        $.ajax({
            url: "/favorites/add?placeId=" + <?= $place['id'] ?>,
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

</script>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBaVoLDDl1BcYSVmgOHRBWAiIo4GqDiSJo&callback=initMap" async defer></script>

<? include_once ROOT . "/layouts/public/footer_site.php" ?>