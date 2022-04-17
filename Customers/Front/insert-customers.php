<!doctype html>
<html>
<head>
    <!-- Include default employee page -->
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
            <input name="Customer-Age" type="number" class="form-control" required
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
                ,[Age]
                ,[Customer_ID])
                VALUES 
                (?, ?, ?)";
            
            // Parameters of insert statement
            $params = array($Fname
                ,$Lname
                ,$Age
                ,$CustomerID
                );
            
            // Status and error message to output on web page
            $message = "Successfully Inserted New Employee";
            $error_msg = NULL;

            $stmt = sqlsrv_query($conn, $sql, $params);
            if ($stmt == false) {
                //die(print_r(sqlsrv_errors(), true));
                $message = "Failed to Insert New Employee";
                $error_msg = sqlsrv_errors();
            }
            
            // Output status and error message
            echo "<div>";
            echo "<h2>$message</h2>";
            echo "<details>";
            echo "<summary>Toggle Errors</summary>";
                if ($error_msg != NULL) {
                    foreach ( $error_msg as $error ) {
                        echo "<b>SQLSTATE: </b>".$error["SQLSTATE"]."<br>";
                        echo "<b>Code: </b> ".$error['code']."<br>";
                        echo "<b>Message: </b>".$error['message']."<br>";
                        echo "<br>";
                    }
                }
            echo "</details>";
            echo "</div>";
        }
        ?>
    </div>
</body>
</html>
