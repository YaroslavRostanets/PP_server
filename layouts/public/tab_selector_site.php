<?php
/**
 * Created by PhpStorm.
 * User: Yaroslav
 * Date: 06.07.2018
 * Time: 21:28
 */
?>

<?php
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

<!-- Switcher -->
<button class="w3-button w3-teal w3-xlarge w3-right js-fast-ajax" onclick="openRightMenu()"><i class="spin theme-cl fa fa-cog" aria-hidden="true"></i></button>
<div class="w3-sidebar w3-bar-block w3-card-2 w3-animate-right" style="display:none;right:0;" id="rightMenu">
    <button onclick="closeRightMenu()" class="w3-bar-item w3-button w3-large theme-bg">Close &times;</button>
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
                                case 'FORBIDDEN_PAY':
                                    echo '<img src='. TEMPLATE . 'assets/img/thumb5.png >';
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
                            <div class="bot-info">
                                <span><?= rightTimeFormat($place['weekday_from']) ?> - <?= rightTimeFormat($place['weekday_to']) ?></span>
                                <span>(<?= rightTimeFormat($place['saturday_from']) ?> - <?= rightTimeFormat($place['saturday_to']) ?>)</span>
                                <span class="holiday"><?= rightTimeFormat($place['sunday_from']) ?> - <?= rightTimeFormat($place['sunday_to']) ?></span>
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
                            <a href="<?= $href ?>" class="light-gray-btn btn-square" data-placement="top" data-toggle="tooltip" title="" data-original-title="Edit Item">
                                <i class="fa fa-info-circle" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>

                    <? endforeach; ?>

                </div>
            </div>
            <div role="tabpanel" class="tab-pane tab-sel" id="filter-tab">
                <form class="filter-form">
                    <div class="filter-tab">

                        <div class="one-row">
                            <div class="one-row-in">
                                <div class="icon-cont">
                                    <i class="fa fa-calendar" aria-hidden="true"></i>
                                </div>
                                <div class="filt-block-info">
                                    <div class="label">Day:</div>
                                    <div class="bot-row">
                                        <label>
                                            <input data-styler type="checkbox" name="MONFRY" checked="checked">
                                            Mon-Fry
                                        </label>
                                        <label>
                                            <input data-styler type="checkbox" name="SAT">
                                            Sat
                                        </label>
                                        <label>
                                            <input data-styler type="checkbox" name="SUN" checked="checked">
                                            Sun
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
                                    <div class="label">Time:</div>
                                    <div class="bot-row">
                                        <div class="group">
                                            <div class="span">
                                                from
                                            </div>
                                            <input data-timepicker value="00:00" type="text" name="filterFrom">
                                        </div>
                                        <div class="group">
                                            <div class="span">to</div>
                                            <input data-timepicker value="23:59" type="text" name="filterTo">
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
                                <div class="filt-block-info">
                                    <div class="label">Hours:</div>
                                    <div class="bot">
                                        <div class="span">
                                            from <b class="js-filter-time-from-value">30m</b>
                                        </div>
                                        <div id="js-interval-slider"></div>
                                    </div>
                                    <input type="text" class="js-filter-time-from" name="filterTimeFrom">
                                </div>
                            </div>
                        </div>

                    </div>
                </form>

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
                                    <div class="label">Day:</div>
                                    <div class="bot-row">
                                        <label>
                                            <input style="display: block;" type="checkbox" name="MONFRY">
                                            Mon-Fry
                                        </label>
                                        <label>
                                            <input style="display: block;" type="checkbox" name="SAT">
                                            Sat
                                        </label>
                                        <label>
                                            <input style="display: block;" type="checkbox" name="SUN">
                                            Sun
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
                                    <div class="label">Time:</div>
                                    <div class="bot-row">
                                        <div class="group">
                                            <div class="span">
                                                from
                                            </div>
                                            <input data-timepicker value="00:00" type="text" name="filterFrom">
                                        </div>
                                        <div class="group">
                                            <div class="span">to</div>
                                            <input data-timepicker value="23:59" type="text" name="filterTo">
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
                                <div class="filt-block-info">
                                    <div class="label">Hours:</div>
                                    <div class="bot">
                                        <div class="span">
                                            from <b class="js-search-time-from-value">30m</b>
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
                                <div class="filt-block-info">
                                    <div class="label">Distance:</div>
                                    <div class="bot">
                                        <div class="span">
                                            from <b class="js-search-distance-value">2</b><b>km</b>
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

        </div>

        <div class="nav nav-tabs">
            <ul class="tab-selector nav nav-tabs">
                <li role="presentation" class="active js-tab-sel" data-tab="fast-parking-tab" data-act="FAST">
                    <a href="javascript:void(0);">
                        <i class="fa fa-rocket" aria-hidden="true"></i>
                        Fast parking
                    </a>
                </li>
                <li role="presentation" class="js-tab-sel" data-tab="filter-tab" data-act="FILTER">
                    <a href="javascript:void(0);">
                        <i class="fa fa-cogs" aria-hidden="true"></i>
                        Filter
                    </a>
                </li>
                <li role="presentation" class="js-tab-sel" data-tab="search-tab" data-act="SEARCH">
                    <a href="javascript:void(0);">
                        <i class="fa fa-search" aria-hidden="true"></i>
                        Search
                    </a>
                </li>

                <li role="presentation" class="js-tab-sel"
                    data-tab="search-tab-result"
                    data-act="SEARCH_RESULT"
                    style="display: none !important;">
                    <a href="javascript:void(0);">
                        <i class="fa fa-search" aria-hidden="true"></i>
                        Search result
                    </a>
                </li>

            </ul>
        </div>
    </div>
    <button class="js-red-btn" data-active="FAST">
        <div class="fast-parking-tab btn-contain">
            <i class="fa fa-refresh" aria-hidden="true"></i>
            Refresh
        </div>
        <div class="filter-tab btn-contain" style="display: none;">
            <i class="fa fa-check-square-o" aria-hidden="true"></i>
            Apply filter
        </div>
        <div class="search-tab btn-contain" style="display: none;">
            <i class="fa fa-search" aria-hidden="true"></i>
            Search
        </div>
        <div class="search-tab-result btn-contain" style="display: none;">
            <i class="fa fa-sign-out" aria-hidden="true"></i>
            New Search
        </div>
    </button>
</div>
<!-- /Switcher -->


<script src="<?= TEMPLATE ?>assets/plugins/nouislider/nouislider.min.js"></script>

<script>



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



    var intervalSlider = document.getElementById('js-interval-slider');

    noUiSlider.create(intervalSlider, {
        start: 0,
        step: 1,
        range: {
            'min': 0,
            'max': 7
        }
    });

    intervalSlider.noUiSlider.on('update', function(value){
        var index = parseInt(value[0]);
        var convertObj = {
            "0":"15min",
            "1":"30min",
            "2":"1h",
            "3":"2h",
            "4":"3h",
            "5":"5h",
            "6":"12h",
            "7":"24h"
        };

        $('.js-filter-time-from').val( convertObj[index] );
        $('.js-filter-time-from-value').text(convertObj[index]);
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
            "0":"15min",
            "1":"30min",
            "2":"1h",
            "3":"2h",
            "4":"3h",
            "5":"5h",
            "6":"12h",
            "7":"24h"
        };

        $('.js-search-time-from-value').text( convertObj[index] );
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