<?php 
//Start session
session_start();
//Get connection details from connect-sql.php file
include (__DIR__."/../connect-sql.php");

//Variables to store username and password input by the user
$Username = $_POST['Username'];
$Password = $_POST['Password'];
$Email = $_POST['Email'];

//Checks to ensure username and password were entered
if (empty($_POST['Username']) || empty($_POST['Password']) || empty($_POST['Email'])) {
    echo '<h4 style="text-align:center">';
    echo 'Please fill in all fields!';
    echo '</h4>';
    exit;
}

$userExists = "SELECT * FROM [dbo].[Accounts] WHERE Username='{$Username}' OR "." Password='{$Password}' OR "." Email='{$Email}'";
$stmt1 = sqlsrv_query($conn, $userExists);

//Checks to ensure query executed successfully
if($stmt1 === false ) {
    echo '<h4 style="text-align:center">';
    echo "Error in executing query.</br>";
    echo '</h4>';
    die(print_r(sqlsrv_errors(), true));  
} 

if (sqlsrv_has_rows($stmt1) == 0) {
    //Query to get the user's account from the database
    $tsql = "INSERT INTO [dbo].[Accounts] 
            ([Username]
            , [Password] 
            , [Email]
            , [Role]) 
            VALUES
            (?, ?, ?, 'Customer')";
        
    $params = array($Username
        , $Password
        , $Email);

    $stmt2 = sqlsrv_query($conn, $tsql, $params);

    echo "Successfully Inserted New Customer</br>";

    //Checks to ensure query executed successfully
    if($stmt2 === false ) {
        echo '<h4 style="text-align:center">';
        echo "Error in executing query.</br>";
        echo '</h4>';
        die(print_r(sqlsrv_errors(), true));  
    } 

    if ($stmt2 === false) {
        echo "Could Not Register New Customer</br>";
    }
    else {    
        $_SESSION['loggedin'] = TRUE;
        $_SESSION['Username'] = $Username;
        $_SESSION['Password'] = $Password;
        $_SESSION['Email'] = $Email;
        $_SESSION['Role'] = 'Customer';

        header('Location: customer-home.php');
    }

    sqlsrv_free_stmt($stmt2);
}
else {
    header('Location: redirection.php');
}

//Free up connection resources
sqlsrv_free_stmt($stmt1);  
sqlsrv_close($conn);  
?>
