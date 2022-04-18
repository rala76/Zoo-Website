<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit;
}
?>

<!doctype html>
<html>
<head>
    <link rel="stylesheet" href="/styles.css">
    <title>Home Page</title>
</head>
<body>
    <div class="header">
        <!-- Hyperlink to the Employee web page -->
        <div class="navText">
            <a href="/Employees/Employee.php" style="text-decoration:none;color:inherit">Employees</a>
        </div>
        <!-- Hyperlink to the Customer web page -->
        <div class="navText">
            <a href="/Customers/Customer.php" style="text-decoration:none;color:inherit">Customers</a>
        </div>
        <!-- Hyperlink to the Products web page -->
        <div class="navText">
            <a href="/Products/Product.php" style="text-decoration:none;color:inherit">Products</a>
        </div>
        <!-- Hyperlink to the Stores web page -->
        <div class="navText">
            <a href="/Stores/Stores.php" style="text-decoration:none;color:inherit">Stores</a>
        </div>
        <!-- Hyperlink to the Events web page -->
        <div class="navText">
            <a href="/Events/Events.php" style="text-decoration:none;color:inherit">Events</a>
        </div>
        <!-- Hyperlink to the Animals web page -->
        <div class="navText">
            <a href="/Animals/Animal.php" style="text-decoration:none;color:inherit">Animals</a>
        </div>
        <!-- Hyperlink to the Enclosure web page -->
        <div class="navText">
            <a href="/Enclosures/Enclosure.php" style="text-decoration:none;color:inherit">Enclosures</a>
        </div>
    </div>
</body>
</html>