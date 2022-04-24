<!doctype html>
<html>
<head>
    <!-- Check session -->
    <?php include_once(__DIR__."/../check-session.php") ?>
    
    <link rel="stylesheet" href="/Styles/styles.css">
    <title>Admin Home Page</title>
</head>
<body>
    <div class="header">
        <a href="/Login/tables.php" class="navText">Tables</a>
        <a href="/Departments/search-departments.php" class="navText">Departments</a>
        <a href="/Statistics/statistics.php" class="navText">Statistics</a>
        <a href="/Login/logout.php" style="float:right;margin-right:3vh" class="navText">Logout</a>
    </div>
</body>
</html>