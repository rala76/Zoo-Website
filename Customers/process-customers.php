<?php
// Connect to Microsoft Azure SQL Database
include(__DIR__ . "/../connect-sql.php");

// Insert Customer based on Insert form
if (isset($_POST["Customer-insert-2"])) {
    $Fname = $_POST["Customer-Fname"];
    $Lname = $_POST["Customer-Lname"];
    $Age = $_POST["Customer-Age"];

    // Create insert query
    $sql_1 = "INSERT INTO [dbo].[Customer_Data] 
        ([Fname]
        ,[Lname]
        ,[Age])
        VALUES 
        (?, ?, ?)";

    // Parameters of insert query
    $params = array($Fname, $Lname, $Age);

    $stmt_1 = sqlsrv_query($conn, $sql_1, $params);
    if ($stmt_1 == false) {
        echo "<script> alert('Failed to Insert Customer'); </script>";
    }
    else {
        echo "<script> alert('Successfully Inserted Customer'); </script>";
    }
}

// Get input values for Edit form
if (isset($_POST["Customer-edit-1"])) {
    $Customer_ID = $_POST["customer-edit-ID-1"];

    // Info of Customer to be updated
    $sql_2 = "SELECT * FROM [dbo].[Customer_Data] 
        WHERE [Customer_ID]={$Customer_ID}";

    $stmt_2 = sqlsrv_query($conn, $sql_2);
    if ($stmt_2 == false) {
        echo "<script> alert('Failed to Find Customer'); </script>";
    } else if (sqlsrv_has_rows($stmt_2) <= 0) {
        echo "<script> alert('Customer Not Found'); </script>";
    }

    // Fetch Customer from Customer_Data
    $data = sqlsrv_fetch_array($stmt_2, SQLSRV_FETCH_ASSOC);
}

// Update Customer based on Edit form
if (isset($_POST["Customer-edit-2"])) {
    $Customer_ID = $_POST["customer-edit-ID-2"];

    $Fname = $_POST["Customer-Fname"];
    $Lname = $_POST["Customer-Lname"];
    $Age = $_POST["Customer-Age"];

    $sql_3 = "UPDATE [dbo].[Customer_Data] 
        SET [Fname] = '$Fname'
        ,[Lname] = '$Lname'
        ,[Age] = '$Age'
        WHERE [Customer_ID]='$Customer_ID'";

    $stmt_3 = sqlsrv_query($conn, $sql_3);
    if ($stmt_3 == false || sqlsrv_rows_affected($stmt_3) <= 0) {
        echo "<script> alert('Failed to Update Customer'); </script>";
    } else {
        echo "<script> alert('Successfully Updated Customer'); </script>";
    }

    // Info of updated Customer
    $sql_4 = "SELECT * FROM [dbo].[Customer_Data] 
        WHERE [Customer_ID]={$Customer_ID}";
    $stmt_4 = sqlsrv_query($conn, $sql_4);

    // Fetch Customer from Customer_Data
    $data = sqlsrv_fetch_array($stmt_4, SQLSRV_FETCH_ASSOC);
}

// Delete Customer
if (isset($_POST["Customer-delete"])) {
    $Customer_ID = $_POST["customer-delete-ID"];

    $sql_5 = "DELETE FROM [dbo].[Customer_Data]
        WHERE [Customer_ID]={$Customer_ID}";

    $stmt_5 = sqlsrv_query($conn, $sql_5);
    if ($stmt_5 == false) {
        echo "<script> alert('Failed to Delete Customer'); </script>";
    } else if (sqlsrv_rows_affected($stmt_5) <= 0) {
        echo "<script> alert('Customer Not Found'); </script>";
    } else {
        echo "<script> alert('Successfully Deleted Customer'); </script>";
    }
}

// Select query based on Sort/Order by value
if (!isset($_POST["Customer-search-submit"])) {
    $_POST["Customer-sortBy"] = "Customer ID";
    $_POST["Customer-orderBy"] = "Ascending";

    $sql_6 = "SELECT [Customer_ID], [Fname], [Lname], [Age]
        FROM [dbo].[Customer_Data] 
        ORDER BY Customer_ID ASC ";
} else {
    // Get Sort By value based on input
    if ($_POST["Customer-sortBy"] == "Customer ID") {
        $Sort_By = "Customer_ID";
    } else if ($_POST["Customer-sortBy"] == "First Name") {
        $Sort_By = "Fname";
    } else if ($_POST["Customer-sortBy"] == "Last Name") {
        $Sort_By = "Lname";
    } else {
        $Sort_By = "Age";
    }

    // Create select query based on
    if ($_POST["Customer-orderBy"] == "Ascending") {
        if($_POST["customer-age"] == "All") {     
            $sql_6 = "SELECT *
                FROM [dbo].[Customer_Data] 
                ORDER BY '$Sort_By' ASC ";
        }
        else if ($_POST["customer-age"] == "Child") {
            $sql_6 = "SELECT *
                FROM [dbo].[Customer_Data]
                WHERE [Age] < 18
                ORDER BY '$Sort_By' ASC ";
        }
        else if ($_POST["customer-age"] == "Adult") {
            $sql_6 = "SELECT *
                FROM [dbo].[Customer_Data]
                WHERE [Age] >= 18 AND [Age] < 65
                ORDER BY '$Sort_By' ASC ";
        }
        else {
            $sql_6 = "SELECT *
                FROM [dbo].[Customer_Data]
                WHERE [Age] >= 65
                ORDER BY '$Sort_By' ASC ";
        } 
    } 
    else {
        if($_POST["customer-age"] == "All") {     
            $sql_6 = "SELECT *
                FROM [dbo].[Customer_Data] 
                ORDER BY '$Sort_By' DESC ";
        }
        else if ($_POST["customer-age"] == "Child") {
            $sql_6 = "SELECT *
                FROM [dbo].[Customer_Data]
                WHERE [Age] < 18
                ORDER BY '$Sort_By' DESC ";
        }
        else if ($_POST["customer-age"] == "Adult") {
            $sql_6 = "SELECT *
                FROM [dbo].[Customer_Data]
                WHERE [Age] >= 18 AND [Age] < 65
                ORDER BY '$Sort_By' DESC ";
        }
        else {
            $sql_6 = "SELECT *
                FROM [dbo].[Customer_Data]
                WHERE [Age] >= 65
                ORDER BY '$Sort_By' DESC ";
        } 
    }
}

$stmt_6 = sqlsrv_query($conn, $sql_6);
if ($stmt_6 == false) {
    echo "<script> alert('Failed to load table') </script>";
}

?>