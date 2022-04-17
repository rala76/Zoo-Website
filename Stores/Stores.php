<!-- 'Stores' => 'Insert/Delete/Update/Get/Search' -->
<!doctype html>
<html>
<head>
    <!-- Include index page (header) -->
    <?php include(__DIR__."/../index.php") ?>

    <title>Stores</title>
</head>
<body>
    <!-- This part is going to need to be refactored into a component to look way nicer -->
    <!-- Replaced style="transform:translateY(50%)" for display:flex and align-items:center in .sidebar css -->
    <div class="sidebar">
        <div>
            <hr class="sidebarLine"></hr>
            <div class="navText sidebarText">
                <!-- Hyperlink to the Stores web page -->
                <a href="/Stores/Front/insert-store.php" style="text-decoration:none;color:inherit">Insert New Stores</a>
            </div>
            <hr class="sidebarLine"></hr>
            <div class="navText sidebarText">Delete Stores</div>
            <hr class="sidebarLine"></hr>
            <div class="navText sidebarText">Update Stores</div>
            <hr class="sidebarLine"></hr>
            <div class="navText sidebarText">Get Store Information</div>
            <hr class="sidebarLine"></hr>
            <div class="navText sidebarText">Search Stores</div>
            <hr class="sidebarLine"></hr>
        </div>
    </div>
</body>
</html>
