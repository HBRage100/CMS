<?php
include('connection/connection.php');
if (isset($_REQUEST['sub_btn'])) {
    $fnam = $_POST['fname'];
    $lnam = $_POST['lname'];
    $fathernam = $_POST['fathername'];
    $mail = $_POST['email'];
    $add = $_POST['address'];
    $gen = $_POST['gender'];
    $dept = $_POST['department'];
    $phone = $_POST['phone'];
    $check_query = "SELECT * FROM persons where `person_email`='$mail'";
    $result = mysqli_query($con, $check_query);
    if (mysqli_num_rows($result) > 0) {
        header('location:registeration.php?account-already-exist=1');
    } else {


        $qy = "insert into persons(person_name, last_name, father_name, person_email, address, gender,phone) values('$fnam','$lnam','$fathernam','$mail','$add','$gen','$phone')";
        mysqli_query($con, $qy);

        //get max person id
        $max_person = "SELECT max(`person_id`) as max FROM `persons`";
        $result = mysqli_query($con, $max_person);

        while ($row = mysqli_fetch_array($result)) {
            $max_id = $row['max'];
        }

        //insertion in account table
        $account_data = "INSERT INTO accounts(`person_id`,`password`,`user_type`,`department_id`) values('$max_id','" . $_REQUEST['c_pass'] . "','1','$dept')";
        $result2 = mysqli_query($con, $account_data);

        //redirect
        header('location:login.php?account-registered=1');
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
        <!-- heared area end -->
        <?php
        include('components/header.php');
        ?>

        <!-- breadcumb-area start -->
        <div class="breadcumb-area black-opacity bg-img-4">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="breadcumb-wrap">
                            <h2>Registeration</h2>
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
                                <li>Registeration</li>
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
                            <h3>Sign Up </h3>
                            <div class="cf-msg"></div>
                            <form  method="post" id="cf">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <select  class="form-control" id="department" name="department" style="width: 100%; text-indent: 5px;  height: 45px;background-color: white;">
                                            <option value="0">Select Department</option>
                                            <?php
                                            $query = "SELECT * FROM `departments` where `dept_status`=1";
                                            $query = mysqli_query($con, $query);
                                            while ($row = mysqli_fetch_array($query)) {
                                                ?>
                                                <option value="<?= $row['department_id'] ?>"><?= $row['department'] ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div><br><br>
                                    <div class="col-sm-6 col-xs-12">
                                        <input type="text" placeholder="Frist Name" id="fname" name="fname">
                                    </div>
                                    <div class="col-sm-6 col-xs-12">
                                        <input type="text" placeholder="Last Name" id="lname" name="lname">
                                    </div>
                                    <div class="col-xs-12">
                                        <input type="text" placeholder="Father Name" id="fathername" name="fathername">
                                    </div>
                                    <div class="col-xs-12">
                                        <input type="email" placeholder="Enter Email" id="email" name="email">
                                    </div>
                                    <div class="col-xs-12">
                                        <input type="number" placeholder="Enter Phone"  name="phone" id="phone">
                                    </div>
                                    <div class="col-sm-6 col-xs-12">
                                        <input type="password" placeholder="Enter Password"  name="pass" id="pass">
                                    </div>
                                    <div class="col-sm-6 col-xs-12">
                                        <input type="password" placeholder="Confirm Passworde"  name="c_pass" id="c_pass">
                                    </div>
                                    <div class="col-xs-12">
                                        <textarea class="contact-textarea" placeholder="Enter Address" id="address" name="address"></textarea>
                                    </div>
                                    <div class="col-xs-12" >
                                        <div class="col-sm-1 col-xs-12" >
                                            <label style="margin-right: 30px; margin-bottom:60px;">Male</label>
                                        </div>
                                        <div class="col-sm-1 col-xs-12">
                                            <input value="1" type="radio" id="gender" name="gender" style="padding-top: 30px;width: 15px; height: 20px;">
                                        </div>
                                        <div class="col-sm-1 col-xs-12" >
                                            <label style="margin-right: 30px; margin-bottom:60px;">Female</label>
                                        </div>
                                        <div class="col-sm-9 col-xs-12">
                                            <input value="0" type="radio" id="gender" name="gender" style="padding-top: 30px;width: 15px; height: 20px;">
                                        </div>
                                    </div>
                                    <div class="col-xs-12">
                                        <input type="submit" value="Sign Up" class="btn btn-success" onclick="return valid()" name="sub_btn" id="sub_btn">
                                    </div>
                                </div>
                            </form>
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
        <script src="js/toastr.min.js"></script>
        <!-- main js -->
        <script src="assets/js/scripts.js"></script>
        <script>
                                            //fields validation section
                                            function valid() {
                                                var f_name, l_name, father_name, e_mail, pnumb, p_pass, cp_pass, add, gen, department;
                                                f_name = $('#fname').val();
                                                department = $('#department').val();
                                                l_name = $('#lname').val();
                                                father_name = $('#fathername').val();
                                                e_mail = $('#email').val();
                                                pnumb = $('#phone').val();
                                                p_pass = $('#pass').val();
                                                cp_pass = $('#c_pass').val();
                                                add = $('#address').val();
                                                $('#fname,#department,#lname,#fathername,#email,#phone,#pass,#c_pass,#address').css('border', 'solid green 1px');
                                                var temp = 1;
                                                if (f_name == '') {
                                                    $('#fname').css('border', 'solid red 1px');
                                                    temp++;
                                                }
                                                if (department == 0) {
                                                    toastr.options = {
                                                        "closeButton": true,
                                                        "showMethod": "fadeIn",
                                                        "hideMethod": "fadeOut"
                                                    }
                                                    toastr.error('Department Not Selected!');
                                                    $('#department').css('border', 'solid red 1px');
                                                    temp++;
                                                }
                                                if (isNaN(f_name) == false) {
                                                    alert("Please enter valid First name");
                                                }
                                                if (l_name == '') {
                                                    $('#lname').css('border', 'solid red 1px');
                                                    temp++;
                                                }
                                                if (isNaN(l_name) == false) {
                                                    alert("Please enter valid Last name");
                                                }
                                                if (father_name == '') {
                                                    $('#fathername').css('border', 'solid red 1px');
                                                    temp++;
                                                }
                                                if (e_mail == '') {
                                                    $('#email').css('border', 'solid red 1px');
                                                    temp++;
                                                }
                                                if (pnumb == '') {
                                                    $('#phone').css('border', 'solid red 1px');
                                                    temp++;
                                                }
                                                if (isNaN(pnumb) == true) {
                                                    alert("Please enter valid Phone Number");
                                                }
                                                if (p_pass == '') {
                                                    temp++;
                                                    $('#pass').css('border', 'solid red 1px');
                                                }
                                                if (cp_pass == '') {
                                                    temp++;
                                                    $('#c_pass').css('border', 'solid red 1px');
                                                }
                                                if (cp_pass != p_pass) {
                                                    temp++;
                                                    $('#c_pass').css('border', 'solid red 1px');
                                                    $('#pass').css('border', 'solid red 1px');
                                                }
                                                if (add == '') {
                                                    temp++;
                                                    $('#address').css('border', 'solid red 1px');
//                                                    return false;
                                                }
                                                if (temp != 1) {
                                                    return false;
                                                }

                                            }
        </script>
        <?php
        if (isset($_GET['account-already-exist'])) {
            ?>
            <script type="text/javascript">
                toastr.options = {
                    "closeButton": true,
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                }
                toastr.error('Email Already Exist!');
            </script>
            <?php
        }
        ?>
    </body>
</html>
