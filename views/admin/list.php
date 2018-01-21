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
    <nav class="navbar navbar-expand-lg " color-on-scroll="500">
        <div class=" container-fluid  ">
            <a class="navbar-brand" href="#pablo"> Парковки </a>
            <button href="" class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-bar burger-lines"></span>
                <span class="navbar-toggler-bar burger-lines"></span>
                <span class="navbar-toggler-bar burger-lines"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navigation">
                <ul class="nav navbar-nav mr-auto">
                    <li class="nav-item">
                        <a href="#" class="nav-link" data-toggle="dropdown">
                            <i class="nc-icon nc-palette"></i>
                            <span class="d-lg-none">Dashboard</span>
                        </a>
                    </li>
                    <li class="dropdown nav-item">
                        <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                            <i class="nc-icon nc-planet"></i>
                            <span class="notification">5</span>
                            <span class="d-lg-none">Notification</span>
                        </a>
                        <ul class="dropdown-menu">
                            <a class="dropdown-item" href="#">Notification 1</a>
                            <a class="dropdown-item" href="#">Notification 2</a>
                            <a class="dropdown-item" href="#">Notification 3</a>
                            <a class="dropdown-item" href="#">Notification 4</a>
                            <a class="dropdown-item" href="#">Another notification</a>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nc-icon nc-zoom-split"></i>
                            <span class="d-lg-block">&nbsp;Search</span>
                        </a>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#pablo">
                            <span class="no-icon">Account</span>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="no-icon">Dropdown</span>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <a class="dropdown-item" href="#">Something</a>
                            <a class="dropdown-item" href="#">Something else here</a>
                            <div class="divider"></div>
                            <a class="dropdown-item" href="#">Separated link</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#pablo">
                            <span class="no-icon">Log out</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
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
                                            <?= $parkPlace['time_interval'] ?>
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
                                            <button class="btn btn-info btn-fill">
                                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                            </button>
                                            <button class="btn btn-danger btn-fill">
                                                <i class="fa fa-times" aria-hidden="true"></i>
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="row-bot">
                            <button class="btn btn-success btn-fill pull-right">
                                <i class="fa fa-plus-square-o" aria-hidden="true"></i> Добавить новую парковку
                            </button>
                            <div class="clearfix"></div>
                        </div>
                    </div>
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

<? include_once ROOT."/layouts/footer.php" ?>