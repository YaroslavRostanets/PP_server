<?php
/**
 * Created by PhpStorm.
 * User: Yaroslav
 * Date: 23.01.2018
 * Time: 22:43
 */
?>
<? include_once ROOT."/layouts/header.php" ?>
    <?php  if(!empty($error_msg)): ?>
        <div class="alert alert-danger">
            <?= $error_msg ?>
        </div>
    <?php endif; ?>
<style>
    body {
        padding-top: 0;
        padding-bottom: 40px;
        background-color: #eee;
    }

    .form-signin {
        max-width: 330px;
        padding: 15px;
        margin: 0 auto;
    }
    .form-signin .form-signin-heading,
    .form-signin .checkbox {
        margin-bottom: 10px;
    }
    .form-signin .checkbox {
        font-weight: 400;
    }
    .form-signin .form-control {
        position: relative;
        box-sizing: border-box;
        height: auto;
        padding: 10px;
        font-size: 16px;
    }
    .form-signin .form-control:focus {
        z-index: 2;
    }
    .form-signin input[type="email"] {
        margin-bottom: -1px;
        border-bottom-right-radius: 0;
        border-bottom-left-radius: 0;
    }
    .form-signin input[type="password"] {
        margin-bottom: 10px;
        border-top-left-radius: 0;
        border-top-right-radius: 0;
    }
    .btn-primary {
        cursor: pointer;
    }
</style>
<div class="container">
    <form class="form-signin" action="#" method="post">
        <h2 class="form-signin-heading">Please sign in</h2>
        <label for="inputLogin" class="sr-only">Login</label>
        <input type="text"
               name="login"
               value="<?= $login ?>"
               id="inputLogin"
               class="form-control"
               placeholder="login"
               required=""
               autofocus="">
        <label for="inputPassword" class="sr-only">Password</label>
        <input
            type="password"
            name="password"
            value="<?= $password ?>"
            id="inputPassword"
            class="form-control"
            placeholder="Password"
            required="">

        <input type="submit" name="submit" value="Sign in" class="btn btn-lg btn-primary btn-block" ></input>
    </form>
</div>
