<!doctype html>
<html>
<head>
    <!-- Include default Animal page -->
    <?php include(__DIR__."/../Animal.php"); ?>

    <title>Search Animals</title>
</head>
<body>
    <div class="form-base">
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <!-- Dropdown list for Sort By -->
            <label class="required-input-label">Sort By:</label><br>
            <select name="animal-sortBy" class="dropdown-control" required>
                <!-- Default option -->
                <option value="<?php echo isset($_POST['animal-sortBy']) ? $_POST['animal-sortBy'] : '' ?>" hidden>
                    <?php echo isset($_POST['animal-sortBy']) ? $_POST['animal-sortBy'] : 'Select an Option' ?>
                </option>

                <option value="Animal ID">Animal ID</option>
                <option value="Animal Name">Animal Name</option>
                <option value="Species">Species</option>
                <option value="Date Of Birth">Date Of Birth</option>
                <option value="Gender">Gender</option>
                <option value="Enclosure ID">Enclosure ID</option>
            </select><br>

            <!-- Dropdown list for Order By -->
            <label class="required-input-label">Order By:</label><br>
            <select name="animal-orderBy" class="dropdown-control" required>
                <!-- Default option -->
                <option value="<?php echo isset($_POST['animal-orderBy']) ? $_POST['animal-orderBy'] : '' ?>" hidden>
                    <?php echo isset($_POST['animal-orderBy']) ? $_POST['animal-orderBy'] : 'Select an Option' ?>
                </option>

                <option value="Ascending">Ascending</option>
                <option value="Descending">Descending</option>
            </select><br>

            <button name="animal-search-submit" type="submit" class="form-submit">Submit</button>
        </form>

        <?php
        // Connect to Microsoft Azure SQL Database
        include(__DIR__."/../../connect-sql.php");

        // Select query based on Sort/Order by
        if (isset($_POST["animal-search-submit"])) {
            // Get Sort By value based on input
            if ($_POST["animal-sortBy"] == "Animal ID") {
                $Sort_By = "Animal_ID";
            }
            else if ($_POST["animal-sortBy"] == "Animal Name") {
                $Sort_By = "Animal_Name";
            }
            else if ($_POST["animal-sortBy"] == "Species") {
                $Sort_By = "Species";
            }
            else if ($_POST["animal-sortBy"] == "Date Of Birth") {
                $Sort_By = "Date_Of_Birth";
            }
            else if ($_POST["animal-sortBy"] == "Gender") {
                $Sort_By = "Gender";
            }
            else {
                $Sort_By = "Enclosure_ID";
            }
            

            // Create select query based on
            if ($_POST["animal-orderBy"] == "Ascending") {
                $sql = "SELECT [Animal_ID], [Animal_Name], [Species], [Date_Of_Birth]
                    , [Gender], [Enclosure_ID]
                    FROM [dbo].[Animal_Data] 
                    ORDER BY '$Sort_By' ASC ";
            }
            else {
                $sql = "SELECT [Animal_ID], [Animal_Name], [Species], [Date_Of_Birth]
                    , [Gender], [Enclosure_ID]
                    FROM [dbo].[Animal_Data] 
                    ORDER BY '$Sort_By' DESC ";
            }

            $stmt = sqlsrv_query($conn, $sql);

            // Break row
            echo "<div class='break-row'></div>";

            // Display Animal as table
            echo "<div>";
            echo "<label class='form-control'></label><br>";
            echo "<table>";
                echo "<tr>";
                    echo "<th>Animal ID</th>";
                    echo "<th>Animal Name</th>";
                    echo "<th>Species</th>";
                    echo "<th>Date Of Birth</th>";
                    echo "<th>Gender</th>";
                    echo "<th>Enclosure ID</th>";
                echo "</tr>";

                // Fetch rows from Employee_Data
                while($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                    echo "<tr>";
                    echo "<td>" . $row["Animal_ID"] . "</td>";
                    echo "<td>" . $row["Animal_Name"] . "</td>";
                    echo "<td>" . $row["Species"] . "</td>";
                    echo "<td>" . $row["Date_Of_Birth"]->format('Y-m-d') . "</td>";
                    echo "<td>" . $row["Gender"] . "</td>";
                    echo "<td>" . $row["Enclosure_ID"] . "</td>";
                    echo "</tr>";
                }
            echo "</table>";
            echo "</div>";
        }
        ?>
    </div>
</body>
</html>
