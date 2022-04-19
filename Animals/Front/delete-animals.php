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
            <details <?php echo isset($_POST['Animal-delete-1']) ? 'open' : 'close' ?>>
            <summary>ID</summary>
                <label class="required-input-label">ID</label><br>
                <input name="Animal-id-1" type="number" min="1" class="details-control" required
                value="<?php echo isset($_POST['Animal-id-1']) ? $_POST['Animal-id-1'] : '' ?>">
                <br>

                <button name="Animal-delete-1" type="submit" class="form-submit">Submit</button>
            </details>
        </form>

        <!-- Delete by ID + Name from Animal_Data -->
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <label class="input-label">Delete by ID + Name:</label>
            <details <?php echo isset($_POST['Animal-delete-2']) ? 'open' : 'close' ?>>
            <summary>ID + Name</summary>
                <label class="required-input-label">ID</label><br>
                <input name="Animal-id-2" type="number" min="1" class="details-control" required
                value="<?php echo isset($_POST['Animal-id-2']) ? $_POST['Animal-id-2'] : '' ?>">
                <br>

                <label class="required-input-label">First Name</label><br>
                <input name="Animal-Fname" type="text" class="details-control" required
                value="<?php echo isset($_POST['Animal-Fname']) ? $_POST['Animal-Fname'] : '' ?>">
                <br>

                <button name="Animal-delete-2" type="submit" class="form-submit">Submit</button>
            </details>
        </form>

        <?php
        // Connect to Microsoft Azure SQL Database
        include(__DIR__."/../../connect-sql.php");

        // Delete statement based on delete option
        if (isset($_POST["Animal-delete-1"])) {
            $ID = $_POST["Animal-id-1"];

            // Info of Animal to be deleted
            $sql_1 = "SELECT [Animal_ID], [Species], [Date_Of_Birth], [Gender], [Animal_ID], [Enclosure_ID]
                FROM [dbo].[Animal_Data] 
                WHERE [Animal_ID]='$ID'";

            // Create delete statement (ID)
            $sql_2 = "DELETE FROM [dbo].[Animal_Data] 
                WHERE [Animal_ID]='$ID'";
        }
        else if (isset($_POST["Animal-delete-2"])) {
            $ID = $_POST["Animal-id-2"];
            $Animal_Name = $_POST["Animal-Fname"];
            $Lname = $_POST["Animal-Lname"];

            // Info of Animal to be deleted
            $sql_1 = "SELECT [Animal_Name], [Species], [Date_Of_Birth], [Gender], [Animal_ID], [Enclosure_ID]
                FROM [dbo].[Animal_Data]
                WHERE [Animal_ID]='$ID' AND [Animal_Name]='$Animal_Name'";

            // Create delete statement (ID + Name)
            $sql_2 = "DELETE FROM [dbo].[Animal_Data] 
                WHERE [Animal_ID]='$ID' AND [Animal_Name]='$Animal_Name'";
        }

        if (isset($_POST["Animal-delete-1"]) || isset($_POST["Animal-delete-2"])) {
            // Status and error message to output on web page
            $message = "Successfully Deleted Animal";
            $error_msg = NULL;

            $stmt_1 = sqlsrv_query($conn, $sql_1); // Info of Animal to be deleted
            $stmt_2 = sqlsrv_query($conn, $sql_2); // Delete Animal
            if ($stmt_2 == false) {
                $message = "Failed to Delete Animal";
                $error_msg = sqlsrv_errors();
            }
            else if (sqlsrv_rows_affected($stmt_2) <= 0) {
                $message = "Animal not found";
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

            // Display Animal as table
            echo "<div>";
            echo "<label class='form-control'>Animal Deleted:</label><br>";
            echo "<table>";
                echo "<tr>";
                    echo "<th>Animal Name</th>";
                    echo "<th>Species</th>";
                    echo "<th>Date_Of_Birth</th>";
                    echo "<th>Gender</th>";
                    echo "<th>Animal ID</th>";
                    echo "<th>Enclosure ID</th>";
                echo "</tr>";

                // Fetch row from Animal_Data
                while($row = sqlsrv_fetch_array($stmt_1, SQLSRV_FETCH_ASSOC)) {
                    echo "<tr>";
                    echo "<td>" . $row["Animal_ID"] . "</td>";
                    echo "<td>" . $row["Animal_Name"] . "</td>";
                    echo "<td>" . $row["Species"] . "</td>";
                    echo "<td>" . $row["Date_Of_Birth"] . "</td>";
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
