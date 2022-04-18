<!-- 'Events' => 'Insert/Delete/Update/Get/Search' -->
<!doctype html>
<html>
<head>
    <!-- Include index page (header) -->
    <?php include(__DIR__."/../index.php") ?>

    <title>Events</title>
</head>
<body>
    <div class="sidebar">
        <div>
            <hr class="sidebarLine"></hr>
            <div class="navText sidebarText">
                <!-- Hyperlink to the Events Insert page -->
                <a href="/Events/Front/insert-Event.php" style="text-decoration:none;color:inherit">Insert New Events</a>
            </div>
            <hr class="sidebarLine"></hr>
            <div class="navText sidebarText">Delete Events</div>
            <hr class="sidebarLine"></hr>
            <div class="navText sidebarText">Update Events</div>
            <hr class="sidebarLine"></hr>
            <div class="navText sidebarText">Get Event Information</div>
            <hr class="sidebarLine"></hr>
            <div class="navText sidebarText">Search Events</div>
            <hr class="sidebarLine"></hr>
        </div>
    </div>
</body>
</html>
