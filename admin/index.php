<?php
include "includes/config.php";
include "includes/functions.php";
include "sendEmail.php";
$error = $success = $email = $password = "";
if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    if ($email == "") {
        $error = "Email Required";
    } elseif ($password == "") {
        $error = "Password Required";
    }
    if (empty($error)) {
        $emailExist = "SELECT * FROM `users` WHERE `email`='$email'";
        $emailExistResponse = mysqli_query($connection_string, $emailExist);
        if (mysqli_num_rows($emailExistResponse) > 0) {
            $getUserInfo = mysqli_fetch_object($emailExistResponse);
            $dbpassword = $getUserInfo->password;

            $to = $email;
            $subject = 'OTP Code';
            $template = file_get_contents('otpTemplate.html');
            $otp = generateUniqueOTP();
            $template = str_replace('{{BUTTON_URL}}', $otp, $template);
            $emailResponse = sendEmail($template, $subject, $to);
            $updateUserOtp = "UPDATE `users` SET `otp`='[value-6]'WHERE `email`='$email'";
            mysqli_query($connection_string, $updateUserOtp);
            $_SESSION['userEmail'] = $getUserInfo->email;
            $_SESSION['user_login'] = true;

            header('Location: modules/dashboard/dashboard.php');
        } else {
            $error = "Email Invalid ";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>Login Boxed | CORK - Multipurpose Bootstrap Dashboard Template </title>
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico" />
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/plugins.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/authentication/form-2.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <link rel="stylesheet" type="text/css" href="assets/css/forms/theme-checkbox-radio.css">
    <link rel="stylesheet" type="text/css" href="assets/css/forms/switches.css">
</head>

<body class="form">


    <div class="form-container outer">
        <div class="form-form">
            <div class="form-form-wrap">
                <div class="form-container">
                    <div class="form-content">

                        <h1 class="">Sign In</h1>
                        <p class="">Log in to your account to continue.</p>
                        <?php
                        if ($error != "") {
                        ?>
                            <div class="alert text-center alert-danger alert-dismissible " role="alert" style="width:100%; margin-left:0%; margin-right:25%;">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                <?= $error; ?>
                            </div>
                        <?php } else if ($success != "") {
                        ?>
                            <div class="alert text-center alert-success alert-dismissible " role="alert" style="width:100%; margin-left:0%; margin-right:25%;">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                <?= $success; ?>
                            </div>
                        <?php } ?>
                        <form action="" method="POST" class="text-left">
                            <div class="form">
                                <div id="email-field" class="field-wrapper input">
                                    <label for="email">EMAIL</label>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-at-sign register">
                                        <circle cx="12" cy="12" r="4"></circle>
                                        <path d="M16 8v5a3 3 0 0 0 6 0v-1a10 10 0 1 0-3.92 7.94"></path>
                                    </svg>
                                    <input id="email" name="email" type="email" value="" class="form-control" placeholder="Email">
                                </div>
                                <div id="password-field" class="field-wrapper input mb-2">
                                    <div class="d-flex justify-content-between">
                                        <label for="password">PASSWORD</label>
                                        <a href="auth_pass_recovery_boxed.html" class="forgot-pass-link">Forgot Password?</a>
                                    </div>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock">
                                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                        <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                    </svg>
                                    <input id="password" name="password" type="password" class="form-control" placeholder="Password">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" id="toggle-password" class="feather feather-eye">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                        <circle cx="12" cy="12" r="3"></circle>
                                    </svg>
                                </div>
                                <div class="d-sm-flex justify-content-between">
                                    <div class="field-wrapper">
                                        <button type="submit" name="submit" class="btn btn-primary" value="">Log In</button>
                                    </div>
                                </div>

                                <p class="signup-link">Not registered ? <a href="registor.php">Create an account</a></p>

                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="assets/js/libs/jquery-3.1.1.min.js"></script>
    <script src="bootstrap/js/popper.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>

    <!-- END GLOBAL MANDATORY SCRIPTS -->
    <script src="assets/js/authentication/form-2.js"></script>

</body>

</html>