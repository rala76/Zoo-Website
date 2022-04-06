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
        <div class="navText">Employees</div>
        <div class="navText">Customers</div>
        <div class="navText">Products</div>
        <div class="navText">Stores</div>
        <div class="navText">Events</div>
        <div class="navText">Animals</div>
        <div class="navText">Enclosures</div>
    </div>
    <!-- This part is going to need to be refactored into a component to look way nicer -->
    <div class="sidebar">
        <div style="transform:translateY(50%)">
            <hr class="sidebarLine"></hr>
            <div class="navText sidebarText">Insert New Employee</div>
            <hr class="sidebarLine"></hr>
            <div class="navText sidebarText">Delete Employee</div>
            <hr class="sidebarLine"></hr>
            <div class="navText sidebarText">Update Employee</div>
            <hr class="sidebarLine"></hr>
            <div class="navText sidebarText">Get Employee Information</div>
            <hr class="sidebarLine"></hr>
            <div class="navText sidebarText">Search Employees</div>
            <hr class="sidebarLine"></hr>
        </div>
    </div>

</body>
</html>
