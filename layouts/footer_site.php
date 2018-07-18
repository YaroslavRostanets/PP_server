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
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="tab" role="tabpanel">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#login" role="tab" data-toggle="tab">Sign In</a></li>
                        <li role="presentation"><a href="#register" role="tab" data-toggle="tab">Sign Up</a></li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content" id="myModalLabel2">
                        <div role="tabpanel" class="tab-pane fade in active" id="login">
                            <img src="assets/img/logo.png" class="img-responsive" alt="" />
                            <div class="subscribe wow fadeInUp">
                                <form class="form-inline" method="post">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <input type="email"  name="email" class="form-control" placeholder="Username" required="">
                                            <input type="password" name="password" class="form-control"  placeholder="Password" required="">
                                            <div class="center">
                                                <button type="submit" id="login-btn" class="btn btn-midium theme-btn btn-radius width-200"> Login </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div role="tabpanel" class="tab-pane fade" id="register">
                            <img src="assets/img/logo.png" class="img-responsive" alt="" />
                            <form class="form-inline" method="post">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <input type="text"  name="email" class="form-control" placeholder="Your Name" required="">
                                        <input type="email"  name="email" class="form-control" placeholder="Your Email" required="">
                                        <input type="email"  name="email" class="form-control" placeholder="Username" required="">
                                        <input type="password" name="password" class="form-control"  placeholder="Password" required="">
                                        <div class="center">
                                            <button type="submit" id="subscribe" class="btn btn-midium theme-btn btn-radius width-200"> Create Account </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ===================== End Login & Sign Up Window =========================== -->

<?php require_once ROOT."/layouts/tab_selector_site.php"; ?>

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

<script src="<?= TEMPLATE ?>assets/plugins/nouislider/nouislider.min.js"></script>

<script src="<?= TEMPLATE ?>assets/plugins/bootstrap-material-datetimepicker/bootstrap-material-datetimepicker.js"></script>

<script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"></script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBueyERw9S41n4lblw5fVPAc9UqpAiMgvM&callback=initMap"></script>

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

</div>
</body>
</html>
