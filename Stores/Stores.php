<!-- 'Stores' => 'Insert/Delete/Update/Get/Search' -->
<!doctype html>
<html>
<head>
    <!-- Include index page (header) -->
    <?php include(__DIR__."/../index.php") ?>

    <title>Stores</title>
</head>
<body>
    <div class="sidebar">
        <div>
            <hr class="sidebarLine"></hr>
            <a href="/Stores/Front/insert-stores.php" class="navText sidebarText">Insert New Store</a>
            <hr class="sidebarLine"></hr>
            <a href="/Stores/Front/delete-stores.php" class="navText sidebarText">Delete Store</a>
            <hr class="sidebarLine"></hr>
            <a href="/Stores/Front/update-stores.php" class="navText sidebarText">Update Store</a>
            <hr class="sidebarLine"></hr>
            <a href="/Stores/Front/get-store-information.php" class="navText sidebarText">Get Store Information</a>
            <hr class="sidebarLine"></hr>
            <a href="/Stores/Front/search-stores.php" class="navText sidebarText">Search Store</a>
            <hr class="sidebarLine"></hr>
        </div>
    </div>
</body>
</html>
