<!-- 'Department' => 'Search' -->
<!doctype html>
<html>
<head>
    <!-- Check session -->
    <?php include_once(__DIR__."/../check-session.php") ?>

    <!-- Include index page (header) -->
    <?php include(__DIR__."/../Login/admin-home.php") ?>

    <title>Department</title>
</head>
<body>
    <div class="sidebar">
        <div>
            <hr class="sidebarLine"></hr>
            <a href="/Departments/Front/search-departments.php" class="navText sidebarText">Search Departments</a>
            <hr class="sidebarLine"></hr>
        </div>
    </div>
</body>
</html>
