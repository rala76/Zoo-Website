<!-- Check session -->
<?php include_once(__DIR__."/../check-session.php") ?>
<?php echo session_id() ?>
<?php echo "user:".$_SESSION['Username'] ?>

<!doctype html>
<html>
<head>
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