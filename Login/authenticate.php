<?php 
//Start session
session_start();
//Get connection details from connect-sql.php file
include (__DIR__."/../connect-sql.php");

//Variables to store username and password input by the user
$Username = $_POST['Username'];
$Password = $_POST['Password'];

//Checks to ensure username and password were entered
if (empty($_POST['Username']) || empty($_POST['Password'])) {
    echo 'Please fill both the username and password fields';
    exit;
}

//Query to get the user's account from the database
$tsql = "SELECT * FROM [Zoo-Project-DB].[dbo].[Accounts] WHERE Username='{$Username}' AND "." Password='{$Password}'";  
$stmt = sqlsrv_query($conn, $tsql);

//Checks to ensure query executed successfully
if($stmt === false )  
{  
     echo "Error in executing query.</br>";  
     die(print_r(sqlsrv_errors(), true));  
} 

//Checks to make sure user account exists in database, and there is only one instance of it
if (sqlsrv_has_rows($stmt) != 1) {
    echo "User/password not found";
}
else {
    //Set loggedin to true, and store username/password in the session
    if($row = sqlsrv_fetch_array($stmt)) {
        $_SESSION['loggedin'] = TRUE;
        $_SESSION['Username'] = $row['Username'];
        $_SESSION['Password'] = $row['Password'];
    }
    
    //Take user to home page
    header('Location: home.php');
}

//Free up connection resources
sqlsrv_free_stmt( $stmt);  
sqlsrv_close( $conn);  
?>  