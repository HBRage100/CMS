<?php
include('connection/connection.php');
if (isset($_REQUEST['login_btn'])) {
    $email = $_REQUEST['name'];
    $pass = $_REQUEST['pass'];
    $login_query = "SELECT * FROM `persons` as p INNER JOIN `accounts` as a on p.person_id=a.person_id WHERE p.person_email='$email' && a.password='$pass' && a.status=1";
    $result = mysqli_query($con, $login_query);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
            if ($row['status'] == 0) {
                header("location:login.php?padding_account=1");
            } else {
                $_SESSION['USERID'] = $row['person_id'];
                $_SESSION['USERTYPE'] = $row['user_type'];
                $_SESSION['DEPTID'] = $row['department_id'];
                header("location:admin/dashboard.php?msg=1");
            }
        }
    } else {
        header("location:login.php?msg_error=1");
    }
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
                            <h2>Login</h2>
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
                                <li>Login</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- breadcumb-area end -->
        <!-- contact-area start -->
    <body>
        <!-- Login Start -->
        <div class="contact-area ptb-100">
            <div class="container">
                <div class="row">
                    <div class="col-md-2">
                    </div>
                    <div class="col-md-8">
                        <div class="contact-wrap form-style">
                            <h3>Login</h3>
                            <div class="cf-msg"></div>
                            <form method="post" id="cf">
                                <div class="row">
                                    <div class="col-sm-12 col-xs-12">
                                        <?php
                                        if (isset($_GET['msg_error'])) {
                                            ?>
                                            <span style="color: red;">Invalid User</span>
                                            <?php
                                        }
                                        ?>
                                        <input type="text" placeholder="User Name" id="name" name="name">
                                    </div>
                                    <div class="col-sm-12 col-xs-12">
                                        <input type="password" placeholder="Enter Password" id="pass" name="pass">
                                    </div>
                                    <div class="col-xs-12">
                                        <input type="submit" name="login_btn" id="login_btn" onclick="" value="LogIn" class="btn btn-success">
                                    </div>
                                </div>
                            </form>
                        </div>
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
        <!-- google map -->
        <script src="js/toastr.min.js"></script>
        <!-- main js -->
        <script src="assets/js/scripts.js"></script>
        <script>
            function valid() {
                var u_name, pass, temp;
                u_name = $('#name').val();
                pass = $('#pass').val();
                temp == 0;
                $('#name,#pass').css('border', 'solid green 1px');
                if (u_name == '') {
                    $('#name').css('border', 'solid red 1px');
                }
                if (pass == '') {
                    $('#pass').css('border', 'solid red 1px');
                }
                if (temp != 0)
                {
                    return false;
                }
            }
        </script>
        <?php
        if (isset($_GET['account-registered'])) {
            ?>
            <script type="text/javascript">
                toastr.options = {
                    "closeButton": true,
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                }
                toastr.success('Account Created Successfuly!');
            </script>
            <?php
        }
        ?>
        <?php
        if (isset($_GET['padding_account'])) {
            ?>
            <script type="text/javascript">
                toastr.options = {
                    "closeButton": true,
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                }
                toastr.error('Account Activation Panding!');
            </script>
            <?php
        }
        ?>
    </body>
</html>
