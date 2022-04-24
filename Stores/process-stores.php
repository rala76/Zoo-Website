<?php
// Connect to Microsoft Azure SQL Database
include(__DIR__."/../connect-sql.php");

// Insert store based on Insert form
if (isset($_POST["store-insert-2"])) {
    $Category = $_POST["Store-category"];
    $StoreName = $_POST["Store-storeName"];
    $Hours = $_POST["Store-hours"];
    $NumCustomers = !empty($_POST["Store-numCustomers"]) ? $_POST["Store-numCustomers"] : "0";
    $WeeklyRevenue = !empty($_POST["Store-weeklyRevenue"]) ? $_POST["Store-weeklyRevenue"] : "0";
    $ProductID = !empty($_POST["Store-productID"]) ? $_POST["Store-productID"] : NULL;
    $DepartmentID =  $_POST["Store-departmentID"];

    // Create insert query
    $sql_1 = "INSERT INTO [dbo].[Stores] 
        ([Category]
        ,[Store_Name]
        ,[Hours_Of_Operation]
        ,[Num_Customers]
        ,[Weekly_Revenue]
        ,[Product_ID]
        ,[Department_ID])
        VALUES 
        (?, ?, ?, ?, ?, ?, ?)";

    // Parameters of insert query
    $params = array($Category
        ,$StoreName
        ,$Hours
        ,$NumCustomers
        ,$WeeklyRevenue
        ,$ProductID
        ,$DepartmentID);
    
    $stmt_1 = sqlsrv_query($conn, $sql_1, $params);
    if ($stmt_1 == false) {
        echo "<script> alert('Failed to Insert Store'); </script>";
    }
    else {
        echo "<script> alert('Successfully Inserted Store'); </script>";
    }
}

// Get input values for Edit form
if (isset($_POST["store-edit-1"])) {
    $Store_ID = $_POST["store-edit-ID-1"];

    // Info of store to be updated
    $sql_2 = "SELECT * FROM [dbo].[Stores] 
        WHERE [Store_ID]={$Store_ID}";
    
    $stmt_2 = sqlsrv_query($conn, $sql_2);
    if ($stmt_2 == false) {
        echo "<script> alert('Failed to Find Store'); </script>";
    }
    else if (sqlsrv_has_rows($stmt_2) <= 0) {
        echo "<script> alert('Store Not Found'); </script>";
    }

    // Fetch Store from Stores
    $data = sqlsrv_fetch_array($stmt_2, SQLSRV_FETCH_ASSOC);
}

// Update store based on Edit form
if (isset($_POST["store-edit-2"])) {
    $Store_ID = $_POST["store-edit-ID-2"];

    $Category = $_POST["Store-category"];
    $StoreName = $_POST["Store-storeName"];
    $Hours = $_POST["Store-hours"];
    $NumCustomers = !empty($_POST["Store-numCustomers"]) ? $_POST["Store-numCustomers"] : "0";
    $WeeklyRevenue = !empty($_POST["Store-weeklyRevenue"]) ? $_POST["Store-weeklyRevenue"] : "0";
    $ProductID = !empty($_POST["Store-productID"]) ? $_POST["Store-productID"] : NULL;
    $DepartmentID =  $_POST["Store-departmentID"];
    
    $sql_3 = "UPDATE [dbo].[Stores] 
        SET [Category] = '$Category'
        ,[Store_Name] = '$StoreName'
        ,[Hours_Of_Operation] = '$Hours'
        ,[Num_Customers] = '$NumCustomers'
        ,[Weekly_Revenue] = '$WeeklyRevenue'
        ,[Product_ID] = '$ProductID'
        ,[Department_ID] = '$DepartmentID'
        WHERE [Store_ID]={$Store_ID}";
    
    $stmt_3 = sqlsrv_query($conn, $sql_3);
    if ($stmt_3 == false || sqlsrv_rows_affected($stmt_3) <= 0) {
        echo "<script> alert('Failed to Update Store'); </script>";
    }
    else {
        echo "<script> alert('Successfully Updated Store'); </script>";
    }

    // Info of updated store
    $sql_4 = "SELECT * FROM [dbo].[Stores] 
        WHERE [Store_ID]={$Store_ID}";
    $stmt_4 = sqlsrv_query($conn, $sql_4);

    // Fetch Store from Stores
    $data = sqlsrv_fetch_array($stmt_4, SQLSRV_FETCH_ASSOC);
}

// Delete store
if (isset($_POST["store-delete"])) {
    $Store_ID = $_POST["store-delete-ID"];

    $sql_5 = "DELETE FROM [dbo].[Stores]
        WHERE [Store_ID]={$Store_ID}";
    
    $stmt_5 = sqlsrv_query($conn, $sql_5);
    if ($stmt_5 == false) {
        echo "<script> alert('Failed to Delete Store'); </script>";
    }
    else if (sqlsrv_rows_affected($stmt_5) <= 0) {
        echo "<script> alert('Store Not Found'); </script>";
    }
    else {
        echo "<script> alert('Successfully Deleted Store'); </script>";
    }
}

// Select query based on Sort/Order by value
if (!isset($_POST["store-search-submit"])) {
    $_POST["store-sortBy"] = "Store ID";
    $_POST["store-orderBy"] = "Ascending";

    $sql_6 = "SELECT *
        FROM [dbo].[Stores] 
        ORDER BY Store_ID ASC ";
}
else {
    // Get Sort By value based on input
    if ($_POST["store-sortBy"] == "Store ID") { $Sort_By = "Store_ID"; }
    else if ($_POST["store-sortBy"] == "Store Name") { $Sort_By = "Store_Name"; }
    else if ($_POST["store-sortBy"] == "Category") { $Sort_By = "Category"; }
    else if ($_POST["store-sortBy"] == "Department ID") { $Sort_By = "Department_ID"; }
    else if ($_POST["store-sortBy"] == "Hours Of Operation") { $Sort_By = "Hours_Of_Operation"; }
    else if ($_POST["store-sortBy"] == "Number Of Customers") { $Sort_By = "Num_Customers"; }
    else if ($_POST["store-sortBy"] == "Product ID") { $Sort_By = "Product_ID"; }
    else { $Sort_By = "Weekly_Revenue"; }

    // Create select query based on
    if ($_POST["store-orderBy"] == "Ascending") {
        $sql_6 = "SELECT *
            FROM [dbo].[Stores]
            ORDER BY {$Sort_By} ASC ";
    }
    else {
        $sql_6 = "SELECT *
            FROM [dbo].[Stores]
            ORDER BY {$Sort_By} DESC ";
    }
}

$stmt_6 = sqlsrv_query($conn, $sql_6);
if ($stmt_6 == false) {
    echo "<script> alert('Failed to load table') </script>";
}

?>