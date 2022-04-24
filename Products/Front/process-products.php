<?php
// Connect to Microsoft Azure SQL Database
include(__DIR__."/../../connect-sql.php");

// Insert product based on Insert form
if (isset($_POST["product-insert-2"])) {
    $Category = $_POST["Product-category"];
    $Purchase_Date = $_POST["Product-purchaseDate"];
    $Name = $_POST["Product-name"];
    $Inventory_Amount = !empty($_POST["Product-inventory"]) ? $_POST["Product-inventory"] : "0";
    $Amount_Sold = !empty($_POST["Product-amountSold"]) ? $_POST["Product-amountSold"] : "0";
    $Price = $_POST["Product-price"];

    // Create insert query
    $sql_1 = "INSERT INTO [dbo].[Product_Information] 
        ([Category]
        ,[Purchase_Date]
        ,[Product_Name]
        ,[Inventory_Amount]
        ,[Amount_Sold]
        ,[Price])
        VALUES 
        (?, ?, ?, ?, ?, ?)";

    // Parameters of insert query
    $params = array($Category
        ,$Purchase_Date
        ,$Name
        ,$Inventory_Amount
        ,$Amount_Sold
        ,$Price);
    
    $stmt_1 = sqlsrv_query($conn, $sql_1, $params);

    // Check trigger
    $sql_trigger = "SELECT * FROM [dbo].[Trigger_Outputs]";
    $stmt_trigger = sqlsrv_query($conn, $sql_trigger);

    if ($stmt_1 == false) {
        echo "<script> alert('Failed to Insert Product'); </script>";
    }
    else if (sqlsrv_has_rows($stmt_trigger) >= 1) {
        $row = sqlsrv_fetch_array($stmt_trigger, SQLSRV_FETCH_ASSOC);
        $msg = $row['Error'];
        
        echo "<script> alert('Failed to Insert New Product: {$msg}') </script>";

        $sql_delete_trigger = "DELETE FROM [dbo].[Trigger_Outputs]";
        $stmt_delete_trigger = sqlsrv_query($conn, $sql_delete_trigger);
    }
    else {
        echo "<script> alert('Successfully Inserted Product'); </script>";
    }
}

// Get input values for Edit form
if (isset($_POST["product-edit-1"])) {
    $Product_ID = $_POST["product-edit-ID-1"];

    // Info of product to be updated
    $sql_2 = "SELECT * FROM [dbo].[Product_Information] 
        WHERE [Product_ID]={$Product_ID}";
    
    $stmt_2 = sqlsrv_query($conn, $sql_2);
    if ($stmt_2 == false) {
        echo "<script> alert('Failed to Find Product'); </script>";
    }
    else if (sqlsrv_has_rows($stmt_2) <= 0) {
        echo "<script> alert('Product Not Found'); </script>";
    }

    // Fetch Product from Product_Information
    $data = sqlsrv_fetch_array($stmt_2, SQLSRV_FETCH_ASSOC);
}

// Update product based on Edit form
if (isset($_POST["product-edit-2"])) {
    $Product_ID = $_POST["product-edit-ID-2"];

    $Category = $_POST["Product-category"];
    $Purchase_Date = $_POST["Product-purchaseDate"];
    $Name = $_POST["Product-name"];
    $Inventory_Amount = $_POST["Product-inventory"];
    $Amount_Sold = $_POST["Product-amountSold"];
    $Price = $_POST["Product-price"];
    
    $sql_3 = "UPDATE [dbo].[Product_Information] 
        SET [Category] = '$Category'
        ,[Purchase_Date] = '$Purchase_Date'
        ,[Product_Name] = '$Name'
        ,[Inventory_Amount] = '$Inventory_Amount'
        ,[Amount_Sold] = '$Amount_Sold'
        ,[Price] = '$Price'
        WHERE [Product_ID]={$Product_ID}";
    
    $stmt_3 = sqlsrv_query($conn, $sql_3);
    if ($stmt_3 == false || sqlsrv_rows_affected($stmt_3) <= 0) {
        echo "<script> alert('Failed to Update Product'); </script>";
    }
    else {
        echo "<script> alert('Successfully Updated Product'); </script>";
    }

    // Info of updated product
    $sql_4 = "SELECT * FROM [dbo].[Product_Information] 
        WHERE [Product_ID]={$Product_ID}";
    $stmt_4 = sqlsrv_query($conn, $sql_4);

    // Fetch Product from Product_Information
    $data = sqlsrv_fetch_array($stmt_4, SQLSRV_FETCH_ASSOC);
}

// Delete product
if (isset($_POST["product-delete"])) {
    $Product_ID = $_POST["product-delete-ID"];

    $sql_5 = "DELETE FROM [dbo].[Product_Information]
        WHERE [Product_ID]={$Product_ID}";
    
    $stmt_5 = sqlsrv_query($conn, $sql_5);
    if ($stmt_5 == false) {
        echo "<script> alert('Failed to Delete Product'); </script>";
    }
    else if (sqlsrv_rows_affected($stmt_5) <= 0) {
        echo "<script> alert('Product Not Found'); </script>";
    }
    else {
        echo "<script> alert('Successfully Deleted Product'); </script>";
    }
}

// Select query based on Sort/Order by value
if (!isset($_POST["product-search-submit"])) {
    $_POST["product-sortBy"] = "Product ID";
    $_POST["product-orderBy"] = "Ascending";

    $sql_6 = "SELECT *
        FROM [dbo].[Product_Information] 
        ORDER BY Product_ID ASC ";
}
else {
    // Get Sort By value based on input
    if ($_POST["product-sortBy"] == "Product ID") { $Sort_By = "Product_ID"; }
    else if ($_POST["product-sortBy"] == "Product Name") { $Sort_By = "Product_Name"; }
    else if ($_POST["product-sortBy"] == "Category") { $Sort_By = "Category"; }
    else if ($_POST["product-sortBy"] == "Purchase Date") { $Sort_By = "Purchase_Date"; }
    else if ($_POST["product-sortBy"] == "Inventory Amount") { $Sort_By = "Inventory_Amount"; }
    else if ($_POST["product-sortBy"] == "Amount Sold") { $Sort_By = "Amount_Sold"; }
    else { $Sort_By = "Price"; }

    // Create select query based on
    if ($_POST["product-orderBy"] == "Ascending") {
        $sql_6 = "SELECT *
            FROM [dbo].[Product_Information] 
            ORDER BY '$Sort_By' ASC ";
    }
    else {
        $sql_6 = "SELECT *
            FROM [dbo].[Product_Information] 
            ORDER BY '$Sort_By' DESC ";
    }
}

$stmt_6 = sqlsrv_query($conn, $sql_6);
if ($stmt_6 == false) {
    echo "<script> alert('Failed to load table') </script>";
}

?>