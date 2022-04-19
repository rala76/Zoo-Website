<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if ($_SESSION['loggedin'] != true) {
	header('Location: logon.php');
	exit;
}
?>

<!-- 'Employee' => 'Insert/Delete/Update/Get/Search' -->
<!doctype html>
<html>
<head>
    <!-- Include index page (header) -->
    <?php include(__DIR__."/../Login/home.php") ?>

    <title>Employee</title>
</head>
<body>
    <div class="sidebar">
        <div>
            <hr class="sidebarLine"></hr>
            <a href="/Employees/Front/insert-employees.php" class="navText sidebarText">Insert New Employee</a>
            <hr class="sidebarLine"></hr>
            <a href="/Employees/Front/delete-employees.php" class="navText sidebarText">Delete Employee</a>
            <hr class="sidebarLine"></hr>
            <a href="/Employees/Front/update-employees.php" class="navText sidebarText">Update Employee</a>
            <hr class="sidebarLine"></hr>
            <a href="Employees/Front/get-employee-information.php" class="navText sidebarText">Get Employee Information</a>
            <hr class="sidebarLine"></hr>
            <a href="Employees/Front/search-employees.php" class="navText sidebarText">Search Employees</a>
            <hr class="sidebarLine"></hr>
            <a href="Employees/Front/view-employee-table.php" class="navText sidebarText">View Employee Table</a>
            <hr class="sidebarLine"></hr>
        </div>
    </div>
</body>
</html>
