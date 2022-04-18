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
            <div>
                <a href="/Animals/Front/insert-animals.php"class="navText sidebarText">Insert New Animal</a>
            </div>
            <hr class="sidebarLine"></hr>
            <div>
                <a href="/Animals/Front/delete-animals.php"class="navText sidebarText">Delete Animal</a>
            </div>
            <hr class="sidebarLine"></hr>
            <div>
                <a href="/Animals/Front/update-animals.php"class="navText sidebarText">Update Animal</a>
            </div>
            <hr class="sidebarLine"></hr>
            <div>
                <a href="/Animals/Front/get-animal-information.php"class="navText sidebarText">Get Animal Information</a>
            </div>
            <hr class="sidebarLine"></hr>
            <div>
                <a href="/Animals/Front/search-animals.php"class="navText sidebarText">Search Animal</a>
            </div>
            <hr class="sidebarLine"></hr>
        </div>
    </div>
</body>
</html>
