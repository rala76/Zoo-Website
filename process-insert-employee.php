<?php
// Include default employee page
include("employee.php");
// Connect to Azure SQL Database
include("connect-sql.php");

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
    
    $message = "Successfully Inserted New Employee";
    $error_msg = NULL;

    $stmt = sqlsrv_query($conn, $sql, $params);
    if ($stmt == false) {
        //die(print_r(sqlsrv_errors(), true));
        $message = "Failed to Insert New Employee";
        $error_msg = sqlsrv_errors();
    }
}
?>

<!doctype html>
<html>
<head>
    <title>Insert New Employee</title>
</head>
<body>
    <div class="form-base">
        <div>
        <?php
        echo "<h2>$message</h2>";
        echo "<h3><u>Errors:</u></h3>";
        if ($error_msg != NULL) {
            foreach ( $error_msg as $error ) {
                echo "<b>SQLSTATE: </b>".$error["SQLSTATE"]."<br>";
                echo "<b>Code: </b> ".$error['code']."<br>";
                echo "<b>Message: </b>".$error['message']."<br>";
                echo "<br>";
            }
        }
        ?>

        <h3><u>Form Data</u></h3>
        <p><b>Name:</b> <?php echo $Name; ?></p>
        <p><b>Date of Birth:</b> <?php echo $Date_Of_Birth; ?></p>
        <p><b>Gender:</b> <?php echo $Gender; ?></p>
        <p><b>Phone Number:</b> <?php echo $Phone_Number; ?></p>
        <p><b>Supervisor ID:</b> <?php echo $Supervisor_ID; ?></p>
        <p><b>Department Name:</b> <?php echo $Department_Name; ?></p>
        <p><b>Enclosure ID:</b> <?php echo $Enclosure_ID; ?></p>
        <p><b>Store ID:</b> <?php echo $Store_ID; ?></p>
        <p><b>Event ID:</b> <?php echo $Event_ID; ?></p>
        <p><b>Hourly or Salaried:</b> <?php echo $Hourly_Or_Salaried; ?></p>
        <p><b>Hourly Wage:</b> <?php echo $Hourly_Wage; ?></p>
        <p><b>Weekly Wage:</b> <?php echo $Weekly_Wage; ?></p>
        <p><b>Weekly Hours Worked:</b> <?php echo $Weekly_Hours_Worked; ?></p>

        <?php if ($error_msg != NULL) { exit(1); } ?>
        </div>
    </div>
</body>
</html>
