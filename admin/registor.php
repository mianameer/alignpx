<?php
include "includes/config.php";
include "sendEmail.php";
$error = $success = $email =  "";
if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    if ($email == "") {
        $error = "Email Required";
    }
    if (empty($error)) {
        $emailExist = "SELECT `email` FROM `users` WHERE `email`='$email'";
        $emailExistResponse = mysqli_query($connection_string, $emailExist);
        if (mysqli_num_rows($emailExistResponse) == 0) {
            $to = $email;
            $subject = 'Verify Email';
            $template = file_get_contents('emailTemplate.html');
            $template = str_replace('{{BUTTON_URL}}', $base_url . '/profile.php', $template);
            $emailResponse = sendEmail($template, $subject, $to);
            if ($emailResponse['Status'] == 200) {
                $userRegistor = "INSERT INTO `users`(`email`,`verify_email`) VALUES ('$email',1)";
                $userRegistorResponse = mysqli_query($connection_string, $userRegistor);
                if ($userRegistorResponse) {
                    $_SESSION['userEmail'] = $email;
                    $_SESSION['user_login'] = true;
                    header('Location:verifyEmail.php');
                }
            } else {
                $error = $supportError;
            }
        } else {
            $error = "Email Already Exist";
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
    <title>Register Boxed | CORK - Multipurpose Bootstrap Dashboard Template </title>
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
                        <h1 class="">Register</h1>
                        <?php
                        if ($error != "") {
                        ?>
                        <div class="alert text-center alert-danger alert-dismissible " role="alert"
                            style="width:100%; margin-left:0%; margin-right:25%;">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                    aria-hidden="true">×</span></button>
                            <?= $error; ?>
                        </div>
                        <?php } else if ($success != "") {
                        ?>
                        <div class="alert text-center alert-success alert-dismissible " role="alert"
                            style="width:100%; margin-left:0%; margin-right:25%;">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                    aria-hidden="true">×</span></button>
                            <?= $success; ?>
                        </div>
                        <?php } ?>
                        <p class="signup-link register">Already have an account? <a href="index.php">Log in</a></p>
                        <form action="" method="POST" class="text-left">
                            <div class="form">
                                <div id="email-field" class="field-wrapper input">
                                    <label for="email">EMAIL</label>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="feather feather-at-sign register">
                                        <circle cx="12" cy="12" r="4"></circle>
                                        <path d="M16 8v5a3 3 0 0 0 6 0v-1a10 10 0 1 0-3.92 7.94"></path>
                                    </svg>
                                    <input id="email" name="email" type="email" value="" class="form-control"
                                        placeholder="Email">
                                </div>
                                <div class="d-sm-flex justify-content-between">
                                    <div class="field-wrapper">
                                        <button type="submit" name="submit" class="btn btn-primary"
                                            value="">Register</button>
                                    </div>
                                </div>
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