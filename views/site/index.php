
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
    var markers = <?= json_encode($places) ?>;
    var map;
    var markersArr;

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
        switch(sign) {
            case 'FREE':
                return `<img src="http://1117158.kiray92.web.hosting-test.net/template/assets/img/thumb1.png" >`;
            case 'PAY':
                return `<img src="http://1117158.kiray92.web.hosting-test.net/template/assets/img/thumb2.png" >`;
            case 'FORBIDDEN':
                return `<img src="http://1117158.kiray92.web.hosting-test.net/template/assets/img/thumb3.png" >`;
            case 'FORBIDDEN_YELLOW':
                return `<img src="http://1117158.kiray92.web.hosting-test.net/template/assets/img/thumb4.png" >`;
            case 'FORBIDDEN_PAY':
                return `<img src="http://1117158.kiray92.web.hosting-test.net/template/assets/img/thumb5.png" >`;
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
                                    <a href="#" class="std-btn">
                                        <i class="fa fa-star-o" aria-hidden="true"></i>
                                    </a>
                                    <a href="#" class="std-btn gm">
                                        <i class="fa fa-map-o" aria-hidden="true"></i>
                                        Open in GM2
                                    </a>
                                </div>
                            </div>`);
                infowindow.open(map, marker);
            });

            return marker;

        });

        var infowindow = new google.maps.InfoWindow({
            content: '<div>TEST</div>',
            maxWidth: 110
        });

        var markerCluster = new MarkerClusterer(map, markersArr,
            {imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'});

    }



</script>

<? include_once ROOT . "/layouts/public/footer_site.php" ?>

