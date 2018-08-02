<?php
/**
 * Created by PhpStorm.
 * User: Yaroslav
 * Date: 23.07.2018
 * Time: 21:05
 */
?>
<? include_once ROOT . "/layouts/public/header_site.php" ?>

<section class="title-transparent page-title" style="background:url(<?= TEMPLATE ?>/assets/img/helsinki.jpg);">
    <div class="container">
    </div>
</section>
<section class="padd-0">
    <div class="container">
        <div class="col-md-10 translateY-60 col-sm-12 col-md-offset-1">
            <!-- General Information -->
            <div class="add-listing-box edit-info mrg-bot-25 padd-bot-30 padd-top-25">
                <div class="listing-box-header">
                    <div class="avater-box">
                        <div style="background-image: url(<?= $user['picture'] ?>)"
                             class="img-responsive img-circle edit-avater js-change-ava">
                        </div>
                        <div class="upload-btn-wrapper">
                            <button class="btn theme-btn">Change Avatar</button>
                            <input type="file" multiple="multiple" accept=".txt,image/*" class="js-upload-ava" name="avatar">
                        </div>
                    </div>
                    <div class="js-avatar-help-block" style="display: none;"></div>
                    <h3><?= $user['givenName'] . ' ' . $user['familyName']?></h3>
                    <p><?= $user['email'] ?></p>
                </div>
                <form id="user-form-ajax">
                    <div class="row mrg-r-10 mrg-l-10">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control js-name" name="name" value="<?= $user['givenName'] ?>">
                                <div class="help-block"></div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Surname</label>
                                <input type="text" class="form-control js-surname" name="surname" value="<?= $user['familyName'] ?>">
                                <div class="help-block"></div>
                            </div>
                        </div>
                        <input type="text" class="js-filename" name="filename" style="display: none;">
                    </div>
                </form>
            </div>
            <!-- End General Information -->

            <div class="text-center">
                <a href="javaascript:void(0);" class="btn theme-btn js-update disabled" title="Submit Listing">Update Profile</a>
            </div>
        </div>
    </div>
</section>

<!-- Данные изменены Модалка -->
    <div id="profile-update" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" style="color: transparent">.</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="booking-confirm padd-top-30 padd-bot-30">
                        <i class="fa fa-check" aria-hidden="true"></i>
                        <h2 class="mrg-top-15">Готово!</h2>
                        <p>Данные профиля изменены</p>
                        <a href="<?= "/$language" ?>" class="btn theme-btn-trans mrg-top-20">На главную</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- конец Данные изменены -->

<script>
    $(document).ready(function () {
        var name = $('.js-name').val();
        var surname = $('.js-surname').val();

        $('.js-name, .js-surname').on('input',function(){
            if( $('.js-name').val() != name || $('.js-surname').val() != surname ){
                $('.js-update').removeClass('disabled');
            } else {
                $('.js-update').addClass('disabled');
            }
        });

        $('.js-name, .js-surname').focusout(function(){

           var self = $(this);
           var value = $(this).val();

            $.ajax({
                url: '/profile/ajax?' + $(this).attr('name') + '=' + value,
                type: 'GET',
                cache: false,
                dataType: 'json',
                success: function (respond, status, jqXHR) {
                    if(status != 'success') return false;

                    if( Number(respond.errors) ){
                        console.log(respond);
                        $('.js-update').addClass('disabled');
                        self.closest('.form-group').addClass('has-error');
                        self.closest('.form-group').find('.help-block').text(respond.textError);
                    } else {
                        $('.js-update').removeClass('disabled');
                        self.closest('.form-group').removeClass('has-error');
                        self.closest('.form-group').find('.help-block').text('');
                    }
                },

                error: function (jqXHR, status, errorThrown) {
                    console.log('ОШИБКА AJAX запроса: ' + status, jqXHR);
                }

            });
        });

        $('input[type=file]').on('change', function(){

            var file_data = this.files[0];
            var form_data = new FormData();

            form_data.append('avatar', file_data);

            $.ajax({
                url: '?upload-ava',
                type: 'POST', // важно!
                data: form_data,
                cache: false,
                dataType: 'json',
                processData: false,
                contentType: false,
                success: function (respond, status, jqXHR) {
                    if(status == 'success'){
                        console.log(respond);
                        if( Number(respond.errors) ){
                            $('.js-avatar-help-block').text(respond.errorText).fadeIn(100);
                        } else {
                            var imgSrc = window.location.origin + '/uploads/tmp_avatars/' +
                                respond.fileName + '.' + respond.format;

                            $('.js-change-ava, .js-avatar-img').css({
                                'background-image': 'url(' + imgSrc + ')'
                            });

                            $('.js-filename').val(respond.fileName + '.' + respond.format);

                            $('.js-avatar-help-block').text('').fadeOut(100);
                        }
                    }

                    $('.js-name, .js-surname').focusout();

                },

                error: function (jqXHR, status, errorThrown) {
                    console.log('ОШИБКА AJAX запроса: ' + status, jqXHR);
                }

            });
        });

        $('.js-update').on('click', function(){
           if( !$(this).hasClass('disabled') ){
               console.log( $("#user-form-ajax").serialize() );
               $.ajax({
                   url: '?profile-update',
                   type: 'POST',
                   data: $("#user-form-ajax").serialize(),
                   dataType: 'html',
                   success: function (respond, status, jqXHR) {
                       $('#profile-update').modal();
                   },

                   error: function (jqXHR, status, errorThrown) {
                       console.log('ОШИБКА AJAX запроса: ' + status, jqXHR);
                   }

               });
           }
        });

    })
</script>

<? include_once ROOT . "/layouts/public/footer_site.php" ?>