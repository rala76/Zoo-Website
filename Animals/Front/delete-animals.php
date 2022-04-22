<!doctype html>
<html>
<head>
    <!-- Include default Animal page -->
    <?php include(__DIR__."/../Animal.php"); ?>

    <title>Delete Animal</title>
</head>
<body>
    <div class="form-base">
        <!-- Delete by ID from Animal_Data -->
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <label class="input-label">Delete by ID:</label>
            <details <?php echo isset($_POST['animal-delete-1']) ? 'open' : 'close' ?>>
            <summary>ID</summary>
                <label class="required-input-label">ID</label><br>
                <input name="animal-id-1" type="number" min="1" class="details-control" required
                value="<?php echo isset($_POST['animal-id-1']) ? $_POST['animal-id-1'] : '' ?>">
                <br>

                <button name="animal-delete-1" type="submit" class="form-submit">Submit</button>
            </details>
        </form>

        <!-- Delete by ID + Name from Animal_Data -->
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <label class="input-label">Delete by ID + Name:</label>
            <details <?php echo isset($_POST['animal-delete-2']) ? 'open' : 'close' ?>>
            <summary>ID + Name</summary>
                <label class="required-input-label">ID</label><br>
                <input name="animal-id-2" type="number" min="1" class="details-control" required
                value="<?php echo isset($_POST['animal-id-2']) ? $_POST['animal-id-2'] : '' ?>">
                <br>

                <label class="required-input-label">Name</label><br>
                <input name="animal-name" type="text" class="details-control" required
                value="<?php echo isset($_POST['animal-name']) ? $_POST['animal-name'] : '' ?>">
                <br>

                <button name="animal-delete-2" type="submit" class="form-submit">Submit</button>
            </details>
        </form>

        <?php
        // Connect to Microsoft Azure SQL Database
        include(__DIR__."/../../connect-sql.php");

        // Delete statement based on delete option
        if (isset($_POST["animal-delete-1"])) {
            $ID = $_POST["animal-id-1"];

            // Info of animal to be deleted
            $sql_1 = "SELECT [Animal_ID], [Animal_Name], [Species], [Date_Of_Birth]
                , [Gender], [Enclosure_ID]
                FROM [dbo].[Animal_Data]
                WHERE [Animal_ID]='$ID'";

            // Create delete statement (ID)
            $sql_2 = "DELETE FROM [dbo].[Animal_Data] 
                WHERE [Animal_ID]='$ID'";
        }
        else if (isset($_POST["animal-delete-2"])) {
            $ID = $_POST["animal-id-2"];
            $Animal_Name = $_POST["animal-name"];

            // Info of animal to be deleted
            $sql_1 = "SELECT [Animal_ID], [Animal_Name], [Species], [Date_Of_Birth]
                , [Gender], [Enclosure_ID]
                FROM [dbo].[Animal_Data]
                WHERE [Animal_ID]='$ID' AND [Animal_Name]='$Animal_Name'";

            // Create delete statement (ID + Name)
            $sql_2 = "DELETE FROM [dbo].[Animal_Data] 
                WHERE [Animal_ID]='$ID' AND [Animal_Name]='$Animal_Name'";
        }

        if (isset($_POST["animal-delete-1"]) || isset($_POST["animal-delete-2"])) {
            $message = "Successfully Deleted Animal";

            $stmt_1 = sqlsrv_query($conn, $sql_1); // Info of animal to be deleted
            $stmt_2 = sqlsrv_query($conn, $sql_2); // Delete animal
            if ($stmt_2 == false) {
                $message = "Failed to Delete Animal";
            }
            else if (sqlsrv_rows_affected($stmt_2) <= 0) {
                $message = "Animal Not Found";
            }

            echo "<h2>$message</h2>";

            // Break row
            echo "<div class='break-row'></div>";

            // Display Animal as table
            echo "<div>";
            echo "<label class='form-control'>Animal Deleted:</label><br>";
            echo "<table>";
                echo "<tr>";
                    echo "<th>Animal ID</th>";
                    echo "<th>Animal Name</th>";
                    echo "<th>Species</th>";
                    echo "<th>Date Of Birth</th>";
                    echo "<th>Gender</th>";
                    echo "<th>Enclosure ID</th>";
                echo "</tr>";

                // Fetch row from Employee_Data
                while($row = sqlsrv_fetch_array($stmt_1, SQLSRV_FETCH_ASSOC)) {
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

