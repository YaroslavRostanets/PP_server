
<? include_once ROOT . "/layouts/public/header_site.php" ?>

<section class="home-map">
    <div id="map"></div>
</section>

<style>
    #map {
        height: calc( 100vh - 60px );
        min-height: 350px;
    }
</style>

<script>
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
    };

    function error(err) {
        console.warn(`ERROR(${err.code}): ${err.message}`);
    };

    var markers = <?= json_encode($places) ?>;
    var map;
    var markersArr;
    var markerCluser;

    function intervalRightFormat(interval){
        var int = Number(interval);
        if( int >= 60 ){
            return (int / 60) + 'h';
        } else {
            return int + 'm';
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
            case 'FORBIDDEN_PAY':
                return `<img src="${origin}/template/assets/img/thumb5.png" >`;
            default:
                return '';
        }
    }

    function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: <?= $coords['lat'] ?>, lng: <?= $coords['lon'] ?>},
            zoom: 11,
            mapTypeControl: false,
            fullscreenControl: false
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
                    scaledSize: new google.maps.Size(34, 42), // scaled size
                    origin: new google.maps.Point(0,0), // origin
                    labelOrigin: new google.maps.Point(17, 15)
                    //anchor: new google.maps.Point(0, 10) // anchor
                },
                label: {
                    text: intervalRightFormat( place['time_interval'] ),
                    color: '#677782',
                    fontSize: "12px",
                    fontWeight: 'bolder'
                },
                placeInfo: place,
                id: place.id
            });

            marker.addListener('click', function() {
                var point = marker['placeInfo'];
                console.log(point);

                var href = '<?= "/$language" ?>' + '/detail/' + point['id'];

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
                                    <a href="${href}" class="std-btn">
                                        <i class="fa fa-info-circle" aria-hidden="true"></i>
                                    </a>
                                    <a href="javascript:void(0);" class="std-btn js-add-to-favorites">
                                        <i class="fa fa-star-o" aria-hidden="true"></i>
                                    </a>
                                    <a
                                    href="http://maps.google.com/maps?q=${point['lat']},${point['lon']}&ll=${point['lat']},${point['lon']}&z=13" class="std-btn gm">
                                        <i class="fa fa-map-o" aria-hidden="true"></i>
                                        Open in GM2
                                    </a>
                                </div>
                            </div>`);


                infowindow.open(map, marker);

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

        var infowindow = new google.maps.InfoWindow({
            content: '<div>TEST</div>',
            maxWidth: 110
        });

        markerCluster = new MarkerClusterer(map, markersArr,
            {imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'});

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

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDgSQwHIH_3nhcQsy2xLOKITaEK0WlfgoA&callback=initMap"></script>

<? include_once ROOT . "/layouts/public/footer_site.php" ?>

