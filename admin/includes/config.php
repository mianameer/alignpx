<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
date_default_timezone_set('Europe/Dublin');
ob_start();
session_start();
$environment = "";
$host = "localhost";
$dbusername = "root";
$dbpwd = "";
$dbname = "alignpx";
$base_url = "http://localhost/alignpx/admin";
if ($environment === "prod") {
    $dbusername = "";
    $dbpwd = "";
    $dbname = "";
    $base_url = "";
}
$connection_string = mysqli_connect($host, $dbusername, $dbpwd, $dbname);
mysqli_select_db($connection_string, $dbname);
if (!$connection_string == true) {
    echo "connection not susccessful";
}
$supportError="Something went Wrong Please Contact To Support";