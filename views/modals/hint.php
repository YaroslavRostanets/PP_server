<?php
/**
 * Created by PhpStorm.
 * User: Yaroslav
 * Date: 06.08.2018
 * Time: 19:15
 */

?>

<div class="hint js-hint animated" style="display: none;">
    <a class="js-close-hint">
        ×
    </a>
    <div class="hint-content">
        <?= $context ?>
        <img class="anim-hint" src="<?= TEMPLATE . 'assets/img/draggable.gif' ?>" alt="anim">
    </div>
</div>
<script>
    $(window).load(function(){
        setTimeout(function(){
            $('.js-hint').attr('style','').addClass('fadeInDown');
        }, 500);
    });
    $(document).ready(function(){
        $('.js-close-hint').on('click', function(){
            $(this).closest('.js-hint').removeClass('animated fadeInDown').fadeOut('150', function(){
//                  $(this).remove();
            }) ;
        });
    });
</script>
