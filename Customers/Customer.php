<!-- 'Customer' => 'Insert/Delete/Update/Get/Search' -->
<!doctype html>
<html>
<head>
    <!-- Include index page (header) -->
    <?php include(__DIR__."/../index.php") ?>

    <title>Customer</title>
</head>
<body>
    <div class="sidebar">
        <div>
            <hr class="sidebarLine"></hr>
            <div>
                <a href="/Customers/Front/insert-customers.php" class="navText sidebarText">Insert New Customer</a>
            </div>
            <hr class="sidebarLine"></hr>
            <div>
                <a href="/Customers/Front/delete-customers.php" class="navText sidebarText">Delete Customer</a>
            </div>
            <hr class="sidebarLine"></hr>
            <div>
                <a href="/Customers/Front/update-customers.php" class="navText sidebarText">Update Customer</a>
            </div>
            <hr class="sidebarLine"></hr>
            <div>
                <a href="/Customers/Front/get-customer-information.php" class="navText sidebarText">Get Customer Information</a>
            </div>
            <hr class="sidebarLine"></hr>
            <div>
                <a href="/Customers/Front/search-customers.php" class="navText sidebarText">Search Customer</a>
            </div>
            <hr class="sidebarLine"></hr>
        </div>
    </div>
</body>
</html>
