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
                <a href="#" class="btn theme-btn js-update disabled" title="Submit Listing">Update Profile</a>
            </div>
        </div>
    </div>
</section>

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
                        var imgSrc = window.location.origin + '/uploads/tmp_avatars/' +
                            respond.fileName + '.' + respond.format;

                        $('.js-change-ava, .js-avatar-img').css({
                            'background-image': 'url(' + imgSrc + ')'
                        });

                        $('.js-filename').val(respond.fileName + '.' + respond.format);
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
                        console.log(respond);
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