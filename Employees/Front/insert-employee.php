<!doctype html>
<html>
<head>
    <!-- Include default Employee page -->
    <?php include(__DIR__."/../Employee.php"); ?>

    <title>Insert New Employee</title>
</head>
<body>
    <div class="form-base">
        <!-- Insert form for Employee_Data -->
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <label class="required-input-label">First Name</label><br>
            <input name="employee-Fname" type="text" class="form-control" required
            value="<?php echo isset($_POST['employee-Fname']) ? $_POST['employee-Fname'] : '' ?>">
            <br>

            <label class="required-input-label">Last Name</label><br>
            <input name="employee-Lname" type="text" class="form-control" required
            value="<?php echo isset($_POST['employee-Lname']) ? $_POST['employee-Lname'] : '' ?>">
            <br>

            <label class="required-input-label">Date of Birth (YYYY-MM-DD)</label><br>
            <input name="employee-date-of-birth" type="text" class="form-control" required
            value="<?php echo isset($_POST['employee-date-of-birth']) ? $_POST['employee-date-of-birth'] : '' ?>">
            <br>

            <!-- Dropdown list for Gender -->
            <label class="required-input-label">Gender</label><br>
            <select name="employee-gender" class="dropdown-control" required>
                <!-- Default option -->
                <option value="<?php echo isset($_POST['employee-gender']) ? $_POST['employee-gender'] : '' ?>" hidden>
                    <?php echo isset($_POST['employee-gender']) ? $_POST['employee-gender'] : 'Select an Option' ?>
                </option>

                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select><br>

            <label class="input-label">Phone Number (###-###-####)</label><br>
            <input name="employee-phone-number" type="text" class="form-control" placeholder="NULL"
            value="<?php echo isset($_POST['employee-phone-number']) ? $_POST['employee-phone-number'] : '' ?>">
            <br>

            <!-- Dropdown list for Department_Name -->
            <label class="required-input-label">Department Name</label><br>
            <select name="employee-department-name" class="dropdown-control" required>
                <!-- Default option -->
                <option value="<?php echo isset($_POST['employee-department-name']) ? $_POST['employee-department-name'] : '' ?>" hidden>
                    <?php echo isset($_POST['employee-department-name']) ? $_POST['employee-department-name'] : 'Select an Option' ?>
                </option>

                <option value="Animal Enclosure">Animal Enclosure</option>
                <option value="Stores">Stores</option>
                <option value="Ticket Office">Ticket Office</option>
            </select><br>

            <label class="required-input-label">Department ID</label><br>
            <input name="employee-department-id" type="number" min="1" class="form-control" placeholder="NULL" required
            value="<?php echo isset($_POST['employee-department-id']) ? $_POST['employee-department-id'] : '' ?>">
            <br>

            <label class="input-label">Hourly Wage</label><br>
            <input name="employee-hourly-wage" type="number" min="1" step="0.01" class="form-control" placeholder="NULL"
            value="<?php echo isset($_POST['employee-hourly-wage']) ? $_POST['employee-hourly-wage'] : '' ?>">
            <br>

            <label class="input-label">Weekly Wage</label><br>
            <input name="employee-weekly-wage" type="number" min="1" step="0.01" class="form-control" placeholder="NULL"
            value="<?php echo isset($_POST['employee-weekly-wage']) ? $_POST['employee-weekly-wage'] : '' ?>">
            <br>

            <label class="input-label">Weekly Hours Worked</label><br>
            <input name="employee-weekly-hours-worked" type="number" min="0" class="form-control" placeholder="0"
            value="<?php echo isset($_POST['employee-weekly-hours-worked']) ? $_POST['employee-weekly-hours-worked'] : '' ?>">
            <br>

            <button name="employee-submit" type="submit" class="form-submit">Submit</button>
        </form>
    
        <?php
        // Connect to Microsoft Azure SQL Database
        include(__DIR__."/../../connect-sql.php");

        // Get data from employee form once submit button is pressed
        if(isset($_POST["employee-submit"])) {
            $Fname = $_POST["employee-Fname"];
            $Lname = $_POST["employee-Lname"];
            $Date_Of_Birth = $_POST["employee-date-of-birth"];
            $Gender = $_POST["employee-gender"];
            $Phone_Number = !empty($_POST["employee-phone-number"]) ? $_POST["employee-phone-number"] : NULL;
            $Department_Name = $_POST["employee-department-name"];
            $Department_ID = $_POST["employee-department-id"];
            $Hourly_Wage = !empty($_POST["employee-hourly-wage"]) ? $_POST["employee-hourly-wage"] : NULL;
            $Weekly_Wage = !empty($_POST["employee-weekly-wage"]) ? $_POST["employee-weekly-wage"] : NULL;
            $Weekly_Hours_Worked = !empty($_POST["employee-weekly-hours-worked"]) ? $_POST["employee-weekly-hours-worked"] : "0";

            // Create insert statement
            $sql = "INSERT INTO [dbo].[Employee_Data] 
                ([Fname]
                ,[Lname]
                ,[Date_Of_Birth]
                ,[Gender]
                ,[Phone_Number]
                ,[Department_Name]
                ,[Department_ID]
                ,[Hourly_Wage]
                ,[Weekly_Wage]
                ,[Weekly_Hours_Worked])
                VALUES 
                (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            
            // Parameters of insert statement
            $params = array($Fname
                ,$Lname
                ,$Date_Of_Birth
                ,$Gender
                ,$Phone_Number
                ,$Department_Name
                ,$Department_ID
                ,$Hourly_Wage
                ,$Weekly_Wage
                ,$Weekly_Hours_Worked);
            
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
