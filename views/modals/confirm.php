<?php
/**
 * Created by PhpStorm.
 * User: Yaroslav
 * Date: 28.07.2018
 * Time: 18:24
 */
?>

<div id="confirm-modal" class="modal fade" tabindex="-1" role="dialog" style="display: block;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="color: transparent">.</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="booking-confirm padd-top-30 padd-bot-30 <?= ($type == 'WARNING')? 'warning' : '' ?>">
                    <?
                    switch ($type) {
                        case 'OK':
                            echo "<i class=\"fa fa-check\" aria-hidden=\"true\"></i>";
                            break;
                        case 'WARNING':
                            echo "<i class=\"fa fa-exclamation-triangle\" aria-hidden=\"true\"></i>";
                            break;
                        case 'ERROR':
                            echo "<i class=\"fa fa-times\" aria-hidden=\"true\"></i>";
                            break;
                    }
                    ?>

                    <h2 class="mrg-top-15
                        <?= ($type == 'WARNING')? 'warning' : '' ?>">

                        <? switch ($type) {
                            case 'OK':
                                echo "Готово!";
                                break;
                            case 'WARNING':
                                echo "Внимание!";
                                break;
                            case 'ERROR':
                                echo "Ошибка";
                                break;
                        }
                        ?></h2>
                    <p><?= $text ?></p>
                    <a href="javascript:void(0);"
                       data-dismiss="modal"
                       aria-label="Close"
                       class="btn theme-btn-trans mrg-top-20">OK</a>
                </div>
            </div>
        </div>
    </div>
</div>
