<!doctype html>
<html>
<head>
    <!-- Include default employee page -->
    <?php include(__DIR__."/../employee.php"); ?>

    <title>Delete Employee</title>
</head>
<body>
    <div class="form-base">
        <!-- Delete by ID from Employee_Data -->
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <label class="input-label">Delete by ID:</label>
            <details <?php echo isset($_POST['employee-delete-1']) ? 'open' : 'close' ?>>
            <summary>ID</summary>
                <label class="required-input-label">ID</label><br>
                <input name="employee-id-1" type="number" min="1" class="details-control" required
                value="<?php echo isset($_POST['employee-id-1']) ? $_POST['employee-id-1'] : '' ?>">
                <br>

                <button name="employee-delete-1" type="submit" class="form-submit">Submit</button>
            </details>
        </form>

        <!-- Delete by ID + Name from Employee_Data -->
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <label class="input-label">Delete by ID + Name:</label>
            <details <?php echo isset($_POST['employee-delete-2']) ? 'open' : 'close' ?>>
            <summary>ID + Name</summary>
                <label class="required-input-label">ID</label><br>
                <input name="employee-id-2" type="number" min="1" class="details-control" required
                value="<?php echo isset($_POST['employee-id-2']) ? $_POST['employee-id-2'] : '' ?>">
                <br>

                <label class="required-input-label">First Name</label><br>
                <input name="employee-Fname" type="text" class="details-control" required
                value="<?php echo isset($_POST['employee-Fname']) ? $_POST['employee-Fname'] : '' ?>">
                <br>

                <label class="required-input-label">Last Name</label><br>
                <input name="employee-Lname" type="text" class="details-control" required
                value="<?php echo isset($_POST['employee-Lname']) ? $_POST['employee-Lname'] : '' ?>">
                <br>

                <button name="employee-delete-2" type="submit" class="form-submit">Submit</button>
            </details>
        </form>

        <?php
        // Connect to Microsoft Azure SQL Database
        include(__DIR__."/../../connect-sql.php");

        // Delete statement based on delete option
        if (isset($_POST["employee-delete-1"])) {
            $ID = $_POST["employee-id-1"];

            // Info of employee to be deleted
            $sql_1 = "SELECT [Employee_ID], [Fname], [Lname], [Department_Name]
                FROM [dbo].[Employee_Data] 
                WHERE [Employee_ID]='$ID'";

            // Create delete statement (ID)
            $sql_2 = "DELETE FROM [dbo].[Employee_Data] 
                WHERE [Employee_ID]='$ID'";
        }
        else if (isset($_POST["employee-delete-2"])) {
            $ID = $_POST["employee-id-2"];
            $Fname = $_POST["employee-Fname"];
            $Lname = $_POST["employee-Lname"];

            // Info of employee to be deleted
            $sql_1 = "SELECT [Employee_ID], [Fname], [Lname], [Department_Name]
                FROM [dbo].[Employee_Data]
                WHERE [Employee_ID]='$ID' AND [Fname]='$Fname' AND [Lname]='$Lname'";

            // Create delete statement (ID + Name)
            $sql_2 = "DELETE FROM [dbo].[Employee_Data] 
                WHERE [Employee_ID]='$ID' AND [Fname]='$Fname' AND [Lname]='$Lname'";
        }

        if (isset($_POST["employee-delete-1"]) || isset($_POST["employee-delete-2"])) {
            // Status and error message to output on web page
            $message = "Successfully Deleted Employee";
            $error_msg = NULL;

            $stmt_1 = sqlsrv_query($conn, $sql_1); // Info of employee to be deleted
            $stmt_2 = sqlsrv_query($conn, $sql_2); // Delete employee
            if ($stmt_2 == false) {
                $message = "Failed to Delete Employee";
                $error_msg = sqlsrv_errors();
            }
            else if (sqlsrv_rows_affected($stmt_2) <= 0) {
                $message = "Employee not found";
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

            // Display Employee as table
            echo "<div>";
            echo "<label class='form-control'>Employee Deleted:</label><br>";
            echo "<table>";
                echo "<tr>";
                    echo "<th>ID</th>";
                    echo "<th>First Name</th>";
                    echo "<th>Last Name</th>";
                    echo "<th>Department Name</th>";
                echo "</tr>";

                // Fetch row from Employee_Data
                while($row = sqlsrv_fetch_array($stmt_1, SQLSRV_FETCH_ASSOC)) {
                    echo "<tr>";
                    echo "<td>" . $row["Employee_ID"] . "</td>";
                    echo "<td>" . $row["Fname"] . "</td>";
                    echo "<td>" . $row["Lname"] . "</td>";
                    echo "<td>" . $row["Department_Name"] . "</td>";
                    echo "</tr>";
                }
            echo "</table>";
            echo "</div>";
        }
        ?>
    </div>
</body>
</html>
