<?php
// Connect to Microsoft Azure SQL Database
include(__DIR__."/../../connect-sql.php");

// Insert employee based on Insert form
if (isset($_POST["employee-insert-2"])) {
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

    // Create insert query
    $sql_1 = "INSERT INTO [dbo].[Employee_Data] 
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

    // Parameters of insert query
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
    
    $stmt_1 = sqlsrv_query($conn, $sql_1, $params);
    if ($stmt_1 == false) {
        echo "<script> alert('Failed to Insert Employee'); </script>";
    }
    else {
        echo "<script> alert('Successfully Inserted Employee'); </script>";
    }
}

// Get input values for Edit form
if (isset($_POST["employee-edit-1"])) {
    $Employee_ID = $_POST["emp-edit-ID-1"];

    // Info of employee to be updated
    $sql_2 = "SELECT * FROM [dbo].[Employee_Data] 
        WHERE [Employee_ID]={$Employee_ID}";
    
    $stmt_2 = sqlsrv_query($conn, $sql_2);
    if ($stmt_2 == false) {
        echo "<script> alert('Failed to Find Employee'); </script>";
    }
    else if (sqlsrv_has_rows($stmt_2) <= 0) {
        echo "<script> alert('Employee Not Found'); </script>";
    }

    // Fetch Employee from Employee_Data
    $data = sqlsrv_fetch_array($stmt_2, SQLSRV_FETCH_ASSOC);
}

// Update employee based on Edit form
if (isset($_POST["employee-edit-2"])) {
    $Employee_ID = $_POST["emp-edit-ID-2"];

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
    
    $sql_3 = "UPDATE [dbo].[Employee_Data] 
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
        WHERE [Employee_ID]={$Employee_ID}";
    
    $stmt_3 = sqlsrv_query($conn, $sql_3);
    if ($stmt_3 == false || sqlsrv_rows_affected($stmt_3) <= 0) {
        echo "<script> alert('Failed to Update Employee'); </script>";
    }
    else {
        echo "<script> alert('Successfully Updated Employee'); </script>";
    }

    // Info of updated employee
    $sql_4 = "SELECT * FROM [dbo].[Employee_Data] 
        WHERE [Employee_ID]={$Employee_ID}";
    $stmt_4 = sqlsrv_query($conn, $sql_4);

    // Fetch Employee from Employee_Data
    $data = sqlsrv_fetch_array($stmt_4, SQLSRV_FETCH_ASSOC);
}

// Delete employee
if (isset($_POST["employee-delete"])) {
    $Employee_ID = $_POST["emp-delete-ID"];

    $sql_5 = "DELETE FROM [dbo].[Employee_Data]
        WHERE [Employee_ID]={$Employee_ID}";
    
    $stmt_5 = sqlsrv_query($conn, $sql_5);
    if ($stmt_5 == false) {
        echo "<script> alert('Failed to Delete Employee'); </script>";
    }
    else if (sqlsrv_rows_affected($stmt_5) <= 0) {
        echo "<script> alert('Employee Not Found'); </script>";
    }
    else {
        echo "<script> alert('Successfully Deleted Employee'); </script>";
    }
}

// Select query based on Sort/Order by value
if (!isset($_POST["employee-search-submit"])) {
    $_POST["employee-sortBy"] = "Employee ID";
    $_POST["employee-orderBy"] = "Ascending";
    $_POST["employee-status"] = "All";

    $sql_6 = "SELECT *
        FROM [dbo].[Employee_Data] 
        ORDER BY Employee_ID ASC ";
}
else {
    // Get Sort By value based on input
    if ($_POST["employee-sortBy"] == "Employee ID") { $Sort_By = "Employee_ID"; }
    else if ($_POST["employee-sortBy"] == "First Name") { $Sort_By = "Fname"; }
    else if ($_POST["employee-sortBy"] == "Last Name") { $Sort_By = "Lname"; }
    else if ($_POST["employee-sortBy"] == "Date of Birth") { $Sort_By = "Date_Of_Birth"; }
    else if ($_POST["employee-sortBy"] == "Department ID") { $Sort_By = "Department_ID"; }
    else if ($_POST["employee-sortBy"] == "Hourly Wage") { $Sort_By = "Hourly_Wage"; }
    else { $Sort_By = "Weekly_Hours_Worked"; }

    // Create select query based on
    if ($_POST["employee-orderBy"] == "Ascending") {
        if ($_POST["employee-status"] == "All") {
            $sql_6 = "SELECT *
                FROM [dbo].[Employee_Data]
                ORDER BY '$Sort_By' ASC ";
        } 
        else if ($_POST["employee-status"] == "Part Time") {
            $sql_6 = "SELECT *
                FROM [dbo].[Employee_Data]
                WHERE [Weekly_Hours_Worked] <= 20
                ORDER BY '$Sort_By' ASC ";
        }
        else {
            $sql_6 = "SELECT *
                FROM [dbo].[Employee_Data]
                WHERE [Weekly_Hours_Worked] > 20
                ORDER BY '$Sort_By' ASC ";
        }
    }
    else {
        if ($_POST["employee-status"] == "All") {
            $sql_6 = "SELECT *
                FROM [dbo].[Employee_Data] 
                ORDER BY '$Sort_By' DESC ";
        }
        else if ($_POST["employee-status"] == "Part Time") {
            $sql_6 = "SELECT *
                FROM [dbo].[Employee_Data]
                WHERE [Weekly_Hours_Worked] <= 20
                ORDER BY '$Sort_By' DESC ";
        }
        else {
            $sql_6 = "SELECT *
                FROM [dbo].[Employee_Data]
                WHERE [Weekly_Hours_Worked] > 20
                ORDER BY '$Sort_By' DESC ";
        }
    }
}

$stmt_6 = sqlsrv_query($conn, $sql_6);
if ($stmt_6 == false) {
    echo "<script> alert('Failed to load table') </script>";
}

?>