<!-- 'Customer' => 'Insert/Delete/Update/Get/Search' -->
<!doctype html>
<html>

<head>
    <!-- Check session -->
    <?php include_once(__DIR__ . "/../check-session.php") ?>

    <!-- Include index page (header) -->
    <?php include(__DIR__ . "/../Login/admin-home.php") ?>

    <title>Customer</title>
</head>

<body>
    <div class="sidebar">
        <div>

            <hr class="sidebarLine">
            </hr>
            <a href="/Customers/Front/search-customers.php" class="navText sidebarText">Search Customers</a>
            <hr class="sidebarLine">
            </hr>
        </div>
    </div>
</body>

</html>