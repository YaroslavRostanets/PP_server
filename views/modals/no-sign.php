<?php
/**
 * Created by PhpStorm.
 * User: Yaroslav
 * Date: 20.08.2018
 * Time: 0:49
 */
?>
<div class="modal fade" id="no-sign" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Please sign in.</h5>
            </div>
            <div class="modal-body">
                <div class="sign-in-cont">
                    <div class="alert alert-danger" role="alert">
                        Этот раздел доступен только авторизированным пользователям.</br>
                        Пожалуйста, авторизируйтесь!
                    </div>
                    <div class="no-ava-cont">
                        <img src="<?= TEMPLATE . 'assets/img/no-avatar.png' ?>" alt="no-avatar">
                    </div>
                    <div class="btns-cont">

                        <a href="<?= "/$language/signin/facebook" ?>" class="js-login-btn loginBtn loginBtn--facebook">
                            Login with Facebook
                        </a>

                        <a href="<?= "/$language/signin/google" ?>" class="js-login-btn loginBtn loginBtn--google">
                            Login with Google
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
