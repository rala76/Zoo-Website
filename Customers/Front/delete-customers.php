<!doctype html>
<html>
<head>
    <!-- Include default Customer page -->
    <?php include(__DIR__."/../Customer.php"); ?>

    <title>Delete Customer</title>
</head>
<body>
    <div class="form-base">
        <!-- Delete by ID from Customer_Data -->
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <label class="input-label">Delete by ID:</label>
            <details <?php echo isset($_POST['customer-delete-1']) ? 'open' : 'close' ?>>
            <summary>ID</summary>
                <label class="required-input-label">ID</label><br>
                <input name="customer-id-1" type="number" min="1" class="details-control" required
                value="<?php echo isset($_POST['customer-id-1']) ? $_POST['customer-id-1'] : '' ?>">
                <br>

                <button name="customer-delete-1" type="submit" class="form-submit">Submit</button>
            </details>
        </form>

        <!-- Delete by ID + Name from Customer_Data -->
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <label class="input-label">Delete by ID + Name:</label>
            <details <?php echo isset($_POST['customer-delete-2']) ? 'open' : 'close' ?>>
            <summary>ID + Name</summary>
                <label class="required-input-label">ID</label><br>
                <input name="customer-id-2" type="number" min="1" class="details-control" required
                value="<?php echo isset($_POST['customer-id-2']) ? $_POST['customer-id-2'] : '' ?>">
                <br>

                <label class="required-input-label">First Name</label><br>
                <input name="customer-Fname" type="text" class="details-control" required
                value="<?php echo isset($_POST['customer-Fname']) ? $_POST['customer-Fname'] : '' ?>">
                <br>

                <label class="required-input-label">Last Name</label><br>
                <input name="customer-Lname" type="text" class="details-control" required
                value="<?php echo isset($_POST['customer-Lname']) ? $_POST['customer-Lname'] : '' ?>">
                <br>

                <button name="customer-delete-2" type="submit" class="form-submit">Submit</button>
            </details>
        </form>

        <?php
        // Connect to Microsoft Azure SQL Database
        include(__DIR__."/../../connect-sql.php");

        // Delete statement based on delete option
        if (isset($_POST["customer-delete-1"])) {
            $ID = $_POST["customer-id-1"];

            // Info of customer to be deleted
            $sql_1 = "SELECT [Customer_ID], [Fname], [Lname], [Age]
                FROM [dbo].[Customer_Data] 
                WHERE [Customer_ID]='$ID'";

            // Create delete statement (ID)
            $sql_2 = "DELETE FROM [dbo].[Customer_Data] 
                WHERE [Customer_ID]='$ID'";
        }
        else if (isset($_POST["customer-delete-2"])) {
            $ID = $_POST["customer-id-2"];
            $Fname = $_POST["customer-Fname"];
            $Lname = $_POST["customer-Lname"];

            // Info of customer to be deleted
            $sql_1 = "SELECT [Customer_ID], [Fname], [Lname], [Age]
            FROM [dbo].[Customer_Data] 
            WHERE [Customer_ID]='$ID' AND [Fname]='$Fname' AND [Lname]='$Lname'";

            // Create delete statement (ID + Name)
            $sql_2 = "DELETE FROM [dbo].[Customer_Data] 
                WHERE [Customer_ID]='$ID' AND [Fname]='$Fname' AND [Lname]='$Lname'";
        }

        if (isset($_POST["customer-delete-1"]) || isset($_POST["customer-delete-2"])) {
            $message = "Successfully Deleted Customer";

            $stmt_1 = sqlsrv_query($conn, $sql_1); // Info of customer to be deleted
            $stmt_2 = sqlsrv_query($conn, $sql_2); // Delete customer
            if ($stmt_2 == false) {
                $message = "Failed to Delete Customer";
            }
            else if (sqlsrv_rows_affected($stmt_2) <= 0) {
                $message = "Customer Not Found";
            }
            
            echo "<h2>$message</h2>";

            // Break row
            echo "<div class='break-row'></div>";

            // Display Customer as table
            echo "<div>";
            echo "<label class='form-control'>Customer Deleted:</label><br>";
            echo "<table>";
                echo "<tr>";
                    echo "<th>Customer ID</th>";
                    echo "<th>First Name</th>";
                    echo "<th>Last Name</th>";
                    echo "<th>Age</th>";
                echo "</tr>";

                // Fetch row from Customer_Data
                while($row = sqlsrv_fetch_array($stmt_1, SQLSRV_FETCH_ASSOC)) {
                    echo "<tr>";
                    echo "<td>" . $row["Customer_ID"] . "</td>";
                    echo "<td>" . $row["Fname"] . "</td>";
                    echo "<td>" . $row["Lname"] . "</td>";
                    echo "<td>" . $row["Age"] . "</td>";
                    echo "</tr>";
                }
            echo "</table>";
            echo "</div>";
        }
        ?>
    </div>
</body>
</html>
