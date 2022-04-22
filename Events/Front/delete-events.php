<!doctype html>
<html>
<head>
    <!-- Include default Events page -->
    <?php include(__DIR__."/../Events.php"); ?>

    <title>Delete Event</title>
</head>
<body>
    <div class="form-base">
        <!-- Delete by ID from Events -->
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <label class="input-label">Delete by ID:</label>
            <details <?php echo isset($_POST['event-delete-1']) ? 'open' : 'close' ?>>
            <summary>ID</summary>
                <label class="required-input-label">ID</label><br>
                <input name="event-id-1" type="number" min="1" class="details-control" required
                value="<?php echo isset($_POST['event-id-1']) ? $_POST['event-id-1'] : '' ?>">
                <br>

                <button name="event-delete-1" type="submit" class="form-submit">Submit</button>
            </details>
        </form>

        <?php
        // Connect to Microsoft Azure SQL Database
        include(__DIR__."/../../connect-sql.php");

        // Delete statement based on delete option
        if (isset($_POST["event-delete-1"])) {
            $ID = $_POST["event-id-1"];

            // Info of event to be deleted
            $sql_1 = "SELECT [Event_ID], [Event_Name], [Event_Date], [Event_Time]
                , [Num_Attendees], [Weekly_Revenue]
                FROM [dbo].[Events] 
                WHERE [Event_ID]='$ID'";

            // Create delete statement (ID)
            $sql_2 = "DELETE FROM [dbo].[Events] 
                WHERE [Event_ID]='$ID'";
        }

        if (isset($_POST["event-delete-1"])) {
            $message = "Successfully Deleted Event";

            $stmt_1 = sqlsrv_query($conn, $sql_1); // Info of event to be deleted
            $stmt_2 = sqlsrv_query($conn, $sql_2); // Delete event
            if ($stmt_2 == false) {
                $message = "Failed to Delete Event";
            }
            else if (sqlsrv_rows_affected($stmt_2) <= 0) {
                $message = "Event Not Found";
            }
            
            echo "<h2>$message</h2>";

            // Break row
            echo "<div class='break-row'></div>";

            // Display Event as table
            echo "<div>";
            echo "<label class='form-control'>Event Deleted:</label><br>";
            echo "<table>";
                echo "<tr>";
                    echo "<th>Event ID</th>";
                    echo "<th>Event Name</th>";
                    echo "<th>Event Date</th>";
                    echo "<th>Event Time</th>";
                    echo "<th>Number of Attendees</th>";
                    echo "<th>Weekly Revenue</th>";
                echo "</tr>";

                // Fetch row from Events
                while($row = sqlsrv_fetch_array($stmt_1, SQLSRV_FETCH_ASSOC)) {
                    echo "<tr>";
                    echo "<td>" . $row["Event_ID"] . "</td>";
                    echo "<td>" . $row["Event_Name"] . "</td>";
                    echo "<td>" . $row["Event_Date"]->format('Y-m-d') . "</td>";
                    echo "<td>" . $row["Event_Time"] . "</td>";
                    echo "<td>" . $row["Num_Attendees"] . "</td>";
                    echo "<td>$" . number_format($row["Weekly_Revenue"], 2) . "</td>";
                    echo "</tr>";
                }
            echo "</table>";
            echo "</div>";
        }
        ?>
    </div>
</body>
</html>
