<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
// if (!isset($_SESSION['loggedin'])) {
// 	header('Location: logon.php');
// }
if (!isset($_SESSION['Username'])) {
	header('Location: logon.php');
}
?>