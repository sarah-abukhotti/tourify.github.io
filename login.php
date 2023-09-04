<?php
include('required/server.php');
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <title> Login </title>

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
    <link href="assets/img/logo1.jpg" rel="icon">
    <!--===============================================================================================-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!--===============================================================================================-->
    <style>
        .wrap-input100 {
            position: relative;
        }

        .wrap-input100 .toggle-password {
            position: absolute;
            top: 50%;
            right: 18px;
            transform: translateY(-50%);
            cursor: pointer;
        }

        .bg {
            background-image: url("assets/img/logo2.jpg");
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }
    </style>
</head>

<body class="bg">

    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100 p-t-50 p-b-90 p-3">
                <form class="login100-form validate-form flex-sb flex-w " method="POST">
                    <span class="login100-form-title p-b-20">
                        <div class="col-lg-12 m-2">
                            <img src="assets/img/logo1.png" class="img-fluid" alt="" width="100">
                        </div>
                        <h4> WELCOME TO <?= $_SESSION['systemInfo']['short_name'] ?> </h4>

                    </span>

                    <div class="col-lg-12 p-1"> <?php display_error(); ?></div>
                    <div class="wrap-input100 validate-input m-b-16">
                        <input class="input100" type="text" name="email" placeholder="Enter Email">
                        <span class="focus-input100"></span>
                    </div>


                    <div class="wrap-input100 validate-input m-b-16">
                        <input class="input100" type="password" name="password" id="password" placeholder="Enter Password">
                        <i class="fa fa-eye-slash toggle-password" onclick="togglePasswordVisibility()"></i>
                        <span class="focus-input100"></span>
                    </div>

                    <div class="flex-sb-m w-full p-t-3 p-b-24">
                        <div class="contact100-form-checkbox">
                            <input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
                            <label class="label-checkbox100" for="ckb1">
                                remember me
                            </label>
                        </div>

                    </div>

                    <div class="container-login100-form-btn m-t-8">
                        <button type="submit" name="login_btn" class="login100-form-btn">Login</button>

                    </div>

                </form>

                <br>
                <div class="d-flex justify-content-center" style="margin: 0 auto;">
                    <a href="registry.php" class="link-primary txt1">
                        <h5>New User Registration</h5>
                    </a>
                </div>



            </div>
        </div>
    </div>

        <script>
            function togglePasswordVisibility() {
                var passwordField = document.getElementById("password");
                var toggleIcon = document.querySelector(".toggle-password");

                if (passwordField.type === "password") {
                    // Show the password
                    passwordField.type = "text";
                    toggleIcon.classList.remove("fa-eye-slash");
                    toggleIcon.classList.add("fa-eye");
                } else {
                    // Hide the password
                    passwordField.type = "password";
                    toggleIcon.classList.remove("fa-eye");
                    toggleIcon.classList.add("fa-eye-slash");
                }
            }
        </script>
    </body>
    </html>