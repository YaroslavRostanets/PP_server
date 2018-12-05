<?php
/**
 * Created by PhpStorm.
 * User: Yaroslav
 * Date: 06.07.2018
 * Time: 20:02
 */
?>
<?php
include_once ROOT . "/localization/footer_site.php";

?>
<!-- ================ Start Footer ======================= -->
<footer class="footer dark-bg">
    <div class="row padd-0 mrg-0">
        <div class="footer-text">
            <div class="left-footer-part theme-bg">
                <div class="footer-widget">
                    <div class="textwidget">
                        <h3 class="widgettitle widget-title"><?= $lang[$language]['get_in_touch'] ?></h3>
                        <p style="text-transform: none;">
                            <strong>Email:</strong> support@park-panda.com
                        </p>
                        <a href="/<?= $language . "/about" ?>" class="about-link">
                            <?= $lang[$language]['about'] ?>
                        </a>
                    </div>
                </div>
            </div>
            <div class="right-footer-part gray-flex">
                <div class="footer-widget gray-footer-widget">
                    <h3 class="widget-title">
                        <?= $lang[$language]['application'] ?>
                    </h3>
                    <div class="app-download">
                        <a href="#" class="marker-app-download">
                            <img src="<?= TEMPLATE . 'assets/img/google_play.png' ?>" alt="Google play button">
                        </a>
                        <a href="#" class="marker-app-download">
                            <img src="<?= TEMPLATE . 'assets/img/app_store.png' ?>" alt="Google play button">
                        </a>
                    </div>
                </div>
                <div class="footer-widget gray-footer-widget">
                    <div class="powered">
                        <div class="img-cont">
                            <img src="<?= TEMPLATE . 'assets/img/l.png' ?>" alt="">
                        </div>
                        <div class="txt">
                            <div>Powered by</div>
                            <a href="<?= $language ?>">ParkPanda</a>
                            <div class="copyr">Copyright@ 2018</div>
                        </div>
                    </div>
                </div>
            </div>

            <? include_once ROOT . "/layouts/public/loader.php"; ?>

        </div>
    </div>
</footer>
<!-- ================ End Footer Section ======================= -->

<!-- ================== Login & Sign Up Window ================== -->
<div class="modal fade" id="signup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Please sign in.</h5>
            </div>
            <div class="modal-body">
                <div class="sign-in-cont">
                    <div class="no-ava-cont">
                        <img src="<?= TEMPLATE . 'assets/img/no-avatar.png' ?>" alt="no-avatar">
                    </div>
                    <div class="btns-cont" id="login">

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

<script>
    $(document).ready(function () {
        $('.js-login-btn').on('click', function(e){
            e.preventDefault();
            sessionStorage.setItem('redirectUri', window.location.href);
            var href = $(this).attr('href');
            window.location.href = href;
        });
    })
</script>
<!-- ===================== End Login & Sign Up Window =========================== -->

<!--<a id="back2Top" class="theme-bg" title="Back to top" href="#"><i class="ti-arrow-up"></i></a>-->

<?
    if(!isset($userId) || $userId == ''){
        include_once ROOT."/views/modals/no-sign.php";
    }
?>

<!-- START JAVASCRIPT -->

<!-- Bootstrap js-->
<script src="<?= TEMPLATE ?>assets/plugins/bootstrap/js/bootstrap.min.js"></script>

<!-- Bootsnav js-->
<script src="<?= TEMPLATE ?>assets/plugins/bootstrap/js/bootsnav.js"></script>
<script src="<?= TEMPLATE ?>assets/js/viewportchecker.js"></script>

<!-- bootstrap Select js-->
<script src="<?= TEMPLATE ?>assets/plugins/bootstrap/js/bootstrap-select.min.js"></script>

<!-- Slick Slider js-->
<script src="<?= TEMPLATE ?>assets/plugins/slick-slider/slick.js"></script>

<!-- counter js-->
<script src="<?= TEMPLATE ?>assets/plugins/jquery-counter/js/waypoints.min.js"></script>
<script src="<?= TEMPLATE ?>assets/plugins/jquery-counter/js/jquery.counterup.min.js"></script>
<script src="<?= TEMPLATE ?>assets/js/jQuery.style.switcher.js"></script>

<script src="<?= TEMPLATE ?>assets/plugins/form-styler/jquery.formstyler.min.js"></script>

<script src="<?= TEMPLATE ?>assets/plugins/moment/moment.min.js"></script>

<script src="<?= TEMPLATE ?>assets/plugins/mCustomScrollbar/jquery.mCustomScrollbar.min.js"></script>

<script src="<?= TEMPLATE ?>assets/plugins/bootstrap-material-datetimepicker/bootstrap-material-datetimepicker.js"></script>

<!-- Custom Js -->
<script src="<?= TEMPLATE ?>assets/js/custom.js"></script>

<script>
    function openRightMenu() {
        document.getElementById("rightMenu").style.display = "block";
    }
    function closeRightMenu() {
        $('#rightMenu').fadeOut(200);
    }
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#styleOptions').styleSwitcher();
    });
</script>

<script src="<?= TEMPLATE ?>assets/js/fix.js"></script>

<script src="<?= TEMPLATE ?>assets/js/placeAjax.js"></script>

</div>
</body>
</html>
