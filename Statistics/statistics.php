<?php
// Include process code for forms & tables
include(__DIR__."/process-statistics.php");
?>

<!doctype html>
<html>
<head>
    <!-- Check session -->
    <?php include_once(__DIR__."/../check-session.php") ?>

    <!-- Include index page (header) -->
    <?php include(__DIR__."/../Login/admin-home.php") ?>

    <title>Admin Statistics</title>
    <link rel="stylesheet" href="/Styles/styles.css">
    <link rel="stylesheet" href="/Styles/statisticStyles.css">
    <script src="https://kit.fontawesome.com/e9a5785044.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="form-base-3">
        <div class="statistics" style="color:#A9C47F;">
            <i class="fa-solid fa-otter fa-5x"></i>
            <h1>
                <?php echo $results_animals["Total_Animals"] ?>
            </h1>
            <h1 class="bottom" style="background-color:#A9C47F;">
                <a href="/Animals/Animal.php">Animal(s) In Zoo</a>
            </h1>
        </div>
        <div class="statistics" style="color:#006747;">
            <i class="fa-solid fa-people-line fa-5x"></i>
            <h1>
                <?php echo $results_customers["Total_Customers"] ?>
            </h1>
            <h1 class="bottom" style="background-color:#006747;">
                <a href="/Customers/Customer.php">Customer(s) Visited</a>
            </h1>
        </div>
        <div class="statistics" style="color:#004F59;">
            <i class="fa-solid fa-store fa-5x"></i>
            <h1>
                <?php echo $results_stores["Total_Stores"] ?>
            </h1>
            <h1 class="bottom" style="background-color:#004F59;">
                <a href="/Stores/Stores.php">Store(s) Operating</a>
            </h1>
        </div>
        <div class="statistics" style="color:#006747;">
            <i class="fa-regular fa-calendar fa-5x"></i>
            <h1>
                <?php echo $results_events["Total_Events"] ?>
            </h1>
            <h1 class="bottom" style="background-color:#006747;">
                <a href="/Events/Events.php">Event(s) Held</a>
            </h1>
        </div>
        <div class="statistics" style="color:#004F59;">
            <i class="fa-solid fa-user-tie fa-5x"></i>
            <h1>
                <?php echo $results_employees["Total_Employees"] ?>
            </h1>
            <h1 class="bottom" style="background-color:#004F59;">
                <a href="/Employees/Employee.php">Employee(s) Hired</a>
            </h1>
        </div>
        <div class="statistics" style="color:#A9C47F;">
            <i class="fa-solid fa-ticket fa-5x"></i>
            <h1>
                <?php echo $results_products["Total_Products"] ?>
            </h1>
            <h1 class="bottom" style="background-color:#A9C47F;">
                <a href="/Products/Product.php">Product(s) Sold</a>
            </h1>
        </div>
    </div>
</body>
</html>
