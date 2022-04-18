<!-- 'Enclosure' => 'Insert/Delete/Update/Get/Search' -->
<!doctype html>
<html>
<head>
    <!-- Include index page (header) -->
    <?php include(__DIR__."/../index.php") ?>

    <title>Enclosure</title>
</head>
<body>
    <div class="sidebar">
        <div>
            <hr class="sidebarLine"></hr>
            <a href="/Enclosures/Front/insert-enclosures.php" class="navText sidebarText">Insert New Enclosure</a>
            <hr class="sidebarLine"></hr>
            <a href="/Enclosures/Front/delete-enclosures.php" class="navText sidebarText">Delete Enclosure</a>
            <hr class="sidebarLine"></hr>
            <a href="/Enclosures/Front/update-enclosures.php" class="navText sidebarText">Update Enclosure</a>
            <hr class="sidebarLine"></hr>
            <a href="/Enclosures/Front/get-enclosure-information.php" class="navText sidebarText">Get Enclosure Information</a>
            <hr class="sidebarLine"></hr>
            <a href="/Enclosures/Front/search-enclosure.php" class="navText sidebarText">Search Enclosure</a>
            <hr class="sidebarLine"></hr>
        </div>
    </div>
</body>
</html>
