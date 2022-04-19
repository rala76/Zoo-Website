<!doctype html>
<html>
<head>
    <!-- Include default Enclosure page -->
    <?php include(__DIR__."/../Enclosure.php"); ?>

    <title>Update Enclosure</title>
</head>
<body>
    <div class="form-base">
        <?php
        // Connect to Microsoft Azure SQL Database
        include(__DIR__."/../../connect-sql.php");

        // Declare
        $row = NULL;

        // Select Enclosure by ID & Fetch Enclosure Data to display
        if(isset($_POST["Enclosure-update-1"])) {
            $ID = $_POST["Enclosure-id"];

            // Info of Enclosure to be updated
            $sql_1 = "SELECT *
                FROM [dbo].[Enclosure_Data] 
                WHERE [Enclosure_ID]='$ID'";
            
            // Status and error message to output on web page
            $message = "Enclosure Found";
            $error_msg = NULL;
            
            $stmt_1 = sqlsrv_query($conn, $sql_1);
            if ($stmt_1 == false) {
                $message = "Failed to Find Enclosure";
                $error_msg = sqlsrv_errors();
            }
            else if (sqlsrv_has_rows($stmt_1) <= 0) {
                $message = "Enclosure not found";
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

            // Fetch row from Enclosure_Data
            $row = sqlsrv_fetch_array($stmt_1, SQLSRV_FETCH_ASSOC);    
        }

        // Update Enclosure Information
        if (isset($_POST["Enclosure-update-2"])) {
            $Maintenance_Fees = $_POST["Enclosure-Maintenance_Fees"];
            $Num_Animals = $_POST["Enclosure-Num_Animals"];
            $Department_ID = $_POST["Enclosure-Department_ID"];

            // Create update statement
            $ID = $_POST["Enclosure-id"];

            $sql_2 = "UPDATE [dbo].[Enclosure_Data] 
                SET [Maintenance_Fees] = '$Maintenance_Fees'
                ,[Num_Animals] = '$Num_Animals'
                ,[Department_ID] = '$Department_ID'
    
                WHERE [Enclosure_ID]='$ID'";
            
            // Status and error message to output on web page
            $message = "Successfully Updated Enclosure";
            $error_msg = NULL;

            $stmt_2 = sqlsrv_query($conn, $sql_2);
            if ($stmt_2 == false || sqlsrv_rows_affected($stmt_2) <= 0) {
                $message = "Failed to Update Enclosure";
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

            // Info of updated Enclosure
            $sql_1 = "SELECT *
                FROM [dbo].[Enclosure_Data] 
                WHERE [Enclosure_ID]='$ID'";
            
            $stmt_1 = sqlsrv_query($conn, $sql_1);

            // Fetch updated Enclosure from Enclosure_Data
            $row = sqlsrv_fetch_array($stmt_1, SQLSRV_FETCH_ASSOC);
        }
        ?>

        <!-- Update form for Enclosure_Data -->
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <p style="font-size:large"><b>Enclosure to Update:</b></p>

            <label class="required-input-label">Enclosure ID:</label>
            <input name="Enclosure-id" type="number" min="1" class="form-control"
            value="<?php echo isset($_POST['Enclosure-id']) ? $_POST['Enclosure-id'] : '' ?>">
            <br>

            <button name="Enclosure-update-1" type="submit" class="form-submit">Submit</button>

            <!-- ============================================================================== -->

            <p style="font-size:large"><b>Update Fields:</b></p>

            <label class="required-input-label">Maintenance Fees</label><br>
            <input name="Enclosure-Maintenance_Fees" type="number" min="0" step="0.1" class="form-control"
            value="<?php echo isset($row['Maintenance_Fees']) ? $row['Maintenance_Fees'] : '' ?>">
            <br>

            <label class="required-input-label">Number of Animals</label><br>
            <input name="Enclosure-Num_Animals" type="number" min="0" class="form-control"
            value="<?php echo isset($row['Num_Animals']) ? $row['Num_Animals'] : '' ?>">
            <br>

            <label class="required-input-label">Department ID</label><br>
            <input name="Enclosure-Department_ID" type="number" min="1" class="form-control"
            value="<?php echo isset($row['Department_ID']) ? $row['Department_ID'] : '' ?>">
            <br>
         
            <button name="Enclosure-update-2" type="submit" class="form-submit">Submit</button>
        </form>
    </div>
</body>
</html>
