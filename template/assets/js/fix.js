/**
 * Created by Yaroslav on 13.07.2018.
 */

$(document).ready(function(){
   $('[data-styler]').styler();

   $('[data-timepicker]').bootstrapMaterialDatePicker({
       date: false,
       format : 'HH:mm',
       change: function(event, date){
          console.log(event,date);
       },
       dateSelected: function(event, date){
           console.log(event,date);
       }
   });


    var intervalSlider = document.getElementById('js-interval-slider');

    noUiSlider.create(intervalSlider, {
        start: 0,
        step: 1,
        range: {
            'min': 0,
            'max': 7
        }
    });

    intervalSlider.noUiSlider.on('update', function(value){
        var index = parseInt(value[0]);
        var convertObj = {
            "0":"15min",
            "1":"30min",
            "2":"1h",
            "3":"2h",
            "4":"3h",
            "5":"5h",
            "6":"12h",
            "7":"24h"
        };

        $('.js-filter-time-from').val( convertObj[index] );
        $('.js-filter-time-from-value').text(convertObj[index]);
    });

    var intervalSearchSlider = document.getElementById('js-search-interval-slider');

    noUiSlider.create(intervalSearchSlider, {
        start: 0,
        step: 1,
        range: {
            'min': 0,
            'max': 7
        }
    });

    intervalSearchSlider.noUiSlider.on('update', function(value){
        var index = parseInt(value[0]);
        var convertObj = {
            "0":"15min",
            "1":"30min",
            "2":"1h",
            "3":"2h",
            "4":"3h",
            "5":"5h",
            "6":"12h",
            "7":"24h"
        };

        $('.js-search-time-from-value').text( convertObj[index] );
        $('.js-search-time-from').val(convertObj[index]);
    });

    var distanceSearchSlider = document.getElementById('js-search-distance-slider');

    noUiSlider.create(distanceSearchSlider, {
        start: 0,
        step: 1,
        range: {
            'min': 0,
            'max': 8
        }
    });

    distanceSearchSlider.noUiSlider.on('update', function(value){
        var index = parseInt(value[0]);
        var convertObj = {
            "0":"2",
            "1":"4",
            "2":"6",
            "3":"8",
            "4":"10",
            "5":"12",
            "6":"14",
            "7":"16",
            "8":"18",
            "9":"19",
            "10":"20"
        };

        $('.js-search-distance').val( convertObj[index] );
        $('.js-search-distance-value').text( convertObj[index]);
    });

    $('.js-toggle-lang').on('click', function(){
        var wrap = $(this).closest('.dropdown');

        if( wrap.hasClass('open') ){
            wrap.removeClass('open');
            wrap.find('.dropdown-cont').hide();
        } else {
            wrap.addClass('open');
            wrap.find('.dropdown-cont').show();
        }

    });

    $(document).mouseup(function (e) {
        var container = $(".js-toggle-lang").closest('.dropdown');
        if (container.has(e.target).length === 0){
            container.removeClass('open');
            container.find('.dropdown-cont').hide();
        }
    });

    $('.js-one-place').on('click', function(){
       var markerId = $(this).attr('data-id');

       for( var marker in markersArr ){
           var selMarker = markersArr[marker];
           if(markersArr[marker]['id'] == markerId){
               google.maps.event.trigger(markersArr[marker], 'click');
               map.setCenter(selMarker.position);
               map.setZoom(16);
               break;
           }
       }

    });

});
