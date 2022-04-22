<!doctype html>
<html>
<head>
    <!-- Include default Customer page -->
    <?php include(__DIR__."/../Customer.php"); ?>

    <title>Insert New Customer</title>
</head>
<body>
    <div class="form-base">
        <!-- Insert form for Employee_Data -->
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            
        <label class="required-input-label">First Name</label><br>
            <input name="Customer-Fname" type="text" class="form-control" required
            value="<?php echo isset($_POST['Customer-Fname']) ? $_POST['Customer-Fname'] : '' ?>">
            <br>

            <label class="required-input-label">Last Name</label><br>
            <input name="Customer-Lname" type="text" class="form-control" required
            value="<?php echo isset($_POST['Customer-Lname']) ? $_POST['Customer-Lname'] : '' ?>">
            <br>

            <label class="input-label">Age</label><br>
            <input name="Customer-Age" type="number" min="1" class="form-control" required
            value="<?php echo isset($_POST['Customer-Age']) ? $_POST['Customer-Age'] : '' ?>">
            <br>
            
            <button name="Customer-submit" type="submit" class="form-submit">Submit</button>
        </form>
    
        <?php
        // Connect to Microsoft Azure SQL Database
        include(__DIR__."/../../connect-sql.php");

        // Get data from employee form once submit button is pressed
        if(isset($_POST["Customer-submit"])) {
            $Fname = $_POST["Customer-Fname"];
            $Lname = $_POST["Customer-Lname"];
            $Age=!empty($_POST["Customer-Age"]) ? $_POST["Customer-Age"] : NULL;

            // Create insert statement
            $sql = "INSERT INTO [dbo].[Customer_Data] 
                ([Fname]
                ,[Lname]
                ,[Age])
                VALUES 
                (?, ?, ?)";
            
            // Parameters of insert statement
            $params = array($Fname
                ,$Lname
                ,$Age);

            $message = "Successfully Inserted New Customer";

            $stmt = sqlsrv_query($conn, $sql, $params);
            if ($stmt == false) {
                $message = "Failed to Insert New Customer";
            }
            
            echo "<h2>$message</h2>";
        }
        ?>
    </div>
</body>
</html>
