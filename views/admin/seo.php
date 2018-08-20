<?php
/**
 * Created by PhpStorm.
 * User: Yaroslav
 * Date: 09.08.2018
 * Time: 18:07
 */
?>

<? include_once ROOT."/layouts/header.php" ?>
<? include_once ROOT."/layouts/sidebar.php" ?>

<div class="main-panel">
    <? if( isset($_GET['save']) ) : ?>
    <div class="alert alert-success js-alert-success" role="alert" style="margin-bottom: 0">
        <b>Данные обновлены</b>
        <script>
            setTimeout(function () {
                $('.js-alert-success').slideUp(200);
            }, 2000);
            $('.js-alert-success')
        </script>
    </div>
    <? endif; ?>
    <!-- Navbar -->
    <? include_once ROOT."/layouts/navbar.php" ?>
    <!-- End Navbar -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="seo-cont card strpied-tabled-with-hover">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <? $i = 0; ?>
                            <? foreach ($pages as $value) : ?>
                            <li class="nav-item">
                                <a class="nav-link <?= ($i == 0)? 'active' : '' ?>" id="<?= $value['template_name'] ?>-tab" data-toggle="tab"
                                   href="#<?= $value['template_name'] ?>" role="tab"
                                   aria-controls="<?= $value['template_name'] ?>" aria-selected="true">
                                    <?= $value['template_name'] ?>
                                </a>
                            </li>
                                <? $i++ ?>
                            <? endforeach; ?>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <? $i = 0; ?>
                            <? foreach ($pages as $value) : ?>
                                <div class="tab-pane fade <?= ($i == 0)? 'active show' : '' ?>"
                                     id="<?= $value['template_name'] ?>"
                                     role="tabpanel" aria-labelledby="<?= $value['template_name'] ?>-tab">
                                    <form action="#" method="post" class="row">
                                        <div class="form-group" style="display: none;">
                                            <input type="text" name="template_name" value="<?= $value['template_name'] ?>">
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">index</label>
                                                <input type="checkbox" name="robots_index"
                                                    <?= ($value['robots_index'] == 1) ? 'checked' : '' ?>
                                                >
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">follow</label>
                                                <input type="checkbox" name="robots_follow"
                                                    <?= ($value['robots_follow'] == 1) ? 'checked' : '' ?>
                                                >
                                            </div>
                                        </div>
                                        <div class="col-md-12" style="padding-left: 15px;">
                                            <div class="form-group">
                                                <label>Заголовок страницы title_ru</label>
                                                <input type="text" class="form-control" name="title_ru" value="<?= $value['title_ru'] ?>">
                                            </div>
                                            <div class="form-group">
                                                <label>Описание страницы description_ru</label>
                                                <textarea
                                                        name="description_ru"
                                                        id=""
                                                        cols="30"
                                                        rows="10"
                                                        class="form-control"><?= $value['description_ru'] ?></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label>Ключевые слова keywords_ru</label>
                                                <textarea
                                                        name="keywords_ru"
                                                        id=""
                                                        cols="30"
                                                        rows="10"
                                                        class="form-control"><?= $value['keywords_ru'] ?></textarea>
                                            </div>

                                            <hr>

                                            <div class="form-group">
                                                <label>Заголовок страницы title_en</label>
                                                <input
                                                        type="text"
                                                        class="form-control"
                                                        name="title_en"
                                                        value="<?= $value['title_en'] ?>">
                                            </div>
                                            <div class="form-group">
                                                <label>Описание страницы description_en</label>
                                                <textarea
                                                        name="description_en"
                                                        id=""
                                                        cols="30"
                                                        rows="10"
                                                        class="form-control"><?= $value['description_en'] ?></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label>Ключевые слова keywords_ru</label>
                                                <textarea
                                                        name="keywords_en"
                                                        id=""
                                                        cols="30"
                                                        rows="10"
                                                        class="form-control"><?= $value['keywords_en'] ?></textarea>
                                            </div>

                                            <hr>

                                            <div class="form-group">
                                                <label>Заголовок страницы title_fi</label>
                                                <input
                                                        type="text"
                                                        class="form-control"
                                                        name="title_fi"
                                                        value="<?= $value['title_fi'] ?>">
                                            </div>
                                            <div class="form-group">
                                                <label>Описание страницы description_fi</label>
                                                <textarea
                                                        name="description_fi"
                                                        id=""
                                                        cols="30"
                                                        rows="10"
                                                        class="form-control"><?= $value['description_fi'] ?></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label>Ключевые слова keywords_fi</label>
                                                <textarea
                                                        name="keywords_fi"
                                                        id=""
                                                        cols="30"
                                                        rows="10"
                                                        class="form-control"><?= $value['keywords_fi'] ?></textarea>
                                            </div>

                                        </div>
                                        <div style="padding: 10px 15px;">
                                            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </form>
                                </div>
                                <? $i++ ?>
                            <? endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<? include_once ROOT."/layouts/footer.php" ?>
