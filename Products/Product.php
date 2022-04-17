<!-- 'Products' => 'Insert/Delete/Update/Get/Search' -->
<!doctype html>
<html>
<head>
    <!-- Include index page (header) -->
    <?php include(__DIR__."/../index.php") ?>

    <title>Products</title>
</head>
<body>
    <!-- This part is going to need to be refactored into a component to look way nicer -->
    <!-- Replaced style="transform:translateY(50%)" for display:flex and align-items:center in .sidebar css -->
    <div class="sidebar">
        <div>
            <hr class="sidebarLine"></hr>
            <div class="navText sidebarText">
                <!-- Hyperlink to the Products web page -->
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
