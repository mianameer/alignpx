<?php
include "includes/config.php";
$error = $success = $userName =  "";
if (isset($_POST['submit'])) {
    $userName = $_POST['username'];
    $password = $_POST['password'];
    if ($userName == "") {
        $error = "UserName Required";
    } else if ($password == "") {
        $error = "Password Required";
    }
    if (empty($error)) {
        $email = $_SESSION['userEmail'];
        $emailExist = "SELECT * FROM `users` WHERE `email`='$email'";
        $emailExistResponse = mysqli_query($connection_string, $emailExist);
        if (mysqli_num_rows($emailExistResponse) > 0) {
            $getUserInfo = mysqli_fetch_object($emailExistResponse);
            $isVerified = $getUserInfo->verify_email;
            $password = $getUserInfo->password;

            if ($isVerified == 1 && $password == "") {
                $pwd_options = ['cost' => 8];
                $hashed_password = password_hash($password, PASSWORD_BCRYPT,$pwd_options);

                $userProfile = "UPDATE `users` SET `name`='$userName',`password`='$hashed_password' WHERE `email`='$email'";
                $userProfileResponse = mysqli_query($connection_string, $userProfile);
                if ($userProfileResponse) {
                    header('Location:verifyEmail.php');
                } else {
                    $error = $supportError;
                }
            } else {
                $error = "Profile Already Exist";
            }
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
                        <h1 class="">User Profile</h1>
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
                                <div id="username-field" class="field-wrapper input">
                                    <label for="username">USERNAME</label>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user">
                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="12" cy="7" r="4"></circle>
                                    </svg>
                                    <input id="username" name="username" value="<?= $userName ?>" type="text" class="form-control" placeholder="e.g John_Doe">
                                </div>

                                <div id="password-field" class="field-wrapper input mb-2">
                                    <div class="d-flex justify-content-between">
                                        <label for="password">PASSWORD</label>
                                    </div>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock">
                                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                        <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                    </svg>
                                    <input id="password" name="password" type="password" value="<?= $password ?>" class="form-control" placeholder="Password">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" id="toggle-password" class="feather feather-eye">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                        <circle cx="12" cy="12" r="3"></circle>
                                    </svg>
                                </div>
                                <div class="d-sm-flex justify-content-between">
                                    <div class="field-wrapper">
                                        <button type="submit" name="submit" class="btn btn-primary" value="">Continue</button>
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