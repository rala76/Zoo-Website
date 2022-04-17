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
                <!-- Hyperlink to the insert employee web page -->
                <a href="/Employees/Front/insert-employee.php" style="text-decoration:none;color:inherit">Insert New Employee</a>
            </div>
            <hr class="sidebarLine"></hr>
            <div class="navText sidebarText">
                <!-- Hyperlink to the delete employee web page -->
                <a href="/Employees/Front/delete-employee.php" style="text-decoration:none;color:inherit">Delete Employee</a>
            </div>
            <hr class="sidebarLine"></hr>
            <div class="navText sidebarText">Update Employee</div>
            <hr class="sidebarLine"></hr>
            <div class="navText sidebarText">Get Employee Information</div>
            <hr class="sidebarLine"></hr>
            <div class="navText sidebarText">Search Employees</div>
            <hr class="sidebarLine"></hr>
        </div>
    </div>
</body>
</html>
