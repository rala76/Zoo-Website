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
            $sql_1 = "SELECT [Event_Name], [Num_Attendees], [Weekly_Revenue]
                , [Event_Date], [Event_Time], [Event_ID]
                FROM [dbo].[Events] 
                WHERE [Event_ID]='$ID'";

            // Create delete statement (ID)
            $sql_2 = "DELETE FROM [dbo].[Events] 
                WHERE [Event_ID]='$ID'";
        }

        if (isset($_POST["event-delete-1"])) {
            // Status and error message to output on web page
            $message = "Successfully Deleted Event";
            $error_msg = NULL;

            $stmt_1 = sqlsrv_query($conn, $sql_1); // Info of event to be deleted
            $stmt_2 = sqlsrv_query($conn, $sql_2); // Delete event
            if ($stmt_2 == false) {
                $message = "Failed to Delete Event";
                $error_msg = sqlsrv_errors();
            }
            else if (sqlsrv_rows_affected($stmt_2) <= 0) {
                $message = "Event not found";
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

            // Display Event as table
            echo "<div>";
            echo "<label class='form-control'>Event Deleted:</label><br>";
            echo "<table>";
                echo "<tr>";
                    echo "<th>Event ID</th>";
                    echo "<th>Event Name</th>";
                    echo "<th>Number of Attendees</th>";
                    echo "<th>Weekly Revenue</th>";
                    echo "<th>Date</th>";
                    echo "<th>Time</th>";
                echo "</tr>";

                // Fetch row from Events
                while($row = sqlsrv_fetch_array($stmt_1, SQLSRV_FETCH_ASSOC)) {
                    echo "<tr>";
                    echo "<td>" . $row["Event_ID"] . "</td>";
                    echo "<td>" . $row["Event_Name"] . "</td>";
                    echo "<td>" . $row["Num_Attendees"] . "</td>";
                    echo "<td>" . $row["Weekly_Revenue"] . "</td>";
                    echo "<td>" . $row["Event_Date"]->format('Y-m-d') . "</td>";
                    echo "<td>" . $row["Event_Time"] . "</td>";
                    echo "</tr>";
                }
            echo "</table>";
            echo "</div>";
        }
        ?>
    </div>
</body>
</html>
