<?php
/**
 * Created by PhpStorm.
 * User: Yaroslav
 * Date: 06.07.2018
 * Time: 21:28
 */
?>

<?php
include_once ROOT . "/localization/localization.php";

?>
<?php
    function rightTimeFormat($time){
        $arr = explode(":", $time);
        return $arr[0]; //Возвращает часы
    }

    function rightDistance($dist) {
        $dist = floatval($dist);
        if($dist > 1){
            return "~<b>$dist</b> ";
        } else {
            $dist = $dist * 1000;
            return "~<b>$dist</b> ";
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

<!-- Switcher -->
<button class="w3-button w3-teal w3-xlarge w3-right js-fast-ajax ripple" onclick="openRightMenu()"><i class="spin theme-cl fa fa-cog" aria-hidden="true"></i></button>
<div class="w3-sidebar w3-bar-block w3-card-2 w3-animate-right app-bar" style="display:none;right:0;" id="rightMenu">
    <button onclick="closeRightMenu()" class="w3-bar-item w3-button w3-large theme-bg"> <?= $lang[$language]['close'] ?> &times;</button>
    <div class="tab style-2" role="tabpanel">

        <div class="tab-content tabs">
            <div role="tabpanel" class="tab-pane fade in active tab-sel" id="fast-parking-tab">
                <div class="fast-parking-list">

                    <? foreach ($places as $place) :?>

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
                            }
                            ?>
                        </div>
                        <div class="snall-list-info">
                            <div class="top-info">
                                <span>
                                    <?= rightInterval($place['time_interval']) ?>
                                </span>
                                <span>
                                    <?= $lang[$language]['distance'] ?>:
                                    <?= rightDistance($place['geodist_pt']) ?>
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
                                $href = $language . '/detail/' . $place['friendly_url'];
                            } else {
                                $href = $language . '/detail/' . $place['id'];
                            }
                            ?>
                            <a href="/<?= $href ?>" hreflang="<?= $language ?>" class="light-gray-btn btn-square js-nice-transition" data-placement="top" data-toggle="tooltip" title="" data-original-title="Edit Item">
                                <i class="fa fa-info-circle" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>

                    <? endforeach; ?>

                </div>
            </div>
            <div role="tabpanel" class="tab-pane tab-sel" id="search-tab">
                <form class="search-tab-form">
                    <div class="search-tab">
                        <div class="one-row">
                            <div class="one-row-in">
                                <div class="icon-cont">
                                    <i class="fa fa-calendar" aria-hidden="true"></i>
                                </div>
                                <div class="filt-block-info">
                                    <div class="label"><?= $lang[$language]['day'] ?>:</div>
                                    <div class="bot-row">
                                        <label>
                                            <input type="checkbox" data-styler name="MONFRY" checked="checked">
                                            <?= $lang[$language]['mon-fry'] ?>
                                        </label>
                                        <label>
                                            <input type="checkbox" data-styler name="SAT" checked="checked">
                                            <?= $lang[$language]['sat'] ?>
                                        </label>
                                        <label>
                                            <input type="checkbox" data-styler name="SUN" checked="checked">
                                            <?= $lang[$language]['sun'] ?>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="one-row">
                            <div class="one-row-in">
                                <div class="icon-cont">
                                    <i class="fa fa-clock-o" aria-hidden="true"></i>
                                </div>
                                <div class="filt-block-info">
                                    <div class="label">
                                        Когда поставить машину?
                                    </div>
                                    <div class="bot-row">
                                        <div class="group">
                                            <input data-timepicker value="00:00" type="text" name="filterFrom">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="one-row">
                            <div class="one-row-in">
                                <div class="icon-cont">
                                    <i class="fa fa-hourglass-half" aria-hidden="true"></i>
                                </div>
                                <div class="filt-block-info slider-block-info">
                                    <div class="label">
                                        Сколько стоять?
                                    </div>
                                    <div class="bot">
                                        <div class="span">
                                            <b class="js-search-time-from-value">30m</b>
                                        </div>
                                        <div id="js-search-interval-slider"></div>
                                    </div>
                                    <input type="text" class="js-search-time-from" name="filterTimeFrom">
                                </div>
                            </div>
                        </div>

                        <div class="one-row">
                            <div class="one-row-in">
                                <div class="icon-cont">
                                    <i class="fa fa-car" aria-hidden="true"></i>
                                </div>
                                <div class="filt-block-info slider-block-info">
                                    <div class="label"><?= $lang[$language]['distance'] ?>:</div>
                                    <div class="bot">
                                        <div class="span">
                                            <?= $lang[$language]['from'] ?> <b class="js-search-distance-value">2</b><b><?= $lang[$language]['km'] ?></b>
                                        </div>
                                        <div id="js-search-distance-slider"></div>
                                    </div>
                                    <input type="text" class="js-search-distance" name="distance">
                                </div>
                            </div>
                        </div>

                    </div>
                </form>
            </div>

            <div role="tabpanel" class="tab-pane tab-sel" id="search-tab-result">
                <div class="search-result-list"></div>
            </div>

            <div role="tabpanel" class="tab-pane tab-sel" id="all-tab-places" style="display: none !important;">
                <div class="all-places-list">

                    <? foreach ($allPlacesForSEO as $place) :?>

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
                        }
                        ?>
                    </div>
                    <div class="snall-list-info">
                        <div class="top-info">
                                <span>
                                    <?= rightInterval($place['time_interval']) ?>
                                </span>
                            <span>
                                <?= $place['address_'.$language] ?>
                            </span>
                        </div>
                    </div>
                    <div class="small-list-action">
                        <?php
                        if( $place['friendly_url'] != '' ){
                            $href = $language . '/detail/' . $place['friendly_url'];
                        } else {
                            $href = $language . '/detail/' . $place['id'];
                        }
                        ?>
                        <a href="/<?= $href ?>" hreflang="<?= $language ?>" class="light-gray-btn btn-square js-nice-transition" data-placement="top" data-toggle="tooltip" title="" data-original-title="Edit Item">
                            <i class="fa fa-info-circle" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>

                <? endforeach; ?>
                </div>
            </div>

        </div>

        <div class="nav nav-tabs">
            <ul class="tab-selector nav nav-tabs">
                <li role="presentation" class="active js-tab-sel ripple" data-tab="fast-parking-tab" data-act="FAST">
                    <a href="javascript:void(0);">
                        <i class="fa fa-rocket" aria-hidden="true"></i>
                        <span>
                            <?= $lang[$language]['fast_parking'] ?>
                        </span>
                    </a>
                </li>

                <li role="presentation" class="js-tab-sel ripple" data-tab="search-tab" data-act="SEARCH">
                    <a href="javascript:void(0);">
                        <i class="fa fa-search" aria-hidden="true"></i>
                        <span>
                            <?= $lang[$language]['search'] ?>
                        </span>
                    </a>
                </li>

                <li role="presentation" class="js-tab-sel"
                    data-tab="search-tab-result"
                    data-act="SEARCH_RESULT"
                    style="display: none !important;">
                    <a href="javascript:void(0);">
                        <i class="fa fa-search" aria-hidden="true"></i>
                        <span>
                            <?= $lang[$language]['search_result'] ?>
                        </span>
                    </a>
                </li>

                <li role="presentation" class="js-tab-sel"
                    data-tab="all-tab-places"
                    data-act="ALL_PLACES"
                    style="display: none !important;">
                    <a href="javascript:void(0);">
                        All
                    </a>
                </li>

            </ul>
        </div>
    </div>
    <button class="js-red-btn ripple" data-active="FAST">
        <div class="fast-parking-tab btn-contain">
            <i class="fa fa-refresh" aria-hidden="true"></i>
            <?= $lang[$language]['refresh'] ?>
        </div>
        <div class="search-tab btn-contain" style="display: none;">
            <i class="fa fa-search" aria-hidden="true"></i>
            <?= $lang[$language]['search'] ?>
        </div>
        <div class="search-tab-result btn-contain" style="display: none;">
            <i class="fa fa-sign-out" aria-hidden="true"></i>
            <?= $lang[$language]['new_search'] ?>
        </div>
    </button>
</div>
<!-- /Switcher -->


<script src="<?= TEMPLATE ?>assets/plugins/nouislider/nouislider.min.js"></script>

<script>

    var lang = {
      'min': '<?= $lang[$language]['min'] ?>',
      'h': '<?= $lang[$language]['h'] ?>',
      'km': '<?= $lang[$language]['km'] ?>'
    };

    $('.js-tab-sel').on('click', function(){
        var id = $(this).attr('data-tab');
        var act = $(this).attr('data-act');
        $('.tab-sel').hide();
        $('#' + id).fadeIn(100);
        $('.btn-contain').hide();
        $('.js-red-btn').find('.' + id).fadeIn();
        $('.js-red-btn').attr('data-active', act);

        $(this).siblings().removeClass('active');
        $(this).addClass('active');
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
            "0":"15",
            "1":"30",
            "2":"60",
            "3":"120",
            "4":"180",
            "5":"300",
            "6":"720",
            "7":"1440"
        };

        $('.js-search-time-from-value').text( function(){
            console.log('lala');
            return (convertObj[index] >= 60) ? convertObj[index] / 60 + lang.h : convertObj[index] + lang.min;
            /*$()
            convertObj[index]*/
        });
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

    $()

</script>