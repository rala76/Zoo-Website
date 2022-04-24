<?php
// Connect to Microsoft Azure SQL Database
include(__DIR__ . "/../connect-sql.php");

// Insert Enclosure based on Insert form
if (isset($_POST["Enclosure-insert-2"])) {
    $Maintenance_Fees = $_POST["Enclosure-Maintenance_Fees"];
    $Num_Animals = $_POST["Enclosure-Num_Animals"];
    $Department_ID = $_POST["Enclosure-Department_ID"];

    // Create insert query
    $sql_1 = "INSERT INTO [dbo].[Enclosure_Data] 
        ([Maintenance_Fees]
        ,[Num_Animals]
        ,[Department_ID])
        VALUES 
        (?, ?, ?)";

    // Parameters of insert query
    $params = array(
        $Maintenance_Fees, $Num_Animals, $Department_ID
    );

    $stmt_1 = sqlsrv_query($conn, $sql_1, $params);
    if ($stmt_1 == false) {
        echo "<script> alert('Failed to Insert Enclosure'); </script>";
    }
    else {
        echo "<script> alert('Successfully Inserted Enclosure'); </script>";
    }
}

// Get input values for Edit form
if (isset($_POST["Enclosure-edit-1"])) {
    $Enclosure_ID = $_POST["enclosure-edit-ID-1"];

    // Info of Enclosure to be updated
    $sql_2 = "SELECT * FROM [dbo].[Enclosure_Data] 
        WHERE [Enclosure_ID]={$Enclosure_ID}";

    $stmt_2 = sqlsrv_query($conn, $sql_2);
    if ($stmt_2 == false) {
        echo "<script> alert('Failed to Find Enclosure'); </script>";
    }
    else if (sqlsrv_has_rows($stmt_2) <= 0) {
        echo "<script> alert('Enclosure Not Found'); </script>";
    }

    // Fetch Enclosure from Enclosure_Data
    $data = sqlsrv_fetch_array($stmt_2, SQLSRV_FETCH_ASSOC);
}

// Update Enclosure based on Edit form
if (isset($_POST["Enclosure-edit-2"])) {
    $Enclosure_ID = $_POST["enclosure-edit-ID-2"];

    $Maintenance_Fees = $_POST["Enclosure-Maintenance_Fees"];
    $Num_Animals = $_POST["Enclosure-Num_Animals"];
    $Department_ID = $_POST["Enclosure-Department_ID"];

    $sql_3 = "UPDATE [dbo].[Enclosure_Data] 
        SET [Maintenance_Fees] = '$Maintenance_Fees'
        ,[Num_Animals] = '$Num_Animals'
        ,[Department_ID] = '$Department_ID'
        WHERE [Enclosure_ID]={$Enclosure_ID}";

    $stmt_3 = sqlsrv_query($conn, $sql_3);
    if ($stmt_3 == false || sqlsrv_rows_affected($stmt_3) <= 0) {
        echo "<script> alert('Failed to Update Enclosure'); </script>";
    }
    else {
        echo "<script> alert('Successfully Updated Enclosure'); </script>";
    }

    // Info of updated Enclosure
    $sql_4 = "SELECT * FROM [dbo].[Enclosure_Data] 
        WHERE [Enclosure_ID]={$Enclosure_ID}";
    $stmt_4 = sqlsrv_query($conn, $sql_4);

    // Fetch Enclosure from Enclosure_Data
    $data = sqlsrv_fetch_array($stmt_4, SQLSRV_FETCH_ASSOC);
}

// Delete Enclosure
if (isset($_POST["Enclosure-delete"])) {
    $Enclosure_ID = $_POST["enclosure-delete-ID"];

    $sql_5 = "DELETE FROM [dbo].[Enclosure_Data]
        WHERE [Enclosure_ID]={$Enclosure_ID}";

    $stmt_5 = sqlsrv_query($conn, $sql_5);
    if ($stmt_5 == false) {
        echo "<script> alert('Failed to Delete Enclosure'); </script>";
    }
    else if (sqlsrv_rows_affected($stmt_5) <= 0) {
        echo "<script> alert('Enclosure Not Found'); </script>";
    }
    else {
        echo "<script> alert('Successfully Deleted Enclosure'); </script>";
    }
}

// Select query based on Sort/Order by value
if (!isset($_POST["Enclosure-search-submit"])) {
    $_POST["Enclosure-sortBy"] = "Enclosure ID";
    $_POST["Enclosure-orderBy"] = "Ascending";

    $sql_6 = "SELECT [Enclosure_ID], [Maintenance_Fees], [Num_Animals], [Department_ID]
        FROM [dbo].[Enclosure_Data] 
        ORDER BY Enclosure_ID ASC ";
} else {
    // Get Sort By value based on input
    if ($_POST["Enclosure-sortBy"] == "Enclosure ID") { $Sort_By = "Enclosure_ID"; }
    else if ($_POST["Enclosure-sortBy"] == "Maintanence Fees") { $Sort_By = "Maintenance_Fees"; }
    else if ($_POST["Enclosure-sortBy"] == "Number of Animals") { $Sort_By = "Num_Animals"; }
    else { $Sort_By = "Department_ID"; }

    // Create select query based on
    if ($_POST["Enclosure-orderBy"] == "Ascending") {
        $sql_6 = "SELECT *
            FROM [dbo].[Enclosure_Data] 
            ORDER BY '$Sort_By' ASC ";
    }
    else {
        $sql_6 = "SELECT *
            FROM [dbo].[Enclosure_Data] 
            ORDER BY '$Sort_By' DESC ";
    }
}

$stmt_6 = sqlsrv_query($conn, $sql_6);
if ($stmt_6 == false) {
    echo "<script> alert('Failed to load table') </script>";
}

?>