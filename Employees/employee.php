<!-- 'Employee' => 'Insert/Delete/Update/Get/Search' -->
<!doctype html>
<html>
<head>
    <!-- Include header -->
    <?php include("../index.php") ?>

    <title>Employee</title>
</head>
<body>
    <!-- This part is going to need to be refactored into a component to look way nicer -->
    <!-- Replaced style="transform:translateY(50%)" for display:flex and align-items:center in .sidebar css -->
    <div class="sidebar">
        <div>
            <hr class="sidebarLine"></hr>
            <div class="navText sidebarText">
                <!-- Hyperlink to the employee web page -->
                <a href="insert-employee.php" style="text-decoration:none;color:inherit">Insert New Employee</a>
            </div>
            <hr class="sidebarLine"></hr>
            <div class="navText sidebarText">Delete Employee</div>
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
