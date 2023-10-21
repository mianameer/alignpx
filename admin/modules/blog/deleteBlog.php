<?php
include "../../includes/config.php";
include "../../includes/functions.php";
$error = $success = $title = $description = "";
$blogId = input_filter($_POST['blogId']);
$response = array();
if (empty($error)) {

    $deleteBlog = "DELETE FROM `blog` WHERE `id`='$blogId'";
    $deleteBlogResponse = mysqli_query($connection_string, $deleteBlog);
    if ($deleteBlogResponse) {
        $response = array("status" => 200);
    } else {
        $response = array("status" => 400);
    }
}
echo json_encode($response);
