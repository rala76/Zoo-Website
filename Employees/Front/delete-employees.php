<!doctype html>
<html>
<head>
    <!-- Include default Employee page -->
    <?php include(__DIR__."/../Employee.php"); ?>

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
            $sql_1 = "SELECT [Employee_ID], [Fname], [Lname], [Date_Of_Birth]
                , [Gender], [Phone_Number], [Department_Name], [Department_ID]
                , [Hourly_Wage], [Weekly_Hours_Worked]
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
            $sql_1 = "SELECT [Employee_ID], [Fname], [Lname], [Date_Of_Birth]
                , [Gender], [Phone_Number], [Department_Name], [Department_ID]
                , [Hourly_Wage], [Weekly_Hours_Worked]
                FROM [dbo].[Employee_Data] 
                WHERE [Employee_ID]='$ID' AND [Fname]='$Fname' AND [Lname]='$Lname'";

            // Create delete statement (ID + Name)
            $sql_2 = "DELETE FROM [dbo].[Employee_Data] 
                WHERE [Employee_ID]='$ID' AND [Fname]='$Fname' AND [Lname]='$Lname'";
        }

        if (isset($_POST["employee-delete-1"]) || isset($_POST["employee-delete-2"])) {
            $message = "Successfully Deleted Employee";

            $stmt_1 = sqlsrv_query($conn, $sql_1); // Info of employee to be deleted
            $stmt_2 = sqlsrv_query($conn, $sql_2); // Delete employee
            if ($stmt_2 == false) {
                $message = "Failed to Delete Employee";
            }
            else if (sqlsrv_rows_affected($stmt_2) <= 0) {
                $message = "Employee Not Found";
            }
            
            echo "<h2>$message</h2>";

            // Break row
            echo "<div class='break-row'></div>";

            // Display Employee as table
            echo "<div>";
            echo "<label class='form-control'>Employee Deleted:</label><br>";
            echo "<table>";
                echo "<tr>";
                    echo "<th>Employee ID</th>";
                    echo "<th>First Name</th>";
                    echo "<th>Last Name</th>";
                    echo "<th>Date of Birth</th>";
                    echo "<th>Gender</th>";
                    echo "<th>Phone Number</th>";
                    echo "<th>Department Name</th>";
                    echo "<th>Department ID</th>";
                    echo "<th>Hourly Wage</th>";
                    echo "<th>Weekly Hours Worked</th>";
                echo "</tr>";

                // Fetch row from Employee_Data
                while($row = sqlsrv_fetch_array($stmt_1, SQLSRV_FETCH_ASSOC)) {
                    echo "<tr>";
                    echo "<td>" . $row["Employee_ID"] . "</td>";
                    echo "<td>" . $row["Fname"] . "</td>";
                    echo "<td>" . $row["Lname"] . "</td>";
                    echo "<td>" . $row["Date_Of_Birth"]->format('Y-m-d') . "</td>";
                    echo "<td>" . $row["Gender"] . "</td>";
                    echo "<td>" . $row["Phone_Number"] . "</td>";
                    echo "<td>" . $row["Department_Name"] . "</td>";
                    echo "<td>" . $row["Department_ID"] . "</td>";
                    echo "<td>$" . number_format($row["Hourly_Wage"], 2) . "</td>";
                    echo "<td>" . $row["Weekly_Hours_Worked"] . "</td>";
                    echo "</tr>";
                }
            echo "</table>";
            echo "</div>";
        }
        ?>
    </div>
</body>
</html>
