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
            <div class="navText sidebarText">
                <!-- Hyperlink to the Employee Insert page -->
                <a href="/Employees/Front/insert-employee.php" style="text-decoration:none;color:inherit">Insert New Employee</a>
            </div>
            <hr class="sidebarLine"></hr>
            <div class="navText sidebarText">
                <!-- Hyperlink to the Employee Delete page -->
                <a href="/Employees/Front/delete-employee.php" style="text-decoration:none;color:inherit">Delete Employee</a>
            </div>
            <hr class="sidebarLine"></hr>
            <div class="navText sidebarText">
                <!-- Hyperlink to the Employee Update page -->
                <a href="/Employees/Front/update-employee.php" style="text-decoration:none;color:inherit">Update Employee</a>
            </div>
            <hr class="sidebarLine"></hr>
            <div class="navText sidebarText">Get Employee Information</div>
            <hr class="sidebarLine"></hr>
            <div class="navText sidebarText">Search Employees</div>
            <hr class="sidebarLine"></hr>
        </div>
    </div>
</body>
</html>
