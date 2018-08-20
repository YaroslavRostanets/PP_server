<?php
/**
 * Created by PhpStorm.
 * User: Yaroslav
 * Date: 21.08.2018
 * Time: 0:12
 */
?>

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
                            <h4 class="card-title">Список пользователей системы</h4>
                            <p class="card-category">Все зарегистрированные пользователи</p>
                        </div>
                        <div class="card-body table-full-width table-responsive">
                            <table class="table table-hover table-striped">
                                <thead>
                                    <th>ID</th>
                                    <th>FB ID</th>
                                    <th>Google ID</th>
                                    <th>Аватар</th>
                                    <th>Имя</th>
                                    <th>Фамилия</th>
                                    <th>email</th>
                                    <th></th>
                                </thead>
                                <tbody>
                                    <? foreach ($users as $user) : ?>
                                        <tr>
                                            <td><?= $user['id'] ?></td>
                                            <td><?= $user['facebookId'] ?></td>
                                            <td><?= $user['googleId'] ?></td>
                                            <td>
                                                <img height="80" src="<?= $user['picture'] ?>" alt="">
                                            </td>
                                            <td><?= $user['givenName'] ?></td>
                                            <td><?= $user['familyName'] ?></td>
                                            <td><?= $user['email'] ?></td>
                                            <td>
                                                <button class="btn btn-danger btn-fill js-remove-user"
                                                        data-id="<?= $user['id'] ?>">
                                                    <i class="fa fa-times" aria-hidden="true"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    <? endforeach; ?>
                                </tbody>
                            </table>

                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>

</div>

<!-- Modal -->
<div class="remove-user modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Удаление пользователя №<span class="js-user-id"></span></h4>
            </div>
            <div class="modal-body">
                <p>Вы уверены что хотите удалить пользователя?</p>
            </div>
            <div class="modal-footer">
                <a href="<?= "/admin/removeuser?id=" ?>" class="btn btn-danger js-remove-id">
                    Удалить
                </a>
                <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
            </div>
        </div>

    </div>
</div>

<script>
    $(document).ready(function(){
        $(".js-remove-user").on("click", function(){
            var id = $(this).attr("data-id");
            $(".js-user-id").text( id );
            $(".js-remove-id").attr('data-id', id);
            //$(".js-remove-id").attr("href", $(".js-remove-id").attr("href") + id );
            $('.remove-user').modal({show:true});
        });

        $(".js-remove-id").on('click', function(e){
            e.preventDefault();
            console.log($(this).attr('href') + $(this).attr('data-id'));
            window.location.href = $(this).attr('href') + $(this).attr('data-id');
        });
    });
</script>

