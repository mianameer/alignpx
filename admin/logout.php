<?php 
session_start(); // Start the session

// Destroy the session
session_destroy();
header('Location: index.php');
?>