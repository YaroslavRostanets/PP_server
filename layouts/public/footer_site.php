<?php
/**
 * Created by PhpStorm.
 * User: Yaroslav
 * Date: 06.07.2018
 * Time: 20:02
 */
?>

<!-- ================ Start Footer ======================= -->
<footer class="footer dark-bg">
    <div class="row padd-0 mrg-0">
        <div class="footer-text">
            <div class="col-md-3 col-sm-12 theme-bg">
                <div class="footer-widget">
                    <div class="textwidget">
                        <h3 class="widgettitle widget-title">Get In Touch</h3>
                        <p>7744 North Park Place<br>
                            San Francisco, CA 714258</p>
                        <p><strong>Email:</strong> support@listinghub.com</p>
                        <p>
                            <strong>Call:</strong> <a href="tel:+774422777">777-444-2222</a>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-5 col-sm-4">
                <div class="footer-widget">
                    <h3 class="widgettitle widget-title">About Us</h3>
                    <ul class="footer-navigation">
                        <li><a href="#">Home Version 1</a></li>
                        <li><a href="#">Home Version 2</a></li>
                        <li><a href="#">Home Version 3</a></li>
                        <li><a href="#">Home Version 4</a></li>
                        <li><a href="#">Listing Detail</a></li>
                        <li><a href="#">Listing Vertical</a></li>
                        <li><a href="#">Listing Sidebar</a></li>
                        <li><a href="#">Vertical Sidebar</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="footer-widget">
                    <h3 class="widgettitle widget-title">Connect Us</h3>
                    <img src="assets/img/footer-logo.png" alt="Footer logo" class="img-responsive" />
                    <ul class="footer-social">
                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                        <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-copyright">
        <p>Copyright@ 2017 Listing Hub Design By <a href="http://www.themezhub.com/" title="Themezhub" target="_blank">Themezhub</a></p>
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

                        <a href="<?= "/$language/signin/facebook" ?>" class="loginBtn loginBtn--facebook">
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
<?php
    if( isset($isHomePage) ){
        require_once ROOT . "/layouts/public/tab_selector_site.php";
    }
?>

<a id="back2Top" class="theme-bg" title="Back to top" href="#"><i class="ti-arrow-up"></i></a>


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

<script src="<?= TEMPLATE ?>assets/plugins/moment/moment.js"></script>

<script src="<?= TEMPLATE ?>assets/plugins/bootstrap-material-datetimepicker/bootstrap-material-datetimepicker.js"></script>

<!-- Custom Js -->
<script src="<?= TEMPLATE ?>assets/js/custom.js"></script>

<script>
    function openRightMenu() {
        document.getElementById("rightMenu").style.display = "block";
    }
    function closeRightMenu() {
        document.getElementById("rightMenu").style.display = "none";
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
