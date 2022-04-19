<!doctype html>
<html>
<head>
    <!-- Include default Customer page -->
    <?php include(__DIR__."/../Customer.php"); ?>

    <title>Update Customer</title>
</head>
<body>
    <div class="form-base">
        <?php
        // Connect to Microsoft Azure SQL Database
        include(__DIR__."/../../connect-sql.php");

        // Declare
        $row = NULL;

        // Select Customer by ID & Fetch Customer Data to display
        if(isset($_POST["customer-update-1"])) {
            $ID = $_POST["customer-id"];

            // Info of customer to be updated
            $sql_1 = "SELECT *
                FROM [dbo].[Customer_Data] 
                WHERE [Customer_ID]='$ID'";
            
            // Status and error message to output on web page
            $message = "Customer Found";
            $error_msg = NULL;
            
            $stmt_1 = sqlsrv_query($conn, $sql_1);
            if ($stmt_1 == false) {
                $message = "Failed to Find Customer";
                $error_msg = sqlsrv_errors();
            }
            else if (sqlsrv_has_rows($stmt_1) <= 0) {
                $message = "Customer not found";
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

            echo "<div class='break-row'></div>";

            // Fetch row from Customer_Data
            $row = sqlsrv_fetch_array($stmt_1, SQLSRV_FETCH_ASSOC);    
        }

        // Update Customer Information
        if (isset($_POST["customer-update-2"])) {
            $Fname = $_POST["customer-Fname"];
            $Lname = $_POST["customer-Lname"];
            $Age = $_POST["customer-age"];

            // Create update statement
            $ID = $_POST["customer-id"];

            $sql_2 = "UPDATE [dbo].[Customer_Data] 
                SET [Fname] = '$Fname'
                ,[Lname] = '$Lname'
                ,[Age] = '$Age'
                WHERE [Customer_ID]='$ID'";
            
            // Status and error message to output on web page
            $message = "Successfully Updated Customer";
            $error_msg = NULL;

            $stmt_2 = sqlsrv_query($conn, $sql_2);
            if ($stmt_2 == false || sqlsrv_rows_affected($stmt_2) <= 0) {
                $message = "Failed to Update Customer";
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

            echo "<div class='break-row'></div>";

            // Info of updated customer
            $sql_1 = "SELECT *
                FROM [dbo].[Customer_Data] 
                WHERE [Customer_ID]='$ID'";
            
            $stmt_1 = sqlsrv_query($conn, $sql_1);

            // Fetch updated customer from Customer_Data
            $row = sqlsrv_fetch_array($stmt_1, SQLSRV_FETCH_ASSOC);
        }
        ?>

        <!-- Update form for Customer_Data -->
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <p style="font-size:large"><b>Customer to Update:</b></p>

            <label class="required-input-label">Customer ID:</label>
            <input name="customer-id" type="number" min="1" class="form-control"
            value="<?php echo isset($_POST['customer-id']) ? $_POST['customer-id'] : '' ?>">
            <br>

            <button name="customer-update-1" type="submit" class="form-submit">Submit</button>

            <!-- ============================================================================== -->

            <p style="font-size:large"><b>Update Fields:</b></p>

            <label class="required-input-label">First Name</label><br>
            <input name="customer-Fname" type="text" class="form-control"
            value="<?php echo isset($row['Fname']) ? $row['Fname'] : '' ?>">
            <br>

            <label class="required-input-label">Last Name</label><br>
            <input name="customer-Lname" type="text" class="form-control"
            value="<?php echo isset($row['Lname']) ? $row['Lname'] : '' ?>">
            <br>

            <label class="required-input-label">Age</label><br>
            <input name="customer-age" type="number" min="1" class="form-control"
            value="<?php echo isset($row['Age']) ? $row['Age'] : '' ?>">
            <br>

            <button name="customer-update-2" type="submit" class="form-submit">Submit</button>
        </form>
    </div>
</body>
</html>
