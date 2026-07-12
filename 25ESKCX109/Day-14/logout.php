<?php
// Day 14 - Logout: destroy the session and return to login
session_start();

$_SESSION = array();   // clear all session variables
session_destroy();     // end the session

header("Location: login.php");
exit;
?>
