<?php
// Connect to Microsoft Azure SQL Database
include(__DIR__ . "/../../connect-sql.php");

// Insert Event based on Insert form
if (isset($_POST["Event-insert-2"])) {
    $Event_Name = $_POST["Event-Event_Name"];
    $Num_Attendees = $_POST["Event-Num_Attendees"];
    $Weekly_Revenue = $_POST["Event-Weekly_Revenue"];
    $Event_Date = $_POST["Event-Event_Date"];
    $Event_Time = $_POST["Event-Event_Time"];
    $Event_ID = $_POST["Event-Event_ID"];

    // Create insert query
    $sql_1 = "INSERT INTO [dbo].[Events] 
        ([Event_Name]
        ,[Num_Attendees]
        ,[Weekly_Revenue]
        ,[Event_Date]
        ,[Event_Time]
        ,[Event_ID])
        VALUES 
        (?, ?, ?, ?, ?,?)";

    // Parameters of insert query
    $params = array(
        $Event_Name, $Num_Attendees, $Weekly_Revenue, $Event_Date, $Event_Time, $Event_ID,
    );

    $stmt_1 = sqlsrv_query($conn, $sql_1, $params);
    if ($stmt_1 == false) {
        echo "<script> alert('Failed to Insert Event'); </script>";
    } else {
        echo "<script> alert('Successfully Inserted Event'); </script>";
    }
}

// Get input values for Edit form
if (isset($_POST["Event-edit-1"])) {
    $Event_ID = $_POST["emp-edit-ID-1"];

    // Info of Event to be updated
    $sql_2 = "SELECT * FROM [dbo].[Events] 
        WHERE [Event_ID]={$Event_ID}";

    $stmt_2 = sqlsrv_query($conn, $sql_2);
    if ($stmt_2 == false) {
        echo "<script> alert('Failed to Find Event'); </script>";
    } else if (sqlsrv_has_rows($stmt_2) <= 0) {
        echo "<script> alert('Event Not Found'); </script>";
    }

    // Fetch Event from Events
    $data = sqlsrv_fetch_array($stmt_2, SQLSRV_FETCH_ASSOC);
}

// Update Event based on Edit form
if (isset($_POST["Event-edit-2"])) {
    $Event_ID = $_POST["emp-edit-ID-2"];

    $Event_Name = $_POST["Event-Event_Name"];
    $Num_Attendees = $_POST["Event-Num_Attendees"];
    $Weekly_Revenue = $_POST["Event-Weekly_Revenue"];
    $Event_Date = $_POST["Event-Event_Date"];
    $Event_Time = $_POST["Event-Event_Time"];
    $Event_ID = $_POST["Event-Event_ID"];


    $sql_3 = "UPDATE [dbo].[Events] 
        SET [Event_Name] = '$Event_Name'
        ,[Num_Attendees] = '$Num_Attendees'
        ,[Weekly_Revenue] = '$Weekly_Revenue'
        ,[Event_Date] = '$Event_Date'
        ,[Event_Time] = '$Event_Time'
        ,[Event_ID] = '$Event_ID'
        WHERE [Event_ID]='$Event_ID'";

    $stmt_3 = sqlsrv_query($conn, $sql_3);
    if ($stmt_3 == false || sqlsrv_rows_affected($stmt_3) <= 0) {
        echo "<script> alert('Failed to Update Event'); </script>";
    } else {
        echo "<script> alert('Successfully Updated Event'); </script>";
    }

    // Info of updated Event
    $sql_4 = "SELECT * FROM [dbo].[Events] 
        WHERE [Event_ID]={$Event_ID}";
    $stmt_4 = sqlsrv_query($conn, $sql_4);

    // Fetch Event from Events
    $data = sqlsrv_fetch_array($stmt_4, SQLSRV_FETCH_ASSOC);
}

// Delete Event
if (isset($_POST["Event-delete"])) {
    $Event_ID = $_POST["emp-delete-ID"];

    $sql_5 = "DELETE FROM [dbo].[Events]
        WHERE [Event_ID]={$Event_ID}";

    $stmt_5 = sqlsrv_query($conn, $sql_5);
    if ($stmt_5 == false) {
        echo "<script> alert('Failed to Delete Event'); </script>";
    } else if (sqlsrv_rows_affected($stmt_5) <= 0) {
        echo "<script> alert('Event Not Found'); </script>";
    } else {
        echo "<script> alert('Successfully Deleted Event'); </script>";
    }
}

// Select query based on Sort/Order by value
if (!isset($_POST["Event-search-submit"])) {
    $_POST["Event-sortBy"] = "Event ID";
    $_POST["Event-orderBy"] = "Ascending";

    $sql_6 = "SELECT *
       
        FROM [dbo].[Events] 
        ORDER BY Event_ID ASC ";
} else {
    // Get Sort By value based on input
    if ($_POST["Event-sortBy"] == "Event ID") {
        $Sort_By = "Event_ID";
    } else if ($_POST["Event-sortBy"] == "Event Name") {
        $Sort_By = "Event_Name";
    } else if ($_POST["Event-sortBy"] == "Number of Attendees") {
        $Sort_By = "Num_Attendees";
    } else if ($_POST["Event-sortBy"] == "Weekly Revenue") {
        $Sort_By = "Weekly_Revenue";
    } else if ($_POST["Event-sortBy"] == "Event Time") {
        $Sort_By = "Event_Time";
    } else if ($_POST["Event-sortBy"] == "Event Date") {
        $Sort_By = "Event_Date";
    }
    // Create select query based on
    if ($_POST["Event-orderBy"] == "Ascending") {
        $sql_6 = "SELECT *
           
            FROM [dbo].[Events] 
            ORDER BY '$Sort_By' ASC ";
    } else {
        $sql_6 = "SELECT *
          
            FROM [dbo].[Events] 
            ORDER BY '$Sort_By' DESC ";
    }
}

$stmt_6 = sqlsrv_query($conn, $sql_6);
if ($stmt_6 == false) {
    echo "<script> alert('Failed to load table') </script>";
}
