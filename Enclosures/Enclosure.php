<!-- 'Enclosure' => 'Insert/Delete/Update/Get/Search' -->
<!doctype html>
<html>
<head>
    <!-- Include index page (header) -->
    <?php include(__DIR__."/../home.php") ?>

    <title>Enclosure</title>
</head>
<body>
    <div class="sidebar">
        <div>
            <hr class="sidebarLine"></hr>
            <div class="navText sidebarText">
                <!-- Hyperlink to the Enclosure Insert page -->
                <a href="/Enclosures/Front/insert-enclosures.php" style="text-decoration:none;color:inherit">Insert New Enclosure</a>
            </div>
            <hr class="sidebarLine"></hr>
            <div class="navText sidebarText">Delete Enclosure</div>
            <hr class="sidebarLine"></hr>
            <div class="navText sidebarText">Update Enclosure</div>
            <hr class="sidebarLine"></hr>
            <div class="navText sidebarText">Get Enclosure Information</div>
            <hr class="sidebarLine"></hr>
            <div class="navText sidebarText">Search Enclosure</div>
            <hr class="sidebarLine"></hr>
        </div>
    </div>
</body>
</html>
