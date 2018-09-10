<?php
/**
 * Created by PhpStorm.
 * User: Yaroslav
 * Date: 29.12.2017
 * Time: 14:56
 */
?>

<? include_once ROOT."/layouts/header.php" ?>
<? include_once ROOT."/layouts/sidebar.php" ?>

<div class="main-panel">
    <!-- Navbar -->
    <? include_once ROOT."/layouts/navbar.php" ?>
    <!-- End Navbar -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card strpied-tabled-with-hover">
                        <div class="card-header ">
                            <h4 class="card-title">Список парковок Хельсинки</h4>
                            <p class="card-category">Все добавленные парковки</p>
                        </div>
                        <div class="card-body table-full-width table-responsive">
                            <table class="table table-hover table-striped">
                                <thead>
                                <th>ID</th>
                                <th>Знак</th>
                                <th>Фото</th>
                                <th>Будни</th>
                                <th>Суббота</th>
                                <th>Воскресенье</th>
                                <th>Интервал</th>
                                <th>Координаты</th>
                                </thead>
                                <tbody>
                                <?php foreach ($parkPlaces as $parkPlace) : ?>
                                    <tr>
                                        <td>
                                            <?=  $parkPlace['id'] ?>
                                        </td>
                                        <td class="sign-place">
                                            <?php
                                                switch ( $parkPlace['kind_of_place'] ) {
                                                    case "FREE":
                                                        echo '<img src="' . TEMPLATE .'img/thumb1.png" >';
                                                        break;
                                                    case "PAY":
                                                        echo '<img src="' . TEMPLATE .'img/thumb2.png" >';
                                                        break;
                                                    case "FORBIDDEN":
                                                        echo '<img src="' . TEMPLATE .'img/thumb3.png" >';
                                                        break;
                                                    case "FORBIDDEN_YELLOW":
                                                        echo '<img src="' . TEMPLATE .'img/thumb4.png" >';
                                                        break;
                                                    case "FORBIDDEN_PAY":
                                                        echo '<img src="' . TEMPLATE .'img/thumb5.png" >';
                                                        break;
                                                    case "FORBIDDEN_YELLOW_PAY":
                                                        echo '<img src="' . TEMPLATE .'img/thumb6.png" >';
                                                        break;
                                                }
                                            ?>
                                        </td>
                                        <td>
                                            <img style="max-width: 80px; max-height: 80px;" src="<?= $parkPlace['photo_url'] ?>" alt="url">
                                        </td>
                                        <td>
                                            <?= $parkPlace['weekday_from'] ?> - <?= $parkPlace['weekday_to'] ?>
                                        </td>
                                        <td>
                                            ( <?= $parkPlace['saturday_from'] ?> - <?= $parkPlace['saturday_to'] ?> )
                                        </td>
                                        <td style="color: red;">
                                            <?= $parkPlace['sunday_from'] ?> - <?= $parkPlace['sunday_to'] ?>
                                        </td>
                                        <td>
                                            <?= minToHours($parkPlace['time_interval'])  ?>
                                        </td>
                                        <td>
                                            <div>
                                                <b>lat:</b> <?= $parkPlace['X(coordinates)'] ?>
                                            </div>
                                            <div>
                                                <b>lon:</b> <?= $parkPlace['Y(coordinates)'] ?>
                                            </div>
                                        </td>
                                        <td>
                                            <i class="pe-7s-albums"></i>
                                            <button class="btn btn-info btn-fill js-edit-place" data-id="<?=  $parkPlace['id'] ?>">
                                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                            </button>
                                            <button class="btn btn-danger btn-fill js-remove-place" data-id="<?=  $parkPlace['id'] ?>">
                                                <i class="fa fa-times" aria-hidden="true"></i>
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>

                        </div>
                        <div class="row-bot">
                            <button class="btn btn-success btn-fill pull-right"
                                    onclick="window.location.href=window.location.origin + '/admin/addplace/'">
                                <i class="fa fa-plus-square-o" aria-hidden="true"></i> Добавить новую парковку
                            </button>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <?php include_once ROOT . "/layouts/pagination.php"?>
                </div>
            </div>
        </div>
    </div>

</div>

    <!-- Modal -->
    <div class="remove-place modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Удаление парковки №<span class="js-park-id"></span></h4>
                </div>
                <div class="modal-body">
                    <p>Вы уверены что хотите удалить парковку?</p>
                </div>
                <div class="modal-footer">
                    <a href="<?= "/admin/removeplace?id=" ?>" class="btn btn-danger js-remove-id">
                        Удалить
                    </a>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
                </div>
            </div>

        </div>
    </div>

    <script>

        $(document).ready(function(){

            $(".js-remove-place").on("click", function(){
                var id = $(this).attr("data-id");
                $(".js-park-id").text( id );
                $(".js-remove-id").attr("href", $(".js-remove-id").attr("href") + id );
                $('.remove-place').modal({show:true});
            });

            $(".js-edit-place").on("click", function () {
               var id = $(this).attr("data-id");
               window.location.href = "/admin/detail/" + id;
            });

        });

    </script>
