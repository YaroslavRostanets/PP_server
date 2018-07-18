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
            return "~<b>$dist</b> min";
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
<button class="w3-button w3-teal w3-xlarge w3-right" onclick="openRightMenu()"><i class="spin theme-cl fa fa-cog" aria-hidden="true"></i></button>
<div class="w3-sidebar w3-bar-block w3-card-2 w3-animate-right" style="display:none;right:0;" id="rightMenu">
    <button onclick="closeRightMenu()" class="w3-bar-item w3-button w3-large theme-bg">Close &times;</button>
    <div class="tab style-2" role="tabpanel">

        <div class="tab-content tabs">
            <div role="tabpanel" class="tab-pane fade in active" id="home2">
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
                            <a href="#" class="light-gray-btn btn-square" data-placement="top" data-toggle="tooltip" title="" data-original-title="Edit Item">
                                <i class="fa fa-info-circle" aria-hidden="true"></i>
                            </a>
                            <!--<a href="#" class="theme-btn btn-square" data-toggle="tooltip" title="" data-original-title="Delete Item"><i class="ti-trash"></i></a>-->
                        </div>
                    </div>

                    <? endforeach; ?>

                </div>
            </div>
            <div role="tabpanel" class="tab-pane fade" id="profile2">
                <form>
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
                                            <input data-styler type="checkbox" name="MON_FRY">
                                            Mon-Fry
                                        </label>
                                        <label>
                                            <input data-styler type="checkbox" name="SAT">
                                            Sat
                                        </label>
                                        <label>
                                            <input data-styler type="checkbox" name="SUN">
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
                                            <input data-timepicker value="00:00" type="text">
                                        </div>
                                        <div class="group">
                                            <div class="span">to</div>
                                            <input data-timepicker value="23:59" type="text">
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
            <div role="tabpanel" class="tab-pane fade" id="messages2">
                <form>
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
                                            <input data-styler type="checkbox" name="MON_FRY">
                                            Mon-Fry
                                        </label>
                                        <label>
                                            <input data-styler type="checkbox" name="SAT">
                                            Sat
                                        </label>
                                        <label>
                                            <input data-styler type="checkbox" name="SUN">
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
                                            <input data-timepicker value="00:00" type="text">
                                        </div>
                                        <div class="group">
                                            <div class="span">to</div>
                                            <input data-timepicker value="23:59" type="text">
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
        </div>

        <div class="nav nav-tabs" role="tablist">
            <ul class="tab-selector nav nav-tabs" role="tablist">
                <li role="presentation" class="active">
                    <a href="#home2" aria-controls="home2" role="tab" data-toggle="tab" aria-expanded="false">
                        <i class="fa fa-rocket" aria-hidden="true"></i>
                        Fast parking
                    </a>
                </li>
                <li role="presentation">
                    <a href="#profile2" aria-controls="profile2" role="tab" data-toggle="tab" aria-expanded="true">
                        <i class="fa fa-cogs" aria-hidden="true"></i>
                        Filter
                    </a>
                </li>
                <li role="presentation">
                    <a href="#messages2" aria-controls="messages2" role="tab" data-toggle="tab" aria-expanded="false">
                        <i class="fa fa-search" aria-hidden="true"></i>
                        Search
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <button class="js-red-btn">
        <i class="fa fa-refresh" aria-hidden="true"></i>
        Refresh
    </button>
</div>
<!-- /Switcher -->