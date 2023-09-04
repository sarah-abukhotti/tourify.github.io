<?php
include('required/server.php');
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <title> Registry </title>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link href="assets/img/booking.png" rel="icon">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="login/vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="login/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="login/vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="login/vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="login/vendor/animsition/css/animsition.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="login/vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="login/vendor/daterangepicker/daterangepicker.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="login/css/util.css">
    <link rel="stylesheet" type="text/css" href="login/css/main.css">
    <!--===============================================================================================-->
    <!-- Add Font Awesome CSS (You may need to include the Font Awesome library) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!--===============================================================================================-->

    <style>
         .wrap-input100 {
            position: relative;
        }

        .wrap-input100 .toggle-password {
            position: absolute;
            top: 50%;
            right: 18px; /* تم تغيير القيمة هنا من right إلى left */
            transform: translateY(-50%);
            cursor: pointer;
        }
        .show-password {
            display: none;
        }

        .bg {
            background-image: url("assets/img/logo2.jpg");
            background-position: center;
            background-repeat: repeat;
            background-size: cover;
            height: 100%;

        }
    </style>
</head>

<body class="bg">

    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100 p-t-50 p-b-90 p-3">
                <form class="login100-form validate-form flex-sb flex-w" method="POST" enctype="multipart/form-data">
                    <span class="login100-form-title p-b-20">
                        <div class="col-lg-12 m-2">
                            <img src="assets/img/logo1.png" class="img-fluid" alt="" width="100">
                        </div>
                        <h4> WELCOME TO THE <?= $_SESSION['systemInfo']['short_name'] ?> </h4>

                    </span>
                    <div class="col-lg-12 p-1"> <?php display_error()  ?></div>

                    <div class="wrap-input100 validate-input m-b-16">
                        <input class="input100" type="text" name="fname" placeholder="Enter First Name">
                        <span class="focus-input100"></span>
                    </div>

                    <div class="wrap-input100 validate-input m-b-16">
                        <input class="input100" type="text" name="lname" placeholder="Enter Last Name">
                        <span class="focus-input100"></span>
                    </div>


                    <div class="wrap-input100 validate-input m-b-16">
                        <input class="input100" type="text" name="phone" placeholder="Enter Phone ">
                        <span class="focus-input100"></span>
                    </div>


                    <div class="wrap-input100 validate-input m-b-16">
                        <input class="input100" type="email" name="email" placeholder="Enter Email">
                        <span class="focus-input100"></span>
                    </div>

                    <div class="wrap-input100 validate-input m-b-16">
                        <input class="input100" type="date" name="birthday" placeholder="Enter Date of birth">
                        <span class="focus-input100"></span>
                    </div>

                    <div class="wrap-input100 validate-input m-b-16">
                        <input class="input100" type="password" name="password1" placeholder="Enter Password">
                        <i class="fa fa-eye-slash toggle-password" onclick="togglePasswordVisibility('password')" title="Show Password"></i>
                        <input class="input100 show-password" type="text" name="password-show" readonly>
                        <span class="focus-input100"></span>
                    </div>

                    <div class="wrap-input100 validate-input m-b-16">
                        <input class="input100" type="password" name="password2" placeholder="Confirm Password">
                        <i class="fa fa-eye-slash toggle-password" onclick="togglePasswordVisibility('confirm_password')" title="Show Password"></i>
                        <input class="input100 show-password" type="text" name="confirm_password-show" readonly>
                        <span class="focus-input100"></span>
                    </div>


                    <div class="container-login100-form-btn m-t-17">
                        <button type="submit" name="register" class="login100-form-btn">Login</button>

                    </div>

                </form>

                <br>
                <div dir="ltr">
                    <div class="d-flex justify-content-center">
                        <a href="login.php" class="link-primary txt1">
                            <h5>I have an account </h5>
                        </a>
                    </div>

                </div>

            </div>
        </div>
    </div>


    <div id="dropDownSelect1"></div>
    <!--===============================================================================================-->
    <script src="login/vendor/jquery/jquery-3.2.1.min.js"></script>
    <!--===============================================================================================-->
    <script src="login/vendor/animsition/js/animsition.min.js"></script>
    <!--===============================================================================================-->
    <script src="login/vendor/bootstrap/js/popper.js"></script>
    <script src="login/vendor/bootstrap/js/bootstrap.min.js"></script>
    <!--===============================================================================================-->
    <script src="login/vendor/select2/select2.min.js"></script>
    <!--===============================================================================================-->
    <script src="login/vendor/daterangepicker/moment.min.js"></script>
    <script src="login/vendor/daterangepicker/daterangepicker.js"></script>
    <!--===============================================================================================-->
    <script src="login/vendor/countdowntime/countdowntime.js"></script>
    <!--===============================================================================================-->
    <script src="login/js/main.js"></script>
    <!--===============================================================================================-->
    <script>
        function togglePasswordVisibility(fieldName) {
            var passwordInput = document.getElementsByName(fieldName)[0];
            var passwordShowInput = document.getElementsByName(fieldName + '-show')[0];
            var eyeIcon = document.querySelector("[onclick=\"togglePasswordVisibility('" + fieldName + "')\"]");

            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                passwordShowInput.value = passwordInput.value;
                eyeIcon.classList.remove("fa-eye-slash");
                eyeIcon.classList.add("fa-eye");
            } else {
                passwordInput.type = "password";
                passwordShowInput.value = "";
                eyeIcon.classList.remove("fa-eye");
                eyeIcon.classList.add("fa-eye-slash");
            }
        }
    </script>
    <!--===============================================================================================-->س

</body>

</html>