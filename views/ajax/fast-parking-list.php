<?php
/**
 * Created by PhpStorm.
 * User: Yaroslav
 * Date: 01.08.2018
 * Time: 20:33
 */

function rightTimeFormat($time){
    $arr = explode(":", $time);
    return $arr[0]; //Возвращает часы
}

function rightDistance($dist) {
    $dist = floatval($dist);
    if($dist > 1){
        return "~<b>$dist</b> km";
    } else {
        $dist = $dist * 1000;
        return "~<b>$dist</b> m";
    }
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

?>

<div class="fast-parking-list">
                    <? foreach ($context['places'] as $place) :?>

    <div data-id=<?= $place['id'] ?> class="small-listing-box light-gray js-one-place">
    <div class="small-list-img">
        <?
        switch ($place['kind_of_place']) {
            case 'FREE':
                echo '<img src='. TEMPLATE . 'assets/img/thumb1.png >';
                break;
            case 'PAY':
                echo '<img src='. TEMPLATE . 'assets/img/thumb2.png >';
                break;
            case 'FORBIDDEN':
                echo '<img src='. TEMPLATE . 'assets/img/thumb3.png >';
                break;
            case 'FORBIDDEN_YELLOW':
                echo '<img src='. TEMPLATE . 'assets/img/thumb4.png >';
                break;
            case 'FORBIDDEN_PAY':
                echo '<img src='. TEMPLATE . 'assets/img/thumb5.png >';
                break;
            case 'FORBIDDEN_YELLOW_PAY':
                echo '<img src='. TEMPLATE . 'assets/img/thumb6.png >';
                break;
        }
        ?>
    </div>
    <div class="snall-list-info">
        <div class="top-info">
                                <span>
                                    <?= rightInterval($place['time_interval']) ?>
                                </span>
            <span>
                                    Distance: <?= rightDistance($place['geodist_pt']) ?>
                                </span>
        </div>
        <table width="90%" class="bot-info">
            <tr>
                <td width="30%"><?= rightTimeFormat($place['weekday_from']) ?> - <?= rightTimeFormat($place['weekday_to']) ?></td>
                <td width="40%">(<?= rightTimeFormat($place['saturday_from']) ?> - <?= rightTimeFormat($place['saturday_to']) ?>)</td>
                <td width="30%" class="holiday"><?= rightTimeFormat($place['sunday_from']) ?> - <?= rightTimeFormat($place['sunday_to']) ?></td>
            </tr>
        </table>
    </div>
    <div class="small-list-action">
        <?php
            if( $place['friendly_url'] != '' ){
                $href = $context['language'] . '/detail/' . $place['friendly_url'];
            } else {
                $href = $context['language'] . '/detail/' . $place['id'];
            }
        ?>
        <a href="/<?= $href ?>" hreflang="<?= $language ?>" class="light-gray-btn btn-square js-nice-transition"
           data-placement="top"
           data-toggle="tooltip"
           title=""
           data-original-title="Edit Item">
            <i class="fa fa-info-circle" aria-hidden="true"></i>
        </a>
    </div>
    </div>

<? endforeach; ?>

</div>

