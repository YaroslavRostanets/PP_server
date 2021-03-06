<?php require_once ROOT."/components/menuConfig.php" ?>

<div class="sidebar" data-image="<?= TEMPLATE ?>img/sidebar-5.jpg">
            <div class="sidebar-wrapper">
                <div class="logo">
                    <a href="/" class="simple-text">
                        Park Panda
                    </a>
                </div>
                <ul class="nav">
                    <?php foreach ($menu as $item) :?>
                        <?php if( stripos($_SERVER['REQUEST_URI'], $item['route']) === 0 ) : ?>
                            <li class="active <?= $item['class'] ?>">
                                <a class="nav-link" href="<? $item['link'] ?> ">
                                    <i class="<?= $item['icon'] ?>"></i>
                                    <p><?= $item['title'] ?></p>
                                    <? if( isset($item['count']) && $item['count'] > 0) :?>
                                        <p class="count"><?= $item['count'] ?></p>
                                    <? endif; ?>
                                </a>
                            </li>
                            <?php else: ?>
                            <li class="<?= $item['class'] ?>">
                                <a class="nav-link" href="<?= $item['link'] ?>">
                                    <i class="<?= $item['icon'] ?>"></i>
                                    <p><?= $item['title'] ?></p>
                                    <? if( isset($item['count']) && $item['count'] > 0 ) :?>
                                        <p class="count"><?= $item['count'] ?></p>
                                    <? endif; ?>
                                </a>
                            </li>
                        <?php endif ; ?>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>