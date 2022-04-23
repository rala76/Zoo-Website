<?php
// Connect to Microsoft Azure SQL Database
include(__DIR__."/../connect-sql.php");

// $sql_animal = "SELECT SUM(Animal_Num)
//                 AS Total_Animals
//                 FROM [dbo].[Animal_Data]";

//Query to get total animal count
$sql_animals = "SELECT COUNT(Animal_ID)
                AS Total_Animals
                FROM [dbo].[Animal_Data]";

$stmt_animals = sqlsrv_query($conn, $sql_animals);

if ($stmt_animals == false) {
    echo "<script> alert('Failed to get total animal count') </script>";
}
else {
    $results_animals = sqlsrv_fetch_array($stmt_animals);
}


//Query to get total customer count
$sql_customers = "SELECT COUNT(Customer_ID)
                AS Total_Customers
                FROM [dbo].[Customer_Data]";

$stmt_customers = sqlsrv_query($conn, $sql_customers);

if ($stmt_customers == false) {
    echo "<script> alert('Failed to get total customer count') </script>";
}
else {
    $results_customers = sqlsrv_fetch_array($stmt_customers);
}


//Query to get total store count
$sql_stores = "SELECT COUNT(Store_ID)
                AS Total_Stores
                FROM [dbo].[Stores]";

$stmt_stores = sqlsrv_query($conn, $sql_stores);

if ($stmt_stores == false) {
    echo "<script> alert('Failed to get total store count') </script>";
}
else {
    $results_stores = sqlsrv_fetch_array($stmt_stores);
}


//Query to get total event count
$sql_events = "SELECT COUNT(Event_ID)
                AS Total_Events
                FROM [dbo].[Events]";

$stmt_events = sqlsrv_query($conn, $sql_events);

if ($stmt_events == false) {
    echo "<script> alert('Failed to get total event count') </script>";
}
else {
    $results_events = sqlsrv_fetch_array($stmt_events);
}


//Query to get total employee count
$sql_employees = "SELECT COUNT(Employee_ID)
                AS Total_Employees
                FROM [dbo].[Employee_Data]";

$stmt_employees = sqlsrv_query($conn, $sql_employees);

if ($stmt_employees == false) {
    echo "<script> alert('Failed to get total employee count') </script>";
}
else {
    $results_employees = sqlsrv_fetch_array($stmt_employees);
}


//Query to get total product amount sold
$sql_products = "SELECT SUM(Amount_Sold)
                AS Total_Products
                FROM [dbo].[Product_Information]";

$stmt_products = sqlsrv_query($conn, $sql_products);

if ($stmt_products == false) {
    echo "<script> alert('Failed to get total product amount sold') </script>";
}
else {
    $results_products = sqlsrv_fetch_array($stmt_products);
}


//Free up resources once done
sqlsrv_free_stmt($stmt_animals);
sqlsrv_free_stmt($stmt_customers);
sqlsrv_free_stmt($stmt_stores);
sqlsrv_free_stmt($stmt_events);
sqlsrv_free_stmt($stmt_employees);
sqlsrv_free_stmt($stmt_products);
sqlsrv_close($conn);  

?>