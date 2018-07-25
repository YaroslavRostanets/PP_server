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
                        <img src="<?= $user['picture'] ?>" class="img-responsive img-circle edit-avater js-change-ava" alt="">
                        <div class="upload-btn-wrapper">
                            <button class="btn theme-btn">Change Avatar</button>
                            <input type="file" multiple="multiple" accept=".txt,image/*" class="js-upload-ava" name="avatar">
                        </div>
                    </div>

                    <script>
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

                                        $('.js-change-ava').attr('src', imgSrc );
                                    }
                                    console.log(respond, status);
                                },

                                error: function (jqXHR, status, errorThrown) {
                                    console.log('ОШИБКА AJAX запроса: ' + status, jqXHR);
                                }

                            });
                        });
                    </script>

                    <h3><?= $user['givenName'] . ' ' . $user['familyName']?></h3>
                    <p><?= $user['email'] ?></p>
                </div>
                <form>
                    <div class="row mrg-r-10 mrg-l-10">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control js-name" value="<?= $user['givenName'] ?>">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Surname</label>
                                <input type="text" class="form-control js-surname" value="<?= $user['familyName'] ?>">
                            </div>
                        </div>
                        <input type="text" class="js-filename" disabled style="display: none;">
                    </div>
                </form>
            </div>
            <!-- End General Information -->

            <div class="text-center">
                <a href="#" class="btn theme-btn disabled js-update" title="Submit Listing">Update Profile</a>
            </div>
        </div>
    </div>
</section>

<script>
    $(document).ready(function () {
        var name = $('.js-name').val();
        var surname = $('.js-surname').val();

        $('.js-name, .js-surname').focusout(function(){
            if( $('.js-name').val() != name || $('.js-surname').val() != surname ){
                //$('.js-update').removeClass('disabled');

            } else {
                //$('.js-update').addClass('disabled');
            }
        });

        $('.js-upload-ava')
    })
</script>

<? include_once ROOT . "/layouts/public/footer_site.php" ?>