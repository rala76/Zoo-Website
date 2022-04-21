<!doctype html>
<html>
<head>
    <!-- Check session -->
    <?php
    session_start();
    echo session_status();
    echo "<br>";
    echo session_id();
    echo "<br>";
    $_SESSION['user'] = "user1";
    echo $_SESSION['user'];
    echo $_SESSION['Username'];
    echo 'DONE';
    ?>
    
    <link rel="stylesheet" href="/Styles/styles.css">
    <title>Admin Home Page</title>
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
        <a href="/Login/logout.php" style="float:right;margin-right:3vh" class="navText">Logout</a>
    </div>
</body>
</html>