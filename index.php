<!doctype html>
<html>
<head>
    <link rel="stylesheet" href="styles.css">
    <title>Zoo-Project</title>
</head>
<body>
    <!-- <h1>Zoo-Project</h1> -->
    <?php

    // echo "Connecting to Azure SQL server..."."<br>"; 
    
    // PHP Data Objects(PDO) Sample Code:
    try {
        $conn = new PDO("sqlsrv:server = tcp:cosc3380projectsserver.database.windows.net,1433; Database = Zoo-Project-DB", "user1", "Password123");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch (PDOException $e) {
        print("Error connecting to SQL Server.");
        die(print_r($e));
    }

    // SQL Server Extension Sample Code:
    $connectionInfo = array("UID" => "user1", "pwd" => "Password123", "Database" => "Zoo-Project-DB", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
    $serverName = "tcp:cosc3380projectsserver.database.windows.net,1433";
    $conn = sqlsrv_connect($serverName, $connectionInfo);
    

    // echo "Successfully connected to Azure SQL server!"."<br>";
    // echo "<br>";

    ?>

    <!-- <p>Welcome to the Zoo!</p>
    <p>Please enter your information<p>
    <form action="" method="">
        <label>First Name:</label><input type="text" name="Fname"><br>
        <label>Last Name:</label><input type="text" name="Lname"><br>

        <button type="submit" name="submit">Submit</button>
    </form> -->

    <div class="header">
        <div class=headerNav>Employees</div>
        <div class=headerNav>Customers</div>
        <div class=headerNav>Products</div>
        <div class=headerNav>Stores</div>
        <div class=headerNav>Events</div>
        <div class=headerNav>Animals</div>
        <div class=headerNav>Enclosures</div>
    </div>
    <div class="sidebar"></div>

</body>
</html>
