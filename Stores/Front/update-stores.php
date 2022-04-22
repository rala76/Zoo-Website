<!doctype html>
<html>
<head>
    <!-- Include default Stores page -->
    <?php include(__DIR__."/../Stores.php"); ?>

    <title>Update Stores</title>
</head>
<body>
    <div class="form-base">
        <?php
        // Connect to Microsoft Azure SQL Database
        include(__DIR__."/../../connect-sql.php");

        // Declare
        $row = NULL;

        // Select Stores by ID & Fetch Stores Data to display
        if(isset($_POST["Stores-update-1"])) {
            $ID = $_POST["Stores-id"];

            // Info of Stores to be updated
            $sql_1 = "SELECT *
                FROM [dbo].[Stores]
                WHERE [Store_ID]='$ID'";
            
            $message = "Stores Found";
            
            $stmt_1 = sqlsrv_query($conn, $sql_1);
            if ($stmt_1 == false) {
                $message = "Failed to Find Stores";
            }
            else if (sqlsrv_has_rows($stmt_1) <= 0) {
                $message = "Store Not Found";
            }

            echo "<h2>$message</h2>";

            echo "<div class='break-row'></div>";

            // Fetch row from Stores
            $row = sqlsrv_fetch_array($stmt_1, SQLSRV_FETCH_ASSOC);    
        }

        // Update Stores Information
        if (isset($_POST["Stores-update-2"])) {
            $Category = $_POST["Stores-Category"];
            $Store_Name = $_POST["Stores-Store_Name"];
            $Hours_Of_Operation = $_POST["Stores-hours"];
            $Num_Customers = $_POST["Stores-Num_Customers"];
            $Weekly_Revenue = $_POST["Stores-Weekly_Revenue"];
            $Product_ID = $_POST["Stores-Product_ID"];
            $Department_ID = $_POST["Stores-Department_ID"];

            // Create update statement
            $ID = $_POST["Stores-id"];

            $sql_2 = "UPDATE [dbo].[Stores] 
                SET [Category] = '$Category'
                ,[Store_Name] = '$Store_Name'
                ,[Hours_Of_Operation] = '$Hours_Of_Operation'
                ,[Num_Customers] = '$Num_Customers'
                ,[Weekly_Revenue] = '$Weekly_Revenue'
                ,[Product_ID] = '$Product_ID'
                ,[Department_ID] = '$Department_ID'
                WHERE [Store_ID]='$ID'";
            
            $message = "Successfully Updated Stores";

            $stmt_2 = sqlsrv_query($conn, $sql_2);
            if ($stmt_2 == false || sqlsrv_rows_affected($stmt_2) <= 0) {
                $message = "Failed to Update Stores";
            }

            echo "<h2>$message</h2>";

            echo "<div class='break-row'></div>";

            // Info of updated Stores
            $sql_1 = "SELECT *
                FROM [dbo].[Stores]
                WHERE [Store_ID]='$ID'";
            
            $stmt_1 = sqlsrv_query($conn, $sql_1);

            // Fetch updated Stores from Stores
            $row = sqlsrv_fetch_array($stmt_1, SQLSRV_FETCH_ASSOC);
        }
        ?>

        <!-- Update form for Stores -->
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <p style="font-size:large"><b>Stores to Update:</b></p>

            <label class="required-input-label">Stores ID:</label>
            <input name="Stores-id" type="number" min="1" class="form-control"
            value="<?php echo isset($_POST['Stores-id']) ? $_POST['Stores-id'] : '' ?>">
            <br>

            <button name="Stores-update-1" type="submit" class="form-submit">Submit</button>

            <!-- ============================================================================== -->

            <p style="font-size:large"><b>Update Fields:</b></p>

            <label class="required-input-label">Category</label><br>
            <input name="Stores-Category" type="text" class="form-control"
            value="<?php echo isset($row['Category']) ? $row['Category'] : '' ?>">
            <br>

            <label class="required-input-label">Store Name</label><br>
            <input name="Stores-Store_Name" type="text" class="form-control"
            value="<?php echo isset($row['Store_Name']) ? $row['Store_Name'] : '' ?>">
            <br>

            <label class="required-input-label">Hours of Operation ( HH:MM[AM/PM]-HH:MM[AM/PM] )</label><br>
            <input name="Stores-hours" type="text" class="form-control"
            value="<?php echo isset($row['Hours_Of_Operation']) ? $row['Hours_Of_Operation']: '' ?>">
            <br>

            <label class="required-input-label">Number of Customers</label><br>
            <input name="Stores-Num_Customers" type="number" min="0" class="form-control"
            value="<?php echo isset($row['Num_Customers']) ? $row['Num_Customers'] : '' ?>">
            <br>

            <label class="input-label">Weekly Revenue</label><br>
            <input name="Stores-Weekly_Revenue" type="number" min="0" step="0.1" class="form-control" 
            value="<?php echo isset($row['Weekly_Revenue']) ? $row['Weekly_Revenue'] : $Weekly_Revenue ?>">
            <br>

            <label class="required-input-label">Product ID</label><br>
            <input name="Stores-Product_ID" type="number" min="1" class="form-control" 
            value="<?php echo isset($row['Product_ID']) ? $row['Product_ID'] : $Product_ID ?>">
            <br>

            <label class="required-input-label">Department ID</label><br>
            <input name="Stores-Department_ID" type="number" min="1" class="form-control"
            value="<?php echo isset($row['Department_ID']) ? $row['Department_ID'] : $Department_ID ?>">
            <br>

            <button name="Stores-update-2" type="submit" class="form-submit">Submit</button>
        </form>
    </div>
</body>
</html>
