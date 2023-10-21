<?php
include "../../includes/config.php";
include "../../includes/functions.php";
$error = $success = $title = $description = "";
$title = input_filter($_POST['title']);
$description = input_filter($_POST['description']);
$email = $_SESSION['userEmail'];

if ($title == "") {
    $error = "Title Required";
} elseif ($description == "") {
    $error = "Description Required";
}
$response = array();
if (empty($error)) {
    $getUserIdByEmail = "SELECT `id` FROM `users` WHERE `email`='$email'";
    $getUserIdByEmailResponse = mysqli_query($connection_string, $getUserIdByEmail);
    if (mysqli_num_rows($getUserIdByEmailResponse) > 0) {
        $getUserId = mysqli_fetch_object($getUserIdByEmailResponse);
        $userId = $getUserId->id;
        $createBlog = "INSERT INTO `blog`(`user_id`, `title`, `description`) VALUES ('$userId','$title','$description')";
        $getUserIdByEmailResponse = mysqli_query($connection_string, $createBlog);
        $id=mysqli_insert_id($connection_string);
        if ($getUserIdByEmailResponse) {
            $response = array("status" => 200 ,"blogId"=>$id);
        } else {
            $response = array("status" => 400);
        }
    }
}

echo json_encode($response);
