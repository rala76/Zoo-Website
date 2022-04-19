<!doctype html>
<html>
<head>
    <!-- Include default Enclosure page -->
    <?php include(__DIR__."/../Enclosure.php"); ?>

    <title>Search Enclosures</title>
</head>
<body>
    <div class="form-base">
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <!-- Dropdown list for Sort By -->
            <label class="required-input-label">Sort By:</label><br>
            <select name="enclosure-sortBy" class="dropdown-control" required>
                <!-- Default option -->
                <option value="<?php echo isset($_POST['enclosure-sortBy']) ? $_POST['enclosure-sortBy'] : '' ?>" hidden>
                    <?php echo isset($_POST['enclosure-sortBy']) ? $_POST['enclosure-sortBy'] : 'Select an Option' ?>
                </option>
                
                <option value="Enclosure ID">Enclosure ID</option>
                <option value="Department ID">Department ID</option>
                <option value="Number of Animals">Number of Animals</option>
                <option value="Maintenance Fees">Maintenance Fees</option>
            </select><br>

            <!-- Dropdown list for Order By -->
            <label class="required-input-label">Order By:</label><br>
            <select name="enclosure-orderBy" class="dropdown-control" required>
                <!-- Default option -->
                <option value="<?php echo isset($_POST['enclosure-orderBy']) ? $_POST['enclosure-orderBy'] : '' ?>" hidden>
                    <?php echo isset($_POST['enclosure-orderBy']) ? $_POST['enclosure-orderBy'] : 'Select an Option' ?>
                </option>

                <option value="Ascending">Ascending</option>
                <option value="Descending">Descending</option>
            </select><br>

            <button name="enclosure-search-submit" type="submit" class="form-submit">Submit</button>
        </form>

        <?php
        // Connect to Microsoft Azure SQL Database
        include(__DIR__."/../../connect-sql.php");

        // Select query based on Sort/Order by
        if (isset($_POST["enclosure-search-submit"])) {
            // Get Sort By value based on input
            if ($_POST["enclosure-sortBy"] == "Enclosure ID") {
                $Sort_By = "Enclosure_ID";
            }
            else if ($_POST["enclosure-sortBy"] == "Department ID"){
                $Sort_By = "Department_ID";
            }
            else if ($_POST["enclosure-sortBy"] == "Number of Animals") {
                $Sort_By = "Num_Animals";
            }
            else {
                $Sort_By = "Maintenance_Fees";
            }

            // Create select query based on
            if ($_POST["enclosure-orderBy"] == "Ascending") {
                $sql = "SELECT [Enclosure_ID], [Department_ID], [Num_Animals], [Maintenance_Fees]
                    FROM [dbo].[Enclosure_Data]
                    ORDER BY '$Sort_By' ASC ";
            }
            else {
                $sql = "SELECT [Enclosure_ID], [Department_ID], [Num_Animals], [Maintenance_Fees]
                    FROM [dbo].[Enclosure_Data]
                    ORDER BY '$Sort_By' DESC ";
            }

            $stmt = sqlsrv_query($conn, $sql);

            // Break row
            echo "<div class='break-row'></div>";

            // Display Enclosure as table
            echo "<div>";
            echo "<label class='form-control'></label><br>";
            echo "<table>";
                echo "<tr>";
                    echo "<th>Enclosure ID</th>";
                    echo "<th>Department ID</th>";
                    echo "<th>Number of Animals</th>";
                    echo "<th>Maintenance Fees</th>";
                echo "</tr>";

                // Fetch rows from Enclosure_Data
                while($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                    echo "<tr>";
                    echo "<td>" . $row["Enclosure_ID"] . "</td>";
                    echo "<td>" . $row["Department_ID"] . "</td>";
                    echo "<td>" . $row["Num_Animals"] . "</td>";
                    echo "<td>" . $row["Maintenance_Fees"] . "</td>";
                    echo "</tr>";
                }
            echo "</table>";
            echo "</div>";
        }
        ?>
    </div>
</body>
</html>
