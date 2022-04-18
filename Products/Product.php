<!-- 'Products' => 'Insert/Delete/Update/Get/Search' -->
<!doctype html>
<html>
<head>
    <!-- Include index page (header) -->
    <?php include(__DIR__."/../index.php") ?>

    <title>Products</title>
</head>
<body>
    <div class="sidebar">
        <div>
            <hr class="sidebarLine"></hr>
            <a href="/Products/Front/insert-products.php" class="navText sidebarText">Insert New Product</a>
            <hr class="sidebarLine"></hr>
            <a href="/Products/Front/delete-products.php" class="navText sidebarText">Delete Product</a>
            <hr class="sidebarLine"></hr>
            <a href="/Products/Front/update-products.php" class="navText sidebarText">Update Product</a>
            <hr class="sidebarLine"></hr>
            <a href="/Products/Front/get-product-information.php" class="navText sidebarText">Get Product Information</a>
            <hr class="sidebarLine"></hr>
            <a href="/Products/Front/search-products.php" class="navText sidebarText">Search Product</a>
            <hr class="sidebarLine"></hr>
        </div>
    </div>
</body>
</html>
