<?php
/**
 * Created by PhpStorm.
 * User: Yaroslav
 * Date: 07.08.2018
 * Time: 14:14
 */
?>

<div id="save-place" class="modal fade" tabindex="-1" role="dialog" style="display: none;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="color: transparent">.</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="booking-confirm padd-top-30 padd-bot-30">

                    <h2 class="mrg-top-15" >
                        <i class="fa fa-floppy-o" aria-hidden="true"></i>
                        Парковка сохранена
                    </h2>
                    <p>
                        Она появится в системе после проверки модератором.
                    </p>
                    <a href="/<?= $language ?>"
                       class="btn theme-btn-trans mrg-top-20">На главную</a>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('#save-place').on('hidden.bs.modal', function () {
        window.location.href = "/<?= $language ?>";
    });
</script>