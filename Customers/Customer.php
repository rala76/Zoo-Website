<!-- 'Employee' => 'Insert/Delete/Update/Get/Search' -->
<!doctype html>
<html>
<head>
    <!-- Include index page (header) -->
    <?php include(__DIR__."/../index.php") ?>

    <title>Customer</title>
</head>
<body>
    <!-- This part is going to need to be refactored into a component to look way nicer -->
    <!-- Replaced style="transform:translateY(50%)" for display:flex and align-items:center in .sidebar css -->
    <div class="sidebar">
        <div>
            <hr class="sidebarLine"></hr>
            <div class="navText sidebarText">
                <!-- Hyperlink to the employee web page -->
                <a href="/Customers/Front/insert-customers.php" style="text-decoration:none;color:inherit">Insert New Customer</a>
            </div>
            <hr class="sidebarLine"></hr>
            <div class="navText sidebarText">Delete Customer</div>
            <hr class="sidebarLine"></hr>
            <div class="navText sidebarText">Update Customer</div>
            <hr class="sidebarLine"></hr>
            <div class="navText sidebarText">Get Customer Information</div>
            <hr class="sidebarLine"></hr>
            <div class="navText sidebarText">Search Customer</div>
            <hr class="sidebarLine"></hr>
        </div>
    </div>
</body>
</html>
