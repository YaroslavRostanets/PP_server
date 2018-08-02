<?php
/**
 * Created by PhpStorm.
 * User: Yaroslav
 * Date: 29.07.2018
 * Time: 21:00
 */

function rightTimeFormat($time){
    $arr = explode(":", $time);
    return $arr[0]; //Возвращает часы
}

function rightInterval($min) {
    if($min >= 60) {
        return floor( ($min / 60) ) . " h";
    } elseif ($min == 0){
        return "-";
    } else {
        return floor( $min ) . " min";
    }
}

function rightDistance($dist) {
    $dist = floatval($dist);
    if($dist > 1){
        return "~<b>$dist</b> km";
    } else {
        $dist = $dist * 1000;
        return "~<b>$dist</b> min";
    }
}


?>
<!-- модалка Избранное -->
<div class="modal" id="favorites-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fa fa-star-o" aria-hidden="true"></i>
                    Избранное
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <? if( count($list) ) : ?>

                <ul class="favorites-cont slide-list">
                    <? foreach ($list as $key => $value): ?>
                        <li class="item">
                            <div class="blog-list-img">
                                <?php
                                switch ( $value['kind_of_place'] ) {
                                    case "FREE":
                                        echo '<img class="img-responsive" src="' . TEMPLATE .'img/thumb1.png" >';
                                        break;
                                    case "PAY":
                                        echo '<img class="img-responsive" src="' . TEMPLATE .'img/thumb2.png" >';
                                        break;
                                    case "FORBIDDEN":
                                        echo '<img class="img-responsive" src="' . TEMPLATE .'img/thumb3.png" >';
                                        break;
                                    case "FORBIDDEN_YELLOW":
                                        echo '<img class="img-responsive" src="' . TEMPLATE .'img/thumb4.png" >';
                                        break;
                                    case "FORBIDDEN_PAY":
                                        echo '<img class="img-responsive" src="' . TEMPLATE .'img/thumb5.png" >';
                                        break;
                                }
                                ?>
                            </div>
                            <div class="blog-list-info">
                                <div class="left-part">
                                    <div class="top-info">
                                <span>
                                    <?= rightInterval($value['time_interval']) ?>
                                </span>
                                        <span>
                                    Distance: <?= rightDistance($value['geodist_pt']) ?>
                                </span>
                                    </div>
                                    <div class="bot-info">
                                        <span><?= rightTimeFormat($value['weekday_from']) ?> - <?= rightTimeFormat($value['weekday_to']) ?></span>
                                        <span>(<?= rightTimeFormat($value['saturday_from']) ?> - <?= rightTimeFormat($value['saturday_to']) ?>)</span>
                                        <span class="holiday"><?= rightTimeFormat($value['sunday_from']) ?> - <?= rightTimeFormat($value['sunday_to']) ?></span>
                                    </div>

                                    <? if(isset ($value['address_' + $language]) ) :?>
                                        <div class="address">
                                            <i class="fa fa-map-marker" aria-hidden="true"></i>
                                            <?= $value['address_' + $language] ?>
                                        </div>
                                    <? endif; ?>
                                </div>
                                <div class="btn-part">
                                    <a href="<?= "/$language/detail/$value[place_id]" ?>"
                                       type="button" class="btn btn-info">
                                        <i class="fa fa-info-circle" aria-hidden="true"></i>
                                    </a>
                                    <a data-id="<?= $value['id'] ?>" href="javascript:void(0);"
                                       type="button" class="btn btn-danger js-remove-favorite">
                                        <i class="fa fa-times" aria-hidden="true"></i>
                                    </a>
                                </div>
                            </div>
                        </li>
                    <? endforeach; ?>
                </ul>

                <? else : ?>

                <div class="booking-confirm warning padd-top-30 padd-bot-30">
                    <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                    <p>У Вас нет парковок в Избранном</p>
                </div>

                <? endif; ?>

            </div>
        </div>
    </div>
</div>

<!-- конец модалка Избранное -->
