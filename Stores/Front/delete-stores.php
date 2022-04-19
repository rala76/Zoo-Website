<!doctype html>
<html>
<head>
    <!-- Include default Stores page -->
    <?php include(__DIR__."/../Stores.php"); ?>

    <title>Delete Store</title>
</head>
<body>
    <div class="form-base">
        <!-- Delete by ID from Stores -->
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <label class="input-label">Delete by ID:</label>
            <details <?php echo isset($_POST['store-delete-1']) ? 'open' : 'close' ?>>
            <summary>ID</summary>
                <label class="required-input-label">ID</label><br>
                <input name="store-id-1" type="number" min="1" class="details-control" required
                value="<?php echo isset($_POST['store-id-1']) ? $_POST['store-id-1'] : '' ?>">
                <br>

                <button name="store-delete-1" type="submit" class="form-submit">Submit</button>
            </details>
        </form>

        <?php
        // Connect to Microsoft Azure SQL Database
        include(__DIR__."/../../connect-sql.php");

        // Delete statement based on delete option
        if (isset($_POST["store-delete-1"])) {
            $ID = $_POST["store-id-1"];

            // Info of store to be deleted
            $sql_1 = "SELECT [Store_ID], [Store_Name], [Category], [Department_ID]
                , [Hours_Of_Operation], [Num_Customers], [Product_ID], [Weekly_Revenue]
                FROM [dbo].[Stores] 
                WHERE [Store_ID]='$ID'";

            // Create delete statement (ID)
            $sql_2 = "DELETE FROM [dbo].[Stores] 
                WHERE [Store_ID]='$ID'";
        }

        if (isset($_POST["store-delete-1"])) {
            // Status and error message to output on web page
            $message = "Successfully Deleted Store";
            $error_msg = NULL;

            $stmt_1 = sqlsrv_query($conn, $sql_1); // Info of store to be deleted
            $stmt_2 = sqlsrv_query($conn, $sql_2); // Delete store
            if ($stmt_2 == false) {
                $message = "Failed to Delete Store";
                $error_msg = sqlsrv_errors();
            }
            else if (sqlsrv_rows_affected($stmt_2) <= 0) {
                $message = "Store not found";
            }
            
            // Output status and error message
            echo "<div>";
            echo "<h2>$message</h2>";
            echo "<details>";
            echo "<summary>Toggle Errors</summary>";
                if ($error_msg != NULL) {
                    foreach ( $error_msg as $error ) {
                        echo "<b>SQLSTATE: </b>".$error["SQLSTATE"]."<br>";
                        echo "<b>Code: </b> ".$error['code']."<br>";
                        echo "<b>Message: </b>".$error['message']."<br>";
                        echo "<br>";
                    }
                }
            echo "</details>";
            echo "</div>";

            // Break row
            echo "<div class='break-row'></div>";

            // Display Store as table
            echo "<div>";
            echo "<label class='form-control'>Store Deleted:</label><br>";
            echo "<table>";
                echo "<tr>";
                    echo "<th>Store ID</th>";
                    echo "<th>Store Name</th>";
                    echo "<th>Category</th>";
                    echo "<th>Department ID</th>";
                    echo "<th>Hours Of Operation</th>";
                    echo "<th>Number Of Customers</th>";
                    echo "<th>Product ID</th>";
                    echo "<th>Weekly Revenue</th>";
                echo "</tr>";

                // Fetch row from Events
                while($row = sqlsrv_fetch_array($stmt_1, SQLSRV_FETCH_ASSOC)) {
                    echo "<tr>";
                    echo "<td>" . $row["Store_ID"] . "</td>";
                    echo "<td>" . $row["Store_Name"] . "</td>";
                    echo "<td>" . $row["Category"] . "</td>";
                    echo "<td>" . $row["Department_ID"] . "</td>";
                    echo "<td>" . $row["Hours_Of_Operation"] . "</td>";
                    echo "<td>" . $row["Num_Customers"] . "</td>";
                    echo "<td>" . $row["Product_ID"] . "</td>";
                    echo "<td>$" . number_format($row["Weekly_Revenue"], 2) . "</td>";
                    echo "</tr>";
                }
            echo "</table>";
            echo "</div>";
        }
        ?>
    </div>
</body>
</html>
