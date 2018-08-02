/**
 * Created by Yaroslav on 01.08.2018.
 */

map.newMarkersResresh = function(markers){
    markersArr = markers.map(function(place, i) {

        var marker = new google.maps.Marker({
            position: {
                'lat': +place.lat,
                'lng': +place.lon
            },
            map: map,
            icon: {
                url: window.location.origin + '/template/assets/img/marker.png', // url
                scaledSize: new google.maps.Size(34, 42), // scaled size
                origin: new google.maps.Point(0,0), // origin
                labelOrigin: new google.maps.Point(17, 15)
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

        var infowindow = new google.maps.InfoWindow({
            content: '<div>TEST</div>',
            maxWidth: 110
        });

        marker.addListener('click', function() {
            var point = marker['placeInfo'];
            console.log(point);

            var href = '';

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

        markerCluster = new MarkerClusterer(map, markersArr,
            {imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'});

        return marker;

    });
};

$('.js-tab-sel[data-act=FAST]').on('click', function(){
    console.log('ajax');
    var lat = sessionStorage.getItem('lat');
    var lng = sessionStorage.getItem('lng');

    $.ajax({
        url: "/ajax?fast&lat=" + lat + '&lng=' + lng,
        type: 'GET',
        cache: false,
        dataType: 'json',
        success: function(respond,status){
            console.log('____');
            console.log(respond);
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

$('.js-red-btn').on('click', function(){
    var act = $(this).attr('data-active');
    console.log(act);
    switch(act) {
        case 'FAST':
            fastFunc();
            break;
        case 'FILTER':
            filterFunc();
            break;
        case 'SEARCH':
            searchFunc();
            break;
    }
});


function fastFunc() {

}

function filterFunc() {
    console.log('__log__');
    var lat = sessionStorage.getItem('lat');
    var lng = sessionStorage.getItem('lng');

    $('.filter-form').find(':checkbox:not(:checked)').attr('value', '0').prop('checked', true);
    var values = $('.filter-form').serialize();
    values = values.replace(/=on/g, "=true").replace(/=0/, "=false");

    $.ajax({
        url: "/ajax?filter&lat=" + lat + '&lng=' + lng,
        type: 'GET',
        cache: false,
        dataType: 'text',
        data: values,
        success: function(respond){
            console.log(respond);

        }
    });

    console.log(values);

    state = {
        MONFRY: false,
        SAT: false,
        SUN: false,
        filterFrom: "00-00",
        filterTo: "23-59",
        filterTimeFrom: "30min",
        sliderValues: [1],
        loader: true
    };
}

function searchFunc() {

}