<?php
// Include process code for forms & tables
include(__DIR__."/process-reports.php");
?>

<!doctype html>
<html>
<head>
    <!-- Check session -->
    <?php include_once(__DIR__."/../check-session.php") ?>

    <!-- Include index page (header) -->
    <?php include(__DIR__."/../Login/admin-home.php") ?>

    <title>Admin Reports</title>
    <link rel="stylesheet" href="/Styles/styles.css">
    <link rel="stylesheet" href="/Styles/reportStyles.css">
    <script src="https://kit.fontawesome.com/e9a5785044.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="report" style="color:#A9C47F;">
        <i class="fa-solid fa-otter fa-5x"></i>
        <h1>199</h1>
        <h1 class="bottom" style="background-color:#A9C47F;">
            <a href>Animals In Zoo</a>
        </h1>
    </div>
    <div class="report" style="color:#006747;">
        <i class="fa-solid fa-people-line fa-5x"></i>
        <h1>199</h1>
        <h1 class="bottom" style="background-color:#006747;">
            <a href>Customers Visited</a>
        </h1>
    </div>
    <div class="report" style="color:#004F59;">
        <i class="fa-solid fa-store fa-5x"></i>
        <h1>199</h1>
        <h1 class="bottom" style="background-color:#004F59;">
            <a href>Stores Operating</a>
        </h1>
    </div>
    <div class="report" style="color:#006747;">
        <i class="fa-regular fa-calendar fa-5x"></i>
        <h1>199</h1>
        <h1 class="bottom" style="background-color:#006747;">
            <a href>Events Held</a>
        </h1>
    </div>
    <div class="report" style="color:#004F59;">
        <i class="fa-solid fa-user-tie fa-5x"></i>
        <h1>199</h1>
        <h1 class="bottom" style="background-color:#004F59;">
            <a href>Employees Hired</a>
        </h1>
    </div>
    <div class="report" style="color:#A9C47F;">
        <i class="fa-solid fa-ticket fa-5x"></i>
        <h1>199</h1>
        <h1 class="bottom" style="background-color:#A9C47F;">
            <a href>Products Sold</a>
        </h1>
    </div>
</body>
</html>
