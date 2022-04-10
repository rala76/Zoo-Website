<?php

// SQL Server Extension Sample Code
$connectionInfo = array("UID" => "user1", "pwd" => "Password123", "Database" => "Zoo-Project-DB", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
$serverName = "tcp:cosc3380projectsserver.database.windows.net,1433";
$conn = sqlsrv_connect($serverName, $connectionInfo);

if ($conn == false) {
    die(print_r(sqlsrv_errors(), true));
}

?>