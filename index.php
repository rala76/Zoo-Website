<?php
//header("Location: /Login/logon.php");
session_start();
$_SESSION["Username"] = "admin";
header("Location: /Login/admin-home.php");
exit();
?>