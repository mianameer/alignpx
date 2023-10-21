<?php
include "../../includes/config.php";
include "../../includes/functions.php";
$error = $success = $title = $description = "";
$title = input_filter($_POST['title']);
$description = input_filter($_POST['description']);
$blogId = input_filter($_POST['blogid']);
$email = $_SESSION['userEmail'];

if ($title == "") {
    $error = "Title Required";
} elseif ($description == "") {
    $error = "Description Required";
}
$response = array();
if (empty($error)) {

        $updateBlog = "UPDATE `blog` SET `title`='$title',`description`='$description' WHERE `id`='$blogId'";
        $getUserIdByEmailResponse = mysqli_query($connection_string, $updateBlog);
        $id=mysqli_insert_id($connection_string);
        if ($getUserIdByEmailResponse) {
            $response = array("status" => 200 );
        } else {
            $response = array("status" => 400);
        }
}

echo json_encode($response);
