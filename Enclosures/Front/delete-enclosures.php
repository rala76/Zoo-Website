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
            $sql_1 = "SELECT [Enclosure_ID], [Maintenance_Fees], [Num_Animals], [Department_ID]
                FROM [dbo].[Enclosure_Data] 
                WHERE [Enclosure_ID]='$ID'";

            // Create delete statement (ID)
            $sql_2 = "DELETE FROM [dbo].[Enclosure_Data] 
                WHERE [Enclosure_ID]='$ID'";
        }

        if (isset($_POST["enclosure-delete-1"])) {
            // Status and error message to output on web page
            $message = "Successfully Deleted Enclosure";
            $error_msg = NULL;

            $stmt_1 = sqlsrv_query($conn, $sql_1); // Info of Enclosure to be deleted
            $stmt_2 = sqlsrv_query($conn, $sql_2); // Delete Enclosure
            if ($stmt_2 == false) {
                $message = "Failed to Delete Enclosure";
                $error_msg = sqlsrv_errors();
            }
            else if (sqlsrv_rows_affected($stmt_2) <= 0) {
                $message = "Enclosure not found";
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

            // Display Enclosure as table
            echo "<div>";
            echo "<label class='form-control'>Enclosure Deleted:</label><br>";
            echo "<table>";
                echo "<tr>";
                    echo "<th>Enclosure ID</th>";
                    echo "<th>Maintenance Fees</th>";
                    echo "<th>Number of Animals</th>";
                    echo "<th>Department ID</th>";
                echo "</tr>";

                // Fetch row from Enclosure_Data
                while($row = sqlsrv_fetch_array($stmt_1, SQLSRV_FETCH_ASSOC)) {
                    echo "<tr>";
                    echo "<td>" . $row["Enclosure_ID"] . "</td>";
                    echo "<td>" . $row["Maintenance_Fees"] . "</td>";
                    echo "<td>" . $row["Num_Animals"] . "</td>";
                    echo "<td>" . $row["Department_ID"] . "</td>";
                    echo "</tr>";
                }
            echo "</table>";
            echo "</div>";
        }
        ?>
    </div>
</body>
</html>
