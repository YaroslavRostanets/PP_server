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

    $('.js-tab-sel').on('click', function(){
        var id = $(this).attr('data-tab');
        $('.tab-sel').hide();
        $('#' + id).fadeIn(100);
        $('.btn-contain').hide();
        $('.js-red-btn').find('.' + id).fadeIn();

        $(this).siblings().removeClass('active');
        $(this).addClass('active');
    });

});
