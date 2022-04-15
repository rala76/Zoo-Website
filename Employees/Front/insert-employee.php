<!doctype html>
<html>
<head>
    <!-- Include default employee page -->
    <?php include(__DIR__."/../employee.php"); ?>

    <title>Insert New Employee</title>
</head>
<body>
    <div class="form-base">
        <!-- Insert form for Employee_Data -->
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <label class="required-input-label">Name</label><br>
            <input name="employee-name" type="text" class="form-control" required
            value="<?php echo isset($_POST['employee-name']) ? $_POST['employee-name'] : '' ?>">
            <br>

            <label class="required-input-label">Date of Birth (YYYY-MM-DD)</label><br>
            <input name="employee-date-of-birth" type="text" class="form-control" required
            value="<?php echo isset($_POST['employee-date-of-birth']) ? $_POST['employee-date-of-birth'] : '' ?>">
            <br>

            <!-- Should change to dropdown/select if possible -->
            <label class="required-input-label">Gender</label><br>
            <input name="employee-gender" type="text" class="form-control" required
            value="<?php echo isset($_POST['employee-gender']) ? $_POST['employee-gender'] : '' ?>">
            <br>

            <label class="input-label">Phone Number (###-###-####)</label><br>
            <input name="employee-phone-number" type="text" class="form-control" placeholder="NULL"
            value="<?php echo isset($_POST['employee-phone-number']) ? $_POST['employee-phone-number'] : '' ?>">
            <br>

            <label class="input-label">Supervisor ID</label><br>
            <input name="employee-supervisor-id" type="number" min="1" class="form-control" placeholder="NULL"
            value="<?php echo isset($_POST['employee-supervisor-id']) ? $_POST['employee-supervisor-id'] : '' ?>">
            <br>

            <label class="required-input-label">Department Name</label><br>
            <input name="employee-department-name" type="text" class="form-control" required
            value="<?php echo isset($_POST['employee-date-of-birth']) ? $_POST['employee-date-of-birth'] : '' ?>">
            <br>HERE
            
            <label class="input-label">Enclosure ID</label><br>
            <input name="employee-enclosure-id" type="number" min="1" class="form-control" placeholder="NULL"
            value="<?php echo isset($_POST['employee-date-of-birth']) ? $_POST['employee-date-of-birth'] : '' ?>">
            <br>

            <label class="input-label">Store ID</label><br>
            <input name="employee-store-id" type="number" min="1" class="form-control" placeholder="NULL"
            value="<?php echo isset($_POST['employee-date-of-birth']) ? $_POST['employee-date-of-birth'] : '' ?>">
            <br>

            <label class="input-label">Event ID</label><br>
            <input name="employee-event-id" type="number" class="form-control" placeholder="NULL"
            value="<?php echo isset($_POST['employee-event-id']) ? $_POST['employee-event-id'] : '' ?>">
            <br>

            <!-- Should change to dropdown/select if possible -->
            <label class="required-input-label">'Hourly' or 'Salaried'</label><br>
            <input name="employee-hourly-or-salaried" type="text" class="form-control" required
            value="<?php echo isset($_POST['employee-hourly-or-salaried']) ? $_POST['employee-hourly-or-salaried'] : '' ?>">
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
            <input name="employee-weekly-hours-worked" type="number" min="1" class="form-control" placeholder="0"
            value="<?php echo isset($_POST['employee-weekly-hours-worked']) ? $_POST['employee-weekly-hours-worked'] : '' ?>">
            <br>

            <button name="employee-submit" type="submit" class="form-submit">Submit</button>
        </form>
    
        <?php
        // Connect to Azure SQL Database
        include(__DIR__."/../../connect-sql.php");

        // Get data from employee form once submit button is pressed
        if(isset($_POST["employee-submit"])) {
            $Name = $_POST["employee-name"];
            $Date_Of_Birth = $_POST["employee-date-of-birth"];
            $Gender = $_POST["employee-gender"];
            $Phone_Number = !empty($_POST["employee-phone-number"]) ? $_POST["employee-phone-number"] : NULL;
            $Supervisor_ID = !empty($_POST["employee-supervisor-id"]) ? $_POST["employee-supervisor-id"] : NULL;
            $Department_Name = $_POST["employee-department-name"];
            $Enclosure_ID = !empty($_POST["employee-enclosure-id"]) ? $_POST["employee-enclosure-id"] : NULL;
            $Store_ID = !empty($_POST["employee-store-id"]) ? $_POST["employee-store-id"] : NULL;
            $Event_ID = !empty($_POST["employee-event-id"]) ? $_POST["employee-event-id"] : NULL;
            $Hourly_Or_Salaried = $_POST["employee-hourly-or-salaried"];
            $Hourly_Wage = !empty($_POST["employee-hourly-wage"]) ? $_POST["employee-hourly-wage"] : NULL;
            $Weekly_Wage = !empty($_POST["employee-weekly-wage"]) ? $_POST["employee-weekly-wage"] : NULL;
            $Weekly_Hours_Worked = !empty($_POST["employee-weekly-hours-worked"]) ? $_POST["employee-weekly-hours-worked"] : "0";

            // Create insert statement
            $sql = "INSERT INTO [dbo].[Employee_Data] 
                ([Name]
                ,[Date_Of_Birth]
                ,[Gender]
                ,[Phone_Number]
                ,[Supervisor_ID]
                ,[Department_Name]
                ,[Enclosure_ID]
                ,[Store_ID]
                ,[Event_ID]
                ,[Hourly_Or_Salaried]
                ,[Hourly_Wage]
                ,[Weekly_Wage]
                ,[Weekly_Hours_Worked])
                VALUES 
                (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            
            // Parameters of insert statement
            $params = array($Name
                ,$Date_Of_Birth
                ,$Gender
                ,$Phone_Number
                ,$Supervisor_ID
                ,$Department_Name
                ,$Enclosure_ID
                ,$Store_ID
                ,$Event_ID
                ,$Hourly_Or_Salaried
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
        }
        ?>
    </div>
</body>
</html>
