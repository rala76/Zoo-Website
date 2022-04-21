<?php
//header("Location: /Login/logon.php");
session_start();
$_SESSION["Username"] = "admin";
include(__DIR__."/Login/admin-home.php");
?>