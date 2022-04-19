<!doctype html>
<html>
<head>
    <!-- Include default Animal page -->
    <?php include(__DIR__."/../Animal.php"); ?>

    <title>Update Animal</title>
</head>
<body>
    <div class="form-base">
        <?php
        // Connect to Microsoft Azure SQL Database
        include(__DIR__."/../../connect-sql.php");

        // Declare
        $row = NULL;

        // Select Animal by ID & Fetch Animal Data to display
        if(isset($_POST["Animal-update-1"])) {
            $ID = $_POST["Animal-id"];

            // Info of Animal to be updated
            $sql_1 = "SELECT *
                FROM [dbo].[Animal_Data] 
                WHERE [Animal_ID]='$ID'";
            
            // Status and error message to output on web page
            $message = "Animal Found";
            $error_msg = NULL;
            
            $stmt_1 = sqlsrv_query($conn, $sql_1);
            if ($stmt_1 == false) {
                $message = "Failed to Find Animal";
                $error_msg = sqlsrv_errors();
            }
            else if (sqlsrv_has_rows($stmt_1) <= 0) {
                $message = "Animal not found";
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

            // Fetch row from Animal_Data
            $row = sqlsrv_fetch_array($stmt_1, SQLSRV_FETCH_ASSOC);    
        }

        // Update Animal Information
        if (isset($_POST["Animal-update-2"])) {
            $Name = $_POST["Animal-Name"];
            $Species = $_POST["Animal-Species"];
            $Date_Of_Birth = $_POST["Animal-date-of-birth"];
            $Gender = $_POST["Animal-gender"];
            $Enclosure_ID = $_POST["Animal-enclosure-id"];

            // Create update statement
            $ID = $_POST["Animal-id"];

            $sql_2 = "UPDATE [dbo].[Animal_Data] 
                SET [Animal_Name] = '$Name'
                ,[Species] = '$Species'
                ,[Date_Of_Birth] = '$Date_Of_Birth'
                ,[Gender] = '$Gender'
                ,[Enclosure_ID] = '$Enclosure_ID'
                WHERE [Animal_ID]='$ID'";
            
            // Status and error message to output on web page
            $message = "Successfully Updated Animal";
            $error_msg = NULL;

            $stmt_2 = sqlsrv_query($conn, $sql_2);
            if ($stmt_2 == false || sqlsrv_rows_affected($stmt_2) <= 0) {
                $message = "Failed to Update Animal";
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

            // Info of updated Animal
            $sql_1 = "SELECT *
                FROM [dbo].[Animal_Data] 
                WHERE [Animal_ID]='$ID'";
            
            $stmt_1 = sqlsrv_query($conn, $sql_1);

            // Fetch updated Animal from Animal_Data
            $row = sqlsrv_fetch_array($stmt_1, SQLSRV_FETCH_ASSOC);
        }
        ?>

        <!-- Update form for Animal_Data -->
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <p style="font-size:large"><b>Animal to Update:</b></p>

            <label class="required-input-label">Animal ID:</label>
            <input name="Animal-id" type="number" min="1" class="form-control"
            value="<?php echo isset($_POST['Animal-id']) ? $_POST['Animal-id'] : '' ?>">
            <br>

            <button name="Animal-update-1" type="submit" class="form-submit">Submit</button>

            <!-- ============================================================================== -->

            <p style="font-size:large"><b>Update Fields:</b></p>

            <label class="required-input-label">Animal Name</label><br>
            <input name="Animal-Name" type="text" class="form-control"
            value="<?php echo isset($row['Animal_Name']) ? $row['Animal_Name'] : '' ?>">
            <br>

            <label class="required-input-label">Species</label><br>
            <input name="Animal-Species" type="text" class="form-control"
            value="<?php echo isset($row['Species']) ? $row['Species'] : '' ?>">
            <br>

            <label class="required-input-label">Date of Birth (YYYY-MM-DD)</label><br>
            <input name="Animal-date-of-birth" type="text" class="form-control"
            value="<?php echo isset($row['Date_Of_Birth']) ? $row['Date_Of_Birth']->format('Y-m-d') : '' ?>">
            <br>

            <!-- Dropdown list for Gender -->
            <label class="required-input-label">Gender</label><br>
            <select name="Animal-gender" class="dropdown-control">
                <!-- Default option -->
                <option value="<?php echo isset($row['Gender']) ? $row['Gender'] : '' ?>" hidden>
                    <?php echo isset($row['Gender']) ? $row['Gender'] : 'Select an Option' ?>
                </option>

                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select><br>

            <label class="input-label">Enclosure ID</label><br>
            <input name="Animal-enclosure-id" type="number" min="1" class="form-control" 
            value="<?php echo isset($row['Enclosure_ID']) ? $row['Enclosure_ID'] : $Enclosure_ID ?>">
            <br>

            <button name="Animal-update-2" type="submit" class="form-submit">Submit</button>
        </form>
    </div>
</body>
</html>
