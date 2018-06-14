<?php
/**
 * Created by PhpStorm.
 * User: Yaroslav
 * Date: 12.06.2018
 * Time: 14:44
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
                            <h4 class="card-title">Предложенные парковки</h4>
                            <p class="card-category">Все предложенные парковки</p>
                        </div>
                        <div class="card-body table-full-width table-responsive">
                            <table class="table table-hover table-striped">
                                <?php foreach ($offerPlaces as $place): ?>
                                    <tr>
                                        <td><?= $place['id'] ?></td>
                                        <td>
                                            <div class="offer-img-cont">
                                                <img src="<?= $place['photo_url'] ?>" alt="">
                                            </div>
                                        </td>
                                        <td>
                                            <div>
                                                <b>lat: </b>
                                                <?= $place['X(coordinates)'] ?>
                                            </div>
                                            <div>
                                                <b>lon: </b>
                                                <?= $place['Y(coordinates)'] ?>
                                            </div>
                                        </td>
                                        <td>
                                            <?= $place['from_user_id'] ?>
                                        </td>
                                        <td class="controlls" style="width: 140px;">
                                            <button class="btn btn-info btn-fill js-edit-place" data-id="<?=  $place['id'] ?>">
                                                <i class="fa fa-check-square-o" aria-hidden="true"></i>
                                            </button>
                                            <button class="btn btn-danger btn-fill js-remove-place" data-id="<?=  $place['id'] ?>">
                                                <i class="fa fa-times" aria-hidden="true"></i>
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </table>
                        </div>
                    </div>
                    <?php include_once ROOT . "/layouts/pagination.php"?>
                </div>
            </div>
        </div>
    </div>
    <footer class="footer">
        <div class="container">
            <nav>
                <ul class="footer-menu">
                    <li>
                        <a href="#">
                            Home
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            Company
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            Portfolio
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            Blog
                        </a>
                    </li>
                </ul>
                <p class="copyright text-center">
                    ©
                    <script>
                        document.write(new Date().getFullYear())
                    </script>
                    <a href="http://www.creative-tim.com">Creative Tim</a>, made with love for a better web
                </p>
            </nav>
        </div>
    </footer>

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
                <a href="<?= "/admin/removeofferplace?id=" ?>" class="btn btn-danger js-remove-id">
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
            window.location.href = "/admin/offerdetail/" + id;
        });

    });

</script>
