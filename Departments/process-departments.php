<?php
// Connect to Microsoft Azure SQL Database
include(__DIR__."/../connect-sql.php");

// Select query based on Sort/Order by value
if (!isset($_POST["department-search-submit"])) {
    $_POST["department-sortBy"] = "Department ID";
    $_POST["department-orderBy"] = "Ascending";

    $sql_6 = "SELECT *
        FROM [dbo].[Department] 
        ORDER BY Department_ID ASC ";
}
else {
    // Get Sort By value based on input
    if ($_POST["department-sortBy"] == "Department ID") { $Sort_By = "Department_ID"; }
    else { $Sort_By = "Department_name"; }

    // Create select query based on
    if ($_POST["department-orderBy"] == "Ascending") {
        $sql_6 = "SELECT *
            FROM [dbo].[Employee_Data]
            ORDER BY {$Sort_By} ASC ";
    }
    else {
        $sql_6 = "SELECT *
            FROM [dbo].[Employee_Data]
            ORDER BY {$Sort_By} DESC ";
    }
}

$stmt_6 = sqlsrv_query($conn, $sql_6);
if ($stmt_6 == false) {
    echo "<script> alert('Failed to load table') </script>";
}

?>