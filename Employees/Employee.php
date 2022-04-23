<!-- 'Employee' => 'Insert/Delete/Update/Get/Search' -->
<!doctype html>
<html>
<head>
    <!-- Check session -->
    <?php include_once(__DIR__."/../check-session.php") ?>

    <!-- Include index page (header) -->
    <?php include(__DIR__."/../Login/admin-home.php") ?>

    <title>Employee</title>
</head>
<body>
    <div class="sidebar">
        <div>
            <!-- <hr class="sidebarLine"></hr>
            <a href="/Employees/Front/insert-employees.php" class="navText sidebarText">Insert New Employee</a>
            <hr class="sidebarLine"></hr>
            <a href="/Employees/Front/delete-employees.php" class="navText sidebarText">Delete Employee</a>
            <hr class="sidebarLine"></hr>
            <a href="/Employees/Front/update-employees.php" class="navText sidebarText">Update Employee</a> -->
            <hr class="sidebarLine"></hr>
            <a href="/Employees/Front/search-employees.php" class="navText sidebarText">Search Employees</a>
            <hr class="sidebarLine"></hr>
        </div>
    </div>
</body>
</html>
