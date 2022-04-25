<?php
// Connect to Microsoft Azure SQL Database
include(__DIR__ . "/../connect-sql.php");

// Insert Animal based on Insert form
if (isset($_POST["Animal-insert-2"])) {
    $Name = $_POST["Animal-Name"];
    $Species = $_POST["Animal-Species"];
    $Date_Of_Birth = $_POST["Animal-date-of-birth"];
    $Gender = $_POST["Animal-gender"];
    $Enclosure_ID = $_POST["Animal-Enclosure_ID"];

    // Create insert query
    $sql_1 = "INSERT INTO [dbo].[Animal_Data] 
        ([Animal_Name]
        ,[Species]
        ,[Date_Of_Birth]
        ,[Gender]
        ,[Enclosure_ID])
        VALUES 
        (?, ?, ?, ?, ?)";

    // Parameters of insert query
    $params = array($Name
        , $Species
        , $Date_Of_Birth
        , $Gender
        , $Enclosure_ID);

    $stmt_1 = sqlsrv_query($conn, $sql_1, $params);
    if ($stmt_1 == false) {
        echo "<script> alert('Failed to Insert Animal'); </script>";
    }
    else {
        echo "<script> alert('Successfully Inserted Animal'); </script>";
    }
}

// Get input values for Edit form
if (isset($_POST["Animal-edit-1"])) {
    $Animal_ID = $_POST["animal-edit-ID-1"];

    // Info of Animal to be updated
    $sql_2 = "SELECT * FROM [dbo].[Animal_Data] 
        WHERE [Animal_ID]={$Animal_ID}";

    $stmt_2 = sqlsrv_query($conn, $sql_2);
    if ($stmt_2 == false) {
        echo "<script> alert('Failed to Find Animal'); </script>";
    }
    else if (sqlsrv_has_rows($stmt_2) <= 0) {
        echo "<script> alert('Animal Not Found'); </script>";
    }

    // Fetch Animal from Animal_Data
    $data = sqlsrv_fetch_array($stmt_2, SQLSRV_FETCH_ASSOC);
}

// Update Animal based on Edit form
if (isset($_POST["Animal-edit-2"])) {
    $Animal_ID = $_POST["animal-edit-ID-2"];

    $Name = $_POST["Animal-Name"];
    $Species = $_POST["Animal-Species"];
    $Date_Of_Birth = $_POST["Animal-date-of-birth"];
    $Gender = $_POST["Animal-gender"];
    $Enclosure_ID = $_POST["Animal-Enclosure_ID"];

    $sql_3 = "UPDATE [dbo].[Animal_Data] 
        SET [Animal_Name] = '$Name'
        ,[Species] = '$Species'
        ,[Date_Of_Birth] = '$Date_Of_Birth'
        ,[Gender] = '$Gender'
        ,[Enclosure_ID] = '$Enclosure_ID'
        WHERE [Animal_ID]={$Animal_ID}";

    $stmt_3 = sqlsrv_query($conn, $sql_3);
    if ($stmt_3 == false || sqlsrv_rows_affected($stmt_3) <= 0) {
        echo "<script> alert('Failed to Update Animal'); </script>";
    }
    else {
        echo "<script> alert('Successfully Updated Animal'); </script>";
    }

    // Info of updated Animal
    $sql_4 = "SELECT * FROM [dbo].[Animal_Data] 
        WHERE [Animal_ID]={$Animal_ID}";
    $stmt_4 = sqlsrv_query($conn, $sql_4);

    // Fetch Animal from Animal_Data
    $data = sqlsrv_fetch_array($stmt_4, SQLSRV_FETCH_ASSOC);
}

// Delete Animal
if (isset($_POST["Animal-delete"])) {
    $Animal_ID = $_POST["animal-delete-ID"];

    $sql_5 = "DELETE FROM [dbo].[Animal_Data]
        WHERE [Animal_ID]={$Animal_ID}";

    $stmt_5 = sqlsrv_query($conn, $sql_5);
    if ($stmt_5 == false) {
        echo "<script> alert('Failed to Delete Animal'); </script>";
    }
    else if (sqlsrv_rows_affected($stmt_5) <= 0) {
        echo "<script> alert('Animal Not Found'); </script>";
    }
    else {
        echo "<script> alert('Successfully Deleted Animal'); </script>";
    }
}

// Select query based on Sort/Order by value
if (!isset($_POST["Animal-search-submit"])) {
    $_POST["Animal-sortBy"] = "Animal ID";
    $_POST["Animal-orderBy"] = "Ascending";

    $sql_6 = "SELECT *
        FROM [dbo].[Animal_Data] 
        ORDER BY Animal_ID ASC ";
}
else {
    // Get Sort By value based on input
    if ($_POST["Animal-sortBy"] == "Animal ID") { $Sort_By = "Animal_ID"; }
    else if ($_POST["Animal-sortBy"] == "Name") { $Sort_By = "Animal_Name"; }
    else if ($_POST["Animal-sortBy"] == "Species") { $Sort_By = "Species"; }
    else if ($_POST["Animal-sortBy"] == "Date of Birth") { $Sort_By = "Date_Of_Birth"; }
    else if ($_POST["Animal-sortBy"] == "Gender") { $Sort_By = "Gender"; }
    else { $Sort_By = "Enclosure_ID"; }

    // Create select query based on
    if ($_POST["Animal-orderBy"] == "Ascending") {
        $sql_6 = "SELECT *
            FROM [dbo].[Animal_Data] 
            ORDER BY {$Sort_By} ASC ";
    }
    else {
        $sql_6 = "SELECT *
            FROM [dbo].[Animal_Data] 
            ORDER BY {$Sort_By} DESC ";
    }
}

$stmt_6 = sqlsrv_query($conn, $sql_6);
if ($stmt_6 == false) {
    echo "<script> alert('Failed to load table') </script>";
}

?>
