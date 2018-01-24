<?php
/**
 * Created by PhpStorm.
 * User: Yaroslav
 * Date: 24.01.2018
 * Time: 23:03
 */
?>
<nav class="navbar navbar-expand-lg " color-on-scroll="500">
    <div class=" container-fluid  ">
        <a class="navbar-brand" href="javascript:void(0);"> Парковки </a>
        <button href="" class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar burger-lines"></span>
            <span class="navbar-toggler-bar burger-lines"></span>
            <span class="navbar-toggler-bar burger-lines"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navigation">
            <ul class="navbar-nav ml-auto">

                <?php if( isset($adminName) ) : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="javascript:void(0);">
                                <span class="no-icon">
                                    <i class="fa fa-user-circle" aria-hidden="true"></i>
                                    <?= $adminName ?>
                                </span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="/admin/logout/">
                                <span class="no-icon">
                                    <i class="fa fa-sign-out" aria-hidden="true"></i>
                                    Выход
                                </span>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
