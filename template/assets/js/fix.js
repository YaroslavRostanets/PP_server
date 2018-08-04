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


    $('.js-user-auth-wrap').on('click', function(){
       if($(this).hasClass('open')){
           $(this).find('.profile-menu').fadeOut(100);
       } else {
           $(this).find('.profile-menu').fadeIn(100);
       }
    });

    $(document).mouseup(function (e) {
        var container = $('.js-user-auth-wrap');
        if (container.has(e.target).length === 0){
            container.removeClass('open');
            container.find('.profile-menu').hide();
        }
    });

    $('.js-show-favorites').on('click', function(){
       console.log('favorites');
        $.ajax({
            url: "/favorites?get-list-modal",
            type: 'GET',
            cache: false,
            dataType: 'html',
            success: function(respond,status){
                $('#favorites-modal').remove();
                $('body').append(respond);
                $('#favorites-modal').modal();

                $('.js-remove-favorite').on('click', function(){
                    var id = $(this).attr('data-id');
                    var item =  $(this).closest('.item');
                    $.ajax({
                        url: "/favorites?remove_from_favorites=" + id,
                        type: 'GET',
                        cache: false,
                        dataType: 'json',
                        success: function(respond,status){
                            console.log(respond);
                            if(respond.countFavorites){
                                item.fadeOut(300, function(){
                                    $('.js-show-favorites span').text(respond.countFavorites);
                                    $(this).remove();
                                });

                            } else {
                                $('#favorites-modal .favorites-cont').remove();
                                $('#favorites-modal .modal-body').html(respond.html);
                                $('.js-show-favorites span').remove();
                            }

                        }
                    });
                });
            }
        });
    });

});
