<!-- 'Products' => 'Insert/Delete/Update/Get/Search' -->
<!doctype html>
<html>
<head>
    <!-- Include index page (header) -->
    <?php include(__DIR__."/../home.php") ?>

    <title>Products</title>
</head>
<body>
    <div class="sidebar">
        <div>
            <hr class="sidebarLine"></hr>
            <div class="navText sidebarText">
                <!-- Hyperlink to the Products Insert page -->
                <a href="/Products/Front/insert-product.php" style="text-decoration:none;color:inherit">Insert New Products</a>
            </div>
            <hr class="sidebarLine"></hr>
            <div class="navText sidebarText">Delete Products</div>
            <hr class="sidebarLine"></hr>
            <div class="navText sidebarText">Update Products</div>
            <hr class="sidebarLine"></hr>
            <div class="navText sidebarText">Get Product Information</div>
            <hr class="sidebarLine"></hr>
            <div class="navText sidebarText">Search Productss</div>
            <hr class="sidebarLine"></hr>
        </div>
    </div>
</body>
</html>
