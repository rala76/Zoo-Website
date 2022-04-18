<!-- 'Employee' => 'Insert/Delete/Update/Get/Search' -->
<!doctype html>
<html>
<head>
    <!-- Include index page (header) -->
    <?php include(__DIR__."/../index.php") ?>

    <title>Employee</title>
</head>
<body>
    <div class="sidebar">
        <div>
            <hr class="sidebarLine"></hr>
            <div>
                <a href="/Employees/Front/insert-employees.php" class="navText sidebarText">Insert New Employee</a>
            </div>
            <hr class="sidebarLine"></hr>
            <div>
                <a href="/Employees/Front/delete-employees.php" class="navText sidebarText">Delete Employee</a>
            </div>
            <hr class="sidebarLine"></hr>
            <div>
                <a href="/Employees/Front/update-employees.php" class="navText sidebarText">Update Employee</a>
            </div>
            <hr class="sidebarLine"></hr>
            <div>
                <a href="Employees/Front/get-employee-information.php" class="navText sidebarText">Get Employee Information</a>
            </div>
            <hr class="sidebarLine"></hr>
            <div>
                <a href="Employees/Front/search-employees.php" class="navText sidebarText">Search Employees</a>
            </div>
            <hr class="sidebarLine"></hr>
        </div>
    </div>
</body>
</html>
