<?php
/**
 * Created by PhpStorm.
 * User: Yaroslav
 * Date: 20.07.2018
 * Time: 0:01
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

?>
<? include_once ROOT . "/layouts/public/header_site.php" ?>

<section class="detail-section" style="background:url(<?= TEMPLATE . "assets/img/slider-3.jpg" ?>);">
    <div class="overlay" style="background-color: rgb(36, 36, 41); opacity: 0.5;"></div>
    <div class="profile-cover-content">
        <div class="container">
            <div class="cover-buttons">
                <ul>
                    <? if($place['address_'.$language] != '') :?>
                        <li>
                            <div class="buttons medium button-plain ">
                                <i class="fa fa-map-marker"></i><?= $place['address_'.$language] ?>
                            </div>
                        </li>
                    <? endif; ?>
                    <li>
                        <div class="inside-rating buttons listing-rating theme-btn button-plain">
                            <span class="value"><?= $place['geodist_pt'] ?></span><sup class="out-of">km</sup>
                        </div>
                    </li>
                    <li>
                        <a href="#" class="buttons btn-outlined medium get-direct">
                            <i class="fa fa-car" aria-hidden="true"></i>Проложить маршрут</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="buttons btn-outlined add-to-wishlist">
                            <i class="fa fa-star-o"></i><span class="hidden-xs">В избранное</span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="listing-owner hidden-xs hidden-sm">
                <div class="listing-owner-detail">
                    <?
                    switch ($place['kind_of_place']) {
                        case 'FREE':
                            echo '<img class="sign" src='. TEMPLATE . 'assets/img/thumb1.png >';
                            break;
                        case 'PAY':
                            echo '<img class="sign" src='. TEMPLATE . 'assets/img/thumb2.png >';
                            break;
                        case 'FORBIDDEN':
                            echo '<img class="sign" src='. TEMPLATE . 'assets/img/thumb3.png >';
                            break;
                        case 'FORBIDDEN_YELLOW':
                            echo '<img class="sign" src='. TEMPLATE . 'assets/img/thumb4.png >';
                            break;
                        case 'FORBIDDEN_PAY':
                            echo '<img class="sign" src='. TEMPLATE . 'assets/img/thumb5.png >';
                            break;
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="list-detail">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-sm-8">
                <div class="detail-wrapper">
                    <div class="detail-wrapper-header">
                        <h4>Location</h4>
                    </div>
                    <div class="detail-wrapper-body">
                        <? if( $place['address_'.$language] != '') : ?>
                            <a href="#listing-location" class="listing-address">
                                <i class="ti-location-pin mrg-r-5"></i>
                                <?= $place['address_'.$language] ?>
                            </a>
                        <? endif; ?>
                        <div id="detail-map"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-12">

                <div class="widget-boxed right-part">
                    <div class="img-detail">
                        <img src="<?= $place['photo_url'] ?>" alt="фото парковки">
                    </div>
                    <div class="widget-boxed-body">
                        <div class="side-list">
                            <ul>
                                <li>Mon-Fry
                                    <span>
                                        <?= rightTimeFormat($place['weekday_from']) ?> - <?= rightTimeFormat($place['weekday_to']) ?>
                                    </span>
                                </li>
                                <li>Saturday
                                    <span>
                                        (<?= rightTimeFormat($place['saturday_from']) ?> - <?= rightTimeFormat($place['saturday_to']) ?>)
                                    </span>
                                </li>
                                <li class="sunday">Sunday
                                    <span>
                                        <?= rightTimeFormat($place['sunday_from']) ?> - <?= rightTimeFormat($place['sunday_to']) ?>
                                    </span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<script>

    function intervalRightFormat(interval){
        var int = Number(interval);
        if( int >= 60 ){
            return (int / 60) + 'h';
        } else {
            return int + 'm';
        }
    }

    function initMap(){
        map = new google.maps.Map(document.getElementById('detail-map'), {
            center: {lat: <?= $place['X(coordinates)'] ?>, lng: <?= $place['Y(coordinates)'] ?>},
            zoom: 13,
            mapTypeControl: false,
            //fullscreenControl: false
        });

        var marker = new google.maps.Marker({
            position: {lat: <?= $place['X(coordinates)'] ?>, lng: <?= $place['Y(coordinates)'] ?>},
            map: map,
            icon: {
                url: '<?= TEMPLATE."assets/img/marker.png" ?>', // url
                scaledSize: new google.maps.Size(34, 42), // scaled size
                origin: new google.maps.Point(0,0), // origin
                labelOrigin: new google.maps.Point(17, 15)
                //anchor: new google.maps.Point(0, 10) // anchor
            },
            label: {
                text: intervalRightFormat( <?= $place['time_interval'] ?> ),
                color: '#677782',
                fontSize: "12px",
                fontWeight: 'bolder'
            },
        });
    }
</script>

<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDgSQwHIH_3nhcQsy2xLOKITaEK0WlfgoA&callback=initMap"></script>

<? include_once ROOT . "/layouts/public/footer_site.php" ?>