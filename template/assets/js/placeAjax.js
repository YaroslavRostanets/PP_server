/**
 * Created by Yaroslav on 01.08.2018.
 */
if(typeof window.map !== 'undefined'){
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

            infowindow = new google.maps.InfoWindow({
                maxWidth: 110
            });

            marker.addListener('click', function() {
                console.log('markerClick');
                var point = marker['placeInfo'];

                var lang = $('html').attr('lang');

                var href = '/' + lang + '/' + 'detail/' + (point['friendly_url'] ? point['friendly_url'] : point['id']);

                //var href = '<?= "/$language" ?>' + '/detail/' + (point['friendly_url'] ? point['friendly_url'] : point['id']);

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
                                    <a href="javascript:void(0);"
                                        onclick="addToFavorites( ${marker.placeInfo.id} );"
                                        class="std-btn ripple">
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

            });

            return marker;

        });

        markerCluster = new MarkerClusterer(map, markersArr,
            {imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'});

    };
}

$('.js-tab-sel[data-act=FAST]').on('click', function(){
    console.log('test');
    fastFunc();
});

$('.js-red-btn').on('click', function(){
    var act = $(this).attr('data-active');
    console.log(act);
    switch(act) {
        case 'FAST':
            fastFunc();
            break;
        case 'SEARCH':
            searchFunc();
            break;
        case 'SEARCH_RESULT':
            searchResultFunc();
            break;
    }
});


function fastFunc() {
    console.log('ajax');
    var lat = sessionStorage.getItem('lat');
    var lng = sessionStorage.getItem('lng');
    var lang = $('html').attr('lang');

    $.ajax({
        url: "/" + lang + "/ajax?fast&lat=" + lat + '&lng=' + lng,
        type: 'GET',
        cache: false,
        dataType: 'json',
        success: function(respond,status){

            if(status == 'success'){
                var markers = respond.places;
                $('#fast-parking-tab').html(respond.html);
                $('.fast-parking-list').mCustomScrollbar();
                for (var i = 0; i < markersArr.length; i++) {
                    google.maps.event.clearListeners(markersArr[i], 'click');
                    markersArr[i].setMap(null);
                }
                markerCluster.clearMarkers();
                markersArr = [];
                map.newMarkersResresh(respond.places);
                $('.fast-parking-list .js-nice-transition').on('click', function(e){
                    e.preventDefault();
                    var href = $(this).attr('href');
                    $('body').addClass('leave');
                    setTimeout(function(){
                        window.location.href = href;
                    },500);
                });

                $('.js-one-place').on('click', function(){
                    var markerId = $(this).attr('data-id');

                    for( var marker in markersArr ){
                        var selMarker = markersArr[marker];
                        if(markersArr[marker]['id'] == markerId){
                            google.maps.event.trigger(markersArr[marker], 'click');
                            map.setCenter(selMarker.position);
                            map.setZoom(19);
                            break;
                        }
                    }
                });

            }
        }
    });

}

function searchFunc() {
    var lat = sessionStorage.getItem('lat');
    var lng = sessionStorage.getItem('lng');
    var lang = $('html').attr('lang');

    $('.search-tab-form').find(':checkbox:not(:checked)').attr('value', '0').prop('checked', true);
    var valuesArray = $('.search-tab-form').serializeArray();
    valuesArray.forEach(function(item,i){
        if(item.value == "on"){
            item.value = 'true';
        } else if(item.value == "0") {
            item.value = 'false';
        }
    });
    var values = $.param(valuesArray);

    $('.search-tab-form').find(':checkbox').each(function(i,item){
        if($(item).attr('value') === '0'){
            $(item).removeAttr('value');
            $(item).prop('checked', false);
            $(item).trigger('refresh');
        }

    });

    $.ajax({
        url: "/" + lang + "/ajax?search&lat=" + lat + '&lng=' + lng,
        type: 'GET',
        cache: false,
        dataType: 'json',
        data: values,
        success: function(respond, status){
            console.log(respond);
            if(status == 'success') {
                $('.search-result-list').html(respond.template);
                $('.fast-parking-list').mCustomScrollbar();
                $('.js-tab-sel[data-tab=search-tab-result]').click();
                $('.js-tab-sel[data-tab=search-tab]').addClass('active');

                for (var i = 0; i < markersArr.length; i++) {
                    markersArr[i].setMap(null);
                }
                markerCluster.clearMarkers();
                markersArr = [];
                map.newMarkersResresh(JSON.parse(respond.places));
                $('.fast-parking-list .js-nice-transition').on('click', function(e){
                    e.preventDefault();
                    var href = $(this).attr('href');
                    $('body').addClass('leave');
                    setTimeout(function(){
                        window.location.href = href;
                    },500);
                });

                $('.js-one-place').on('click', function(){
                    var markerId = $(this).attr('data-id');

                    for( var marker in markersArr ){
                        var selMarker = markersArr[marker];
                        if(markersArr[marker]['id'] == markerId){
                            google.maps.event.trigger(markersArr[marker], 'click');
                            map.setCenter(selMarker.position);
                            map.setZoom(19);
                            break;
                        }
                    }
                });
            }
        }
    });
}

function searchResultFunc() {
    $('.js-tab-sel[data-tab=search-tab]').click();
}