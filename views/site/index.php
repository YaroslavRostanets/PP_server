
<? include_once ROOT."/layouts/header_site.php" ?>

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

    function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: <?= $coords['lat'] ?>, lng: <?= $coords['lon'] ?>},
            zoom: 11,
            mapTypeControl: false,
            fullscreenControl: false
        });

            var template =  `<div class="info-window">
                                <div class="top">
                                    <div class="place-sign">
                                        <img src="http://1117158.kiray92.web.hosting-test.net/template/assets/img/thumb1.png" >
                                    </div>
                                    <div class="time">
                                        <div class="hours">14-18</div>
                                        <div class="hours">(14-18)</div>
                                        <div class="hours holiday">14-18</div>
                                    </div>
                                </div>
                                <div class="btns">
                                    <a href="#" class="std-btn">
                                        <i class="fa fa-info-circle" aria-hidden="true"></i>
                                    </a>
                                    <a href="#" class="std-btn">
                                        <i class="fa fa-star-o" aria-hidden="true"></i>
                                    </a>
                                    <a href="#" class="std-btn gm">
                                        <i class="fa fa-map-o" aria-hidden="true"></i>
                                        Open in GM
                                    </a>
                                </div>
                            </div>`;


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
                infowindow.setContent(template);
                infowindow.open(map, marker);
            });

            return marker;

        });

        var infowindow = new google.maps.InfoWindow({
            content: '<div>TEST</div>',
            maxWidth: 250
        });

        var markerCluster = new MarkerClusterer(map, markersArr,
            {imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'});

    }



</script>

<? include_once ROOT."/layouts/footer_site.php" ?>

