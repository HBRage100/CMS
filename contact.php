<?php
include('connection/connection.php');
if (isset($_REQUEST['msg_btn'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $msg = $_POST['msg'];

    $query = "insert INTO contact_us(name,email,subject,message) values('$name','$email','$subject','$msg')";
    mysqli_query($con, $query);
    header('location:contact.php?sent-msg=1');
}
?>

<!doctype html>
<html class="no-js" lang="">
    <head>
        <?php
        include ('./components/header_link.php');
        ?>
    </head>
    <body>
        <?php
        include('components/header.php');
        ?>
        <!-- breadcumb-area start -->
        <div class="breadcumb-area black-opacity bg-img-4">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="breadcumb-wrap">
                            <h2>Contact us</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="breadcumb-menu">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <ul>
                                <li><a href="index.php">Home</a></li>
                                <li>/</li>
                                <li>Contact</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- breadcumb-area end -->

        <!-- contact-area start -->
        <div class="contact-area ptb-100">
            <div class="container">
                <div class="row">
                    <div class="col-md-2">

                    </div>
                    <div class="col-md-8">
                        <div class="contact-wrap form-style">
                            <h3>Contact Us</h3>
                            <div class="cf-msg"></div>
                            <form method="post" id="cf">
                                <div class="row">
                                    <div class="col-sm-6 col-xs-12">
                                        <input type="text" placeholder="Name" id="name" name="name">
                                    </div>
                                    <div class="col-sm-6 col-xs-12">
                                        <input type="email" placeholder="Email" id="email" name="email">
                                    </div>
                                    <div class="col-xs-12">
                                        <span style="color: grey;">(Optional)</span>
                                        <input type="text" placeholder="Subject" id="subject" name="subject">
                                    </div>
                                    <div class="col-xs-12">
                                        <textarea class="contact-textarea" placeholder="Message" id="msg" name="msg"></textarea>
                                    </div>
                                    <div class="col-xs-12">
                                        <input type="submit" value="Send" class="btn btn-success" onclick="return valid()" name="msg_btn" id="msg_btn">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-2">

                    </div>
                    <div class="col-xs-12">
                        <div id="googleMap">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3432.841488978399!2d73.11781122415243!3d30.638424531336117!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3922b7baa9b9136d%3A0x4ad0a93678df4a61!2sGCUF%20Sahiwal%20CMPS!5e0!3m2!1sen!2s!4v1593242734297!5m2!1sen!2s" width="100%" height="100%" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- contact-area end -->
        <!-- footer-area start  -->
        <?php
        include('components/footer.php');
        ?>
        <!-- footer-area end  -->

        <!-- all js here -->
        <!-- jquery latest version -->
        <script src="assets/js/vendor/jquery-1.12.4.min.js"></script>
        <!-- bootstrap js -->
        <script src="assets/js/bootstrap.min.js"></script>
        <!-- owl.carousel.2.0.0-beta.2.4 css -->
        <script src="assets/js/owl.carousel.min.js"></script>
        <!-- counterup.main.js -->
        <script src="assets/js/counterup.main.js"></script>
        <!-- isotope.pkgd.min.js -->
        <script src="assets/js/imagesloaded.pkgd.min.js"></script>
        <!-- isotope.pkgd.min.js -->
        <script src="assets/js/isotope.pkgd.min.js"></script>
        <!-- jquery.waypoints.min.js -->
        <script src="assets/js/jquery.waypoints.min.js"></script>
        <!-- jquery.magnific-popup.min.js -->
        <script src="assets/js/jquery.magnific-popup.min.js"></script>
        <!-- jquery.slicknav.min.js -->
        <script src="assets/js/jquery.slicknav.min.js"></script>
        <!-- snake.min.js -->
        <script src="assets/js/snake.min.js"></script>
        <!-- wow js -->
        <script src="assets/js/wow.min.js"></script>
        <!-- plugins js -->
        <script src="assets/js/plugins.js"></script>
        <!-- main js -->
        <script src="assets/js/scripts.js"></script>
        <script src="js/toastr.min.js"></script>
        <script>

                                            //contact us form validation js
                                            function valid() {
                                                var v_name, v_email, v_sub, v_msg;
                                                v_name = $('#name').val();
                                                v_email = $('#email').val();
                                                v_sub = $('#subject').val();
                                                v_msg = $('#msg').val();
                                                $('#subject,#name,#email,#message').css('border', 'solid green 1px');
                                                var temp = 1;
                                                if (v_name == '') {
                                                    $('#name').css('border', 'solid red 1px');
                                                    temp++
                                                }
                                                if (v_email == '') {
                                                    $('#email').css('border', 'solid red 1px');
                                                    temp++;
                                                }
                                                if (v_sub == '') {
                                                    if (confirm("Post Message without Subject")) {

                                                    } else {
                                                        temp++;
                                                    }
                                                }
                                                if (v_msg == '') {
                                                    $('#msg').css('border', 'solid red 1px');
                                                    temp++;
                                                }
                                                if (temp != 1) {
                                                    return false;
                                                }
                                            }
        </script>
        <?php
        if (isset($_GET['sent-msg'])) {
            ?>
            <script type="text/javascript">
                toastr.options = {
                    "closeButton": true,
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                }
                toastr.success('Message Sent Successfully!');
            </script>
            <?php
        }
        ?>
    </body>
</html>
