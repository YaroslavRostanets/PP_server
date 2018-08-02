<?php
/**
 * Created by PhpStorm.
 * User: Yaroslav
 * Date: 30.07.2018
 * Time: 18:47
 */
?>

<? include_once ROOT . "/layouts/public/header_site.php" ?>

<section class="title-transparent page-title"
         style="background:url(<?= TEMPLATE ?>assets/img/helsinki-bg.jpg); background-attachment: fixed; background-position: center bottom;">
    <div class="container">
        <div class="title-content">
            <h1><?= $aboutContent['title'] ?></h1>
        </div>
    </div>
</section>
<section class="text-cont">
    <div class="container">
        <div class="col-md-12">
            <div class="add-listing-box general-info about-text">
                <?= $aboutContent['text'] ?>
            </div>
        </div>
    </div>
</section>

<? include_once ROOT . "/layouts/public/footer_site.php" ?>
