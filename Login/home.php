<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (isset($_SESSION['loggedin'])) {
	header('Location: /../index.php');
    echo "Hello";
	exit;
}
?>

<!doctype html>
<html>
<head>
    <link rel="stylesheet" href="/Styles/styles.css">
    <title>Home Page</title>
</head>
<body>
    <div class="header">
        <a href="/Employees/Employee.php" class="navText">Employees</a>
        <a href="/Customers/Customer.php" class="navText">Customers</a>
        <a href="/Products/Product.php" class="navText">Products</a>
        <a href="/Stores/Stores.php" class="navText">Stores</a>
        <a href="/Events/Events.php" class="navText">Events</a>
        <a href="/Animals/Animal.php" class="navText">Animals</a>
        <a href="/Enclosures/Enclosure.php" class="navText">Enclosures</a>
    </div>
</body>
</html>