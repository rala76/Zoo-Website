<!doctype html>
<html>
<head>
    <!-- Include default Employee page -->
    <?php include(__DIR__."/../Employee.php"); ?>

    <title>Update Employee</title>
</head>
<body>
    <div class="form-base">
        <?php
        // Connect to Microsoft Azure SQL Database
        include(__DIR__."/../../connect-sql.php");

        // Declare
        $row = NULL;

        // Select Employee by ID & Fetch Employee Data to display
        if(isset($_POST["employee-update-1"])) {
            $ID = $_POST["employee-id"];

            // Info of employee to be updated
            $sql_1 = "SELECT *
                FROM [dbo].[Employee_Data] 
                WHERE [Employee_ID]='$ID'";
            
            // Status and error message to output on web page
            $message = "Employee Found";
            $error_msg = NULL;
            
            $stmt_1 = sqlsrv_query($conn, $sql_1);
            if ($stmt_1 == false) {
                $message = "Failed to Find Employee";
                $error_msg = sqlsrv_errors();
            }
            else if (sqlsrv_has_rows($stmt_1) <= 0) {
                $message = "Employee not found";
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

            // Fetch row from Employee_Data
            $row = sqlsrv_fetch_array($stmt_1, SQLSRV_FETCH_ASSOC);    
        }

        // Update Employee Information
        if (isset($_POST["employee-update-2"])) {
            $Fname = $_POST["employee-Fname"];
            $Lname = $_POST["employee-Lname"];
            $Date_Of_Birth = $_POST["employee-date-of-birth"];
            $Gender = $_POST["employee-gender"];
            $Phone_Number = !empty($_POST["employee-phone-number"]) ? $_POST["employee-phone-number"] : NULL;
            $Department_Name = $_POST["employee-department-name"];
            $Department_ID = $_POST["employee-department-id"];
            $Hourly_Wage = !empty($_POST["employee-hourly-wage"]) ? $_POST["employee-hourly-wage"] : "0";
            $Weekly_Wage = !empty($_POST["employee-weekly-wage"]) ? $_POST["employee-weekly-wage"] : "0";
            $Weekly_Hours_Worked = !empty($_POST["employee-weekly-hours-worked"]) ? $_POST["employee-weekly-hours-worked"] : "0";

            // Create update statement
            $ID = $_POST["employee-id"];

            $sql_2 = "UPDATE [dbo].[Employee_Data] 
                SET [Fname] = '$Fname'
                ,[Lname] = '$Lname'
                ,[Date_Of_Birth] = '$Date_Of_Birth'
                ,[Gender] = '$Gender'
                ,[Phone_Number] = '$Phone_Number'
                ,[Department_Name] = '$Department_Name'
                ,[Department_ID] = '$Department_ID'
                ,[Hourly_Wage] = '$Hourly_Wage'
                ,[Weekly_Wage] = '$Weekly_Wage'
                ,[Weekly_Hours_Worked] = '$Weekly_Hours_Worked'
                WHERE [Employee_ID]='$ID'";
            
            // Status and error message to output on web page
            $message = "Successfully Updated Employee";
            $error_msg = NULL;

            $stmt_2 = sqlsrv_query($conn, $sql_2);
            if ($stmt_2 == false || sqlsrv_rows_affected($stmt_2) <= 0) {
                $message = "Failed to Update Employee";
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

            // Info of updated employee
            $sql_1 = "SELECT *
                FROM [dbo].[Employee_Data] 
                WHERE [Employee_ID]='$ID'";
            
            $stmt_1 = sqlsrv_query($conn, $sql_1);

            // Fetch updated employee from Employee_Data
            $row = sqlsrv_fetch_array($stmt_1, SQLSRV_FETCH_ASSOC);
        }
        ?>

        <!-- Update form for Employee_Data -->
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <p style="font-size:large"><b>Employee to Update:</b></p>

            <label class="required-input-label">Employee ID:</label>
            <input name="employee-id" type="number" min="1" class="form-control"
            value="<?php echo isset($_POST['employee-id']) ? $_POST['employee-id'] : '' ?>">
            <br>

            <button name="employee-update-1" type="submit" class="form-submit">Submit</button>

            <!-- ============================================================================== -->

            <p style="font-size:large"><b>Update Fields:</b></p>

            <label class="required-input-label">First Name</label><br>
            <input name="employee-Fname" type="text" class="form-control"
            value="<?php echo isset($row['Fname']) ? $row['Fname'] : '' ?>">
            <br>

            <label class="required-input-label">Last Name</label><br>
            <input name="employee-Lname" type="text" class="form-control"
            value="<?php echo isset($row['Lname']) ? $row['Lname'] : '' ?>">
            <br>

            <label class="required-input-label">Date of Birth (YYYY-MM-DD)</label><br>
            <input name="employee-date-of-birth" type="text" class="form-control"
            value="<?php echo isset($row['Date_Of_Birth']) ? $row['Date_Of_Birth']->format('Y-m-d') : '' ?>">
            <br>

            <!-- Dropdown list for Gender -->
            <label class="required-input-label">Gender</label><br>
            <select name="employee-gender" class="dropdown-control">
                <!-- Default option -->
                <option value="<?php echo isset($row['Gender']) ? $row['Gender'] : '' ?>" hidden>
                    <?php echo isset($row['Gender']) ? $row['Gender'] : 'Select an Option' ?>
                </option>

                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select><br>

            <label class="input-label">Phone Number (###-###-####)</label><br>
            <input name="employee-phone-number" type="text" class="form-control" placeholder="NULL"
            value="<?php echo isset($row['Phone_Number']) ? $row['Phone_Number'] : NULL ?>">
            <br>

            <!-- Dropdown list for Department_Name -->
            <label class="required-input-label">Department Name</label><br>
            <select name="employee-department-name" class="dropdown-control">
                <!-- Default option -->
                <option value="<?php echo isset($row['Department_Name']) ? $row['Department_Name'] : '' ?>" hidden>
                    <?php echo isset($row['Department_Name']) ? $row['Department_Name'] : 'Select an Option' ?>
                </option>

                <option value="Animal Enclosure">Animal Enclosure</option>
                <option value="Stores">Stores</option>
                <option value="Ticket Office">Ticket Office</option>
            </select><br>

            <label class="required-input-label">Department ID</label><br>
            <input name="employee-department-id" type="number" min="1" class="form-control" placeholder="NULL"
            value="<?php echo isset($row['Department_ID']) ? $row['Department_ID'] : '' ?>">
            <br>

            <label class="input-label">Hourly Wage</label><br>
            <input name="employee-hourly-wage" type="number" min="0" step="0.01" class="form-control" placeholder="NULL"
            value="<?php echo isset($row['Hourly_Wage']) ? $row['Hourly_Wage'] : NULL ?>">
            <br>

            <label class="input-label">Weekly Wage</label><br>
            <input name="employee-weekly-wage" type="number" min="0" step="0.01" class="form-control" placeholder="NULL"
            value="<?php echo isset($row['Weekly_Wage']) ? $row['Weekly_Wage'] : NULL ?>">
            <br>

            <label class="input-label">Weekly Hours Worked</label><br>
            <input name="employee-weekly-hours-worked" type="number" min="0" class="form-control" placeholder="0"
            value="<?php echo isset($row['Weekly_Hours_Worked']) ? $row['Weekly_Hours_Worked'] : '0' ?>">
            <br>

            <button name="employee-update-2" type="submit" class="form-submit">Submit</button>
        </form>
    </div>
</body>
</html>
