<!doctype html>
<html>
<head>
    <!-- Include default Enclosure page -->
    <?php include(__DIR__."/../Enclosure.php"); ?>

    <title>Delete Enclosure</title>
</head>
<body>
    <div class="form-base">
        <!-- Delete by ID from Enclosure_Data -->
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <label class="input-label">Delete by ID:</label>
            <details <?php echo isset($_POST['enclosure-delete-1']) ? 'open' : 'close' ?>>
            <summary>ID</summary>
                <label class="required-input-label">ID</label><br>
                <input name="enclosure-id-1" type="number" min="1" class="details-control" required
                value="<?php echo isset($_POST['enclosure-id-1']) ? $_POST['enclosure-id-1'] : '' ?>">
                <br>

                <button name="enclosure-delete-1" type="submit" class="form-submit">Submit</button>
            </details>
        </form>

        <?php
        // Connect to Microsoft Azure SQL Database
        include(__DIR__."/../../connect-sql.php");

        // Delete statement based on delete option
        if (isset($_POST["enclosure-delete-1"])) {
            $ID = $_POST["enclosure-id-1"];

            // Info of Enclosure to be deleted
            $sql_1 = "SELECT [Enclosure_ID], [Department_ID], [Num_Animals], [Maintenance_Fees]
                FROM [dbo].[Enclosure_Data] 
                WHERE [Enclosure_ID]='$ID'";

            // Create delete statement (ID)
            $sql_2 = "DELETE FROM [dbo].[Enclosure_Data] 
                WHERE [Enclosure_ID]='$ID'";
        }

        if (isset($_POST["enclosure-delete-1"])) {
            $message = "Successfully Deleted Enclosure";

            $stmt_1 = sqlsrv_query($conn, $sql_1); // Info of Enclosure to be deleted
            $stmt_2 = sqlsrv_query($conn, $sql_2); // Delete Enclosure
            if ($stmt_2 == false) {
                $message = "Failed to Delete Enclosure";
            }
            else if (sqlsrv_rows_affected($stmt_2) <= 0) {
                $message = "Enclosure Not Found";
            }

            echo "<h2>$message</h2>";

            // Break row
            echo "<div class='break-row'></div>";

            // Display Enclosure as table
            echo "<div>";
            echo "<label class='form-control'>Enclosure Deleted:</label><br>";
            echo "<table>";
                echo "<tr>";
                    echo "<th>Enclosure ID</th>";
                    echo "<th>Department ID</th>";
                    echo "<th>Number of Animals</th>";
                    echo "<th>Maintenance Fees</th>";
                echo "</tr>";

                // Fetch row from Enclosure_Data
                while($row = sqlsrv_fetch_array($stmt_1, SQLSRV_FETCH_ASSOC)) {
                    echo "<tr>";
                    echo "<td>" . $row["Enclosure_ID"] . "</td>";
                    echo "<td>" . $row["Department_ID"] . "</td>";
                    echo "<td>" . $row["Num_Animals"] . "</td>";
                    echo "<td>$" . number_format($row["Maintenance_Fees"], 2) . "</td>";
                    echo "</tr>";
                }
            echo "</table>";
            echo "</div>";
        }
        ?>
    </div>
</body>
</html>
