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
            <a href="/Events/Front/insert-events.php" class="navText sidebarText">Insert New Event</a>
            <hr class="sidebarLine"></hr>
            <a href="/Events/Front/delete-events.php" class="navText sidebarText">Delete Event</a>
            <hr class="sidebarLine"></hr>
            <a href="/Events/Front/update-events.php" class="navText sidebarText">Update Event</a>
            <hr class="sidebarLine"></hr>
            <a href="/Events/Front/get-event-information.php" class="navText sidebarText">Get Event Information</a>
            <hr class="sidebarLine"></hr>
            <a href="/Events/Front/search-events.php" class="navText sidebarText">Search Event</a>
            <hr class="sidebarLine"></hr>
        </div>
    </div>
</body>
</html>
