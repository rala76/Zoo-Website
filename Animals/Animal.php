<!-- 'Animals' => 'Insert/Delete/Update/Get/Search' -->
<!doctype html>
<html>
<head>
    <!-- Include index page (header) -->
    <?php include(__DIR__."/../index.php") ?>

    <title>Animals</title>
</head>
<body>
    <!-- This part is going to need to be refactored into a component to look way nicer -->
    <!-- Replaced style="transform:translateY(50%)" for display:flex and align-items:center in .sidebar css -->
    <div class="sidebar">
        <div>
            <hr class="sidebarLine"></hr>
            <div class="navText sidebarText">
                <!-- Hyperlink to the Animals web page -->
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
