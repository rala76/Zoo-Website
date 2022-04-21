<!-- 'Enclosure' => 'Insert/Delete/Update/Get/Search' -->
<!doctype html>
<html>
<head>
    <!-- Check session -->
    <?php include_once(__DIR__."/../check-session.php") ?>

    <!-- Include index page (header) -->
    <?php include(__DIR__."/../Login/admin-home.php") ?>

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
            <a href="/Enclosures/Front/search-enclosures.php" class="navText sidebarText">Search Enclosures</a>
            <hr class="sidebarLine"></hr>
        </div>
    </div>
</body>
</html>
