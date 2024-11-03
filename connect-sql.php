<?php

// Include the config file
require 'config.php';

// SQL Server Extension Code (SQLSRV)
$connectionInfo = array(
    "UID" => $db_config['UID'], 
    "pwd" => $db_config['pwd'], 
    "Database" => $db_config['Database'], 
    "LoginTimeout" => $db_config['LoginTimeout'], 
    "Encrypt" => $db_config['Encrypt'], 
    "TrustServerCertificate" => $db_config['TrustServerCertificate']
);
$serverName = $db_config['Server'];
$conn = sqlsrv_connect($serverName, $connectionInfo);

// If connection failed
if ($conn == false) {
    die(print_r("Connection failed!", true));
}

?>