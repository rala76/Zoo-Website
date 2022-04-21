<?php
//header("Location: /Login/logon.php");

session_start();
echo session_status();
echo "<br>";
echo session_id();
echo "<br>";
$_SESSION['user'] = "user1";
echo $_SESSION['user'];

header("Location: /Login/logon.php");
exit();

?>