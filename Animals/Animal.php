<!-- 'Animals' => 'Insert/Delete/Update/Get/Search' -->
<!doctype html>
<html>
<head>
    <!-- Include index page (header) -->
    <?php include(__DIR__."/../index.php") ?>

    <title>Animals</title>
</head>
<body>
    <div class="sidebar">
        <div>
            <hr class="sidebarLine"></hr>
            <div class="navText sidebarText">
                <!-- Hyperlink to the Animals Insert page -->
                <a href="/Animals/Front/insert-animals.php" style="text-decoration:none;color:inherit">Insert New Animals</a>
            </div>
            <hr class="sidebarLine"></hr>
            <div class="navText sidebarText">Delete Animals</div>
            <hr class="sidebarLine"></hr>
            <div class="navText sidebarText">Update Animals</div>
            <hr class="sidebarLine"></hr>
            <div class="navText sidebarText">Get Animal Information</div>
            <hr class="sidebarLine"></hr>
            <div class="navText sidebarText">Search Animals</div>
            <hr class="sidebarLine"></hr>
        </div>
    </div>
</body>
</html>
