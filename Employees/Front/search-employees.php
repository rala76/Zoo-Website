<!doctype html>
<html>
<head>
    <!-- Include default Employee page -->
    <?php include(__DIR__."/../Employee.php"); ?>

    <title>Search Employees</title>
</head>
<body>
    <div class="form-base">
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <!-- Dropdown list for Sort By -->
            <label class="required-input-label">Sort By:</label><br>
            <select name="employee-sortBy" class="dropdown-control" required>
                <!-- Default option -->
                <option value="<?php echo isset($_POST['employee-sortBy']) ? $_POST['employee-sortBy'] : '' ?>" hidden>
                    <?php echo isset($_POST['employee-sortBy']) ? $_POST['employee-sortBy'] : 'Select an Option' ?>
                </option>

                <option value="Employee ID">Employee ID</option>
                <option value="First Name">First Name</option>
                <option value="Last Name">Last Name</option>
                <option value="Date of Birth">Date of Birth</option>
                <option value="Department ID">Department ID</option>
                <option value="Hourly Wage">Hourly Wage</option>
                <option value="Weekly Hours Worked">Weekly Hours Worked</option>
            </select><br>

            <!-- Dropdown list for Order By -->
            <label class="required-input-label">Order By:</label><br>
            <select name="employee-orderBy" class="dropdown-control" required>
                <!-- Default option -->
                <option value="<?php echo isset($_POST['employee-orderBy']) ? $_POST['employee-orderBy'] : '' ?>" hidden>
                    <?php echo isset($_POST['employee-orderBy']) ? $_POST['employee-orderBy'] : 'Select an Option' ?>
                </option>

                <option value="Ascending">Ascending</option>
                <option value="Descending">Descending</option>
            </select><br>

            <button name="employee-search-submit" type="submit" class="form-submit">Submit</button>
        </form>

        <?php
        // Connect to Microsoft Azure SQL Database
        include(__DIR__."/../../connect-sql.php");

        // Select query based on Sort/Order by
        if (isset($_POST["employee-search-submit"])) {
            // Get Sort By value based on input
            if ($_POST["employee-sortBy"] == "Employee ID") {
                $Sort_By = "Employee_ID";
            }
            else if ($_POST["employee-sortBy"] == "First Name") {
                $Sort_By = "Fname";
            }
            else if ($_POST["employee-sortBy"] == "Last Name") {
                $Sort_By = "Lname";
            }
            else if ($_POST["employee-sortBy"] == "Date of Birth") {
                $Sort_By = "Date_Of_Birth";
            }
            else if ($_POST["employee-sortBy"] == "Department ID") {
                $Sort_By = "Department_ID";
            }
            else if ($_POST["employee-sortBy"] == "Hourly Wage") {
                $Sort_By = "Hourly_Wage";
            }
            else {
                $Sort_By = "Weekly_Hours_Worked";
            }
            

            // Create select query based on
            if ($_POST["employee-orderBy"] == "Ascending") {
                $sql = "SELECT [Employee_ID], [Fname], [Lname], [Date_Of_Birth]
                    , [Gender], [Phone_Number], [Department_Name], [Department_ID]
                    , [Hourly_Wage], [Weekly_Hours_Worked]
                    FROM [dbo].[Employee_Data] 
                    ORDER BY '$Sort_By' ASC ";
            }
            else {
                $sql = "SELECT [Employee_ID], [Fname], [Lname], [Date_Of_Birth]
                    , [Gender], [Phone_Number], [Department_Name], [Department_ID]
                    , [Hourly_Wage], [Weekly_Hours_Worked]
                    FROM [dbo].[Employee_Data] 
                    ORDER BY '$Sort_By' DESC ";
            }

            $stmt = sqlsrv_query($conn, $sql);

            // Break row
            echo "<div class='break-row'></div>";

            // Display Employee as table
            echo "<div>";
            echo "<label class='form-control'></label><br>";
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

                // Fetch rows from Employee_Data
                while($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                    echo "<tr>";
                    echo "<td>" . $row["Employee_ID"] . "</td>";
                    echo "<td>" . $row["Fname"] . "</td>";
                    echo "<td>" . $row["Lname"] . "</td>";
                    echo "<td>" . $row["Date_Of_Birth"]->format('Y-m-d') . "</td>";
                    echo "<td>" . $row["Gender"] . "</td>";
                    echo "<td>" . $row["Phone_Number"] . "</td>";
                    echo "<td>" . $row["Department_Name"] . "</td>";
                    echo "<td>" . $row["Department_ID"] . "</td>";
                    echo "<td>" . $row["Hourly_Wage"] . "</td>";
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
