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
            <a href="/Animals/Front/insert-animals.php"class="navText sidebarText">Insert New Animal</a>
            <hr class="sidebarLine"></hr>
            <a href="/Animals/Front/delete-animals.php"class="navText sidebarText">Delete Animal</a>
            <hr class="sidebarLine"></hr>
            <a href="/Animals/Front/update-animals.php"class="navText sidebarText">Update Animal</a>
            <hr class="sidebarLine"></hr>
            <a href="/Animals/Front/get-animal-information.php"class="navText sidebarText">Get Animal Information</a>
            <hr class="sidebarLine"></hr>
            <a href="/Animals/Front/search-animals.php"class="navText sidebarText">Search Animals</a>
            <hr class="sidebarLine"></hr>
            <a href="/Animals/Front/view-animal-table.php"class="navText sidebarText">View Animal Table</a>
            <hr class="sidebarLine"></hr>
        </div>
    </div>
</body>
</html>
