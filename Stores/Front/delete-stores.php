<!doctype html>
<html>
<head>
    <!-- Include default Store page -->
    <?php include(__DIR__."/../Store.php"); ?>

    <title>Delete Store</title>
</head>
<body>
    <div class="form-base">
        <!-- Delete by ID from Store_Data -->
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <label class="input-label">Delete by ID:</label>
            <details <?php echo isset($_POST['Store-delete-1']) ? 'open' : 'close' ?>>
            <summary>ID</summary>
                <label class="required-input-label">ID</label><br>
                <input name="Store-id-1" type="number" min="1" class="details-control" required
                value="<?php echo isset($_POST['Store-id-1']) ? $_POST['Store-id-1'] : '' ?>">
                <br>

                <button name="Store-delete-1" type="submit" class="form-submit">Submit</button>
            </details>
        </form>

        <!-- Delete by ID + Name from Store_Data -->
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <label class="input-label">Delete by ID + Name:</label>
            <details <?php echo isset($_POST['Store-delete-2']) ? 'open' : 'close' ?>>
            <summary>ID + Name</summary>
                <label class="required-input-label">ID</label><br>
                <input name="Store-id-2" type="number" min="1" class="details-control" required
                value="<?php echo isset($_POST['Store-id-2']) ? $_POST['Store-id-2'] : '' ?>">
                <br>

                <label class="required-input-label">First Name</label><br>
                <input name="Store-Fname" type="text" class="details-control" required
                value="<?php echo isset($_POST['Store-Name']) ? $_POST['Store-Name'] : '' ?>">
                <br>


                <button name="Store-delete-2" type="submit" class="form-submit">Submit</button>
            </details>
        </form>

        <?php
        // Connect to Microsoft Azure SQL Database
        include(__DIR__."/../../connect-sql.php");

        // Delete statement based on delete option
        if (isset($_POST["Store-delete-1"])) {
            $ID = $_POST["Store-id-1"];

            // Info of Store to be deleted
            $sql_1 = "SELECT [Category], [Store_Name], [Hours_Of_Operation], [Num_Customers], [Weekly_Revenue],[Product_ID],[Store_ID],[Employee_ID]
                FROM [dbo].[Store_Data] 
                WHERE [Store_ID]='$ID'";

            // Create delete statement (ID)
            $sql_2 = "DELETE FROM [dbo].[Store_Data] 
                WHERE [Store_ID]='$ID'";
        }
        else if (isset($_POST["Store-delete-2"])) {
            $ID = $_POST["Store-id-2"];
            $Store_name = $_POST["Store-Name"];

            // Info of Store to be deleted
            $sql_1 = "SELECT [Category], [Store_Name], [Hours_Of_Operation], [Num_Customers], [Weekly_Revenue],[Product_ID],[Store_ID],[Employee_ID]
                FROM [dbo].[Store_Data]
                WHERE [Store_ID]='$ID' AND [Store_Name]='$Store_name'";

            // Create delete statement (ID + Name)
            $sql_2 = "DELETE FROM [dbo].[Store_Data] 
                WHERE [Store_ID]='$ID' AND [Store_Name]='$Store_name' ";
        }

        if (isset($_POST["Store-delete-1"]) || isset($_POST["Store-delete-2"])) {
            // Status and error message to output on web page
            $message = "Successfully Deleted Store";
            $error_msg = NULL;

            $stmt_1 = sqlsrv_query($conn, $sql_1); // Info of Store to be deleted
            $stmt_2 = sqlsrv_query($conn, $sql_2); // Delete Store
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
                    echo "<th>ID</th>";
                    echo "<th>First Name</th>";
                    echo "<th>Last Name</th>";
                    echo "<th>Department ID</th>";
                    echo "<th>Department Name</th>";
                echo "</tr>";

                // Fetch row from Store_Data
                while($row = sqlsrv_fetch_array($stmt_1, SQLSRV_FETCH_ASSOC)) {
                    echo "<tr>";    //[Category], [Store_Name], [Hours_Of_Operation], [Num_Customers], [Weekly_Revenue],[Product_ID],[Store_ID],[Employee_ID]
                    echo "<td>" . $row["Category"] . "</td>";
                    echo "<td>" . $row["Store_Name"] . "</td>";
                    echo "<td>" . $row["Hours_Of_Operation"] . "</td>";
                    echo "<td>" . $row["Num_Customers"] . "</td>";
                    echo "<td>" . $row["Weekly_Revenue"] . "</td>";
                    echo "<td>" . $row["Product_ID"] . "</td>";
                    echo "<td>" . $row["Store_ID"] . "</td>";
                    echo "<td>" . $row["Employee_ID"] . "</td>";
                    echo "</tr>";
                }
            echo "</table>";
            echo "</div>";
        }
        ?>
    </div>
</body>
</html>
