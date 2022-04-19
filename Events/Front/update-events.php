<!doctype html>
<html>
<head>
    <!-- Include default Events page -->
    <?php include(__DIR__."/../Events.php"); ?>

    <title>Update Event</title>
</head>
<body>
    <div class="form-base">
        <?php
        // Connect to Microsoft Azure SQL Database
        include(__DIR__."/../../connect-sql.php");

        // Declare
        $row = NULL;

        // Select Event by ID & Fetch Event Data to display
        if(isset($_POST["event-update-1"])) {
            $ID = $_POST["event-id"];

            // Info of event to be updated
            $sql_1 = "SELECT *
                FROM [dbo].[Events] 
                WHERE [Event_ID]='$ID'";
            
            // Status and error message to output on web page
            $message = "Event Found";
            $error_msg = NULL;
            
            $stmt_1 = sqlsrv_query($conn, $sql_1);
            if ($stmt_1 == false) {
                $message = "Failed to Find Event";
                $error_msg = sqlsrv_errors();
            }
            else if (sqlsrv_has_rows($stmt_1) <= 0) {
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

            echo "<div class='break-row'></div>";

            // Fetch row from Events
            $row = sqlsrv_fetch_array($stmt_1, SQLSRV_FETCH_ASSOC);    
        }

        // Update Event Information
        if (isset($_POST["event-update-2"])) {
            $Event_Name = $_POST["event-name"];
            $Num_Attendees = !empty($_POST["event-num-attendees"]) ? $_POST["event-num-attendees"] : "0";
            $Weekly_Revenue = !empty($_POST["event-weekly-revenue"]) ? $_POST["event-weekly-revenue"] : "0";
            $Event_Date = $_POST["event-date"];
            $Event_Time = $_POST["event-time"];

            // Create update statement
            $ID = $_POST["event-id"];

            $sql_2 = "UPDATE [dbo].[Events] 
                SET [Event_Name] = '$Event_Name'
                ,[Num_Attendees] = '$Num_Attendees'
                ,[Weekly_Revenue] = '$Weekly_Revenue'
                ,[Event_Date] = '$Event_Date'
                ,[Event_Time] = '$Event_Time'
                WHERE [Event_ID]='$ID'";
            
            // Status and error message to output on web page
            $message = "Successfully Updated Event";
            $error_msg = NULL;

            $stmt_2 = sqlsrv_query($conn, $sql_2);
            if ($stmt_2 == false || sqlsrv_rows_affected($stmt_2) <= 0) {
                $message = "Failed to Update Event";
                $error_msg = sqlsrv_errors();
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

            echo "<div class='break-row'></div>";

            // Info of updated event
            $sql_1 = "SELECT *
                FROM [dbo].[Events] 
                WHERE [Event_ID]='$ID'";
            
            $stmt_1 = sqlsrv_query($conn, $sql_1);

            // Fetch updated event from Events
            $row = sqlsrv_fetch_array($stmt_1, SQLSRV_FETCH_ASSOC);
        }
        ?>

        <!-- Update form for Events -->
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <p style="font-size:large"><b>Event to Update:</b></p>

            <label class="required-input-label">Event ID:</label>
            <input name="event-id" type="number" min="1" class="form-control"
            value="<?php echo isset($_POST['event-id']) ? $_POST['event-id'] : '' ?>">
            <br>

            <button name="event-update-1" type="submit" class="form-submit">Submit</button>

            <!-- ============================================================================== -->

            <p style="font-size:large"><b>Update Fields:</b></p>

            <label class="required-input-label">Event Name</label><br>
            <input name="event-name" type="text" class="form-control"
            value="<?php echo isset($row['Event_Name']) ? $row['Event_Name'] : '' ?>">
            <br>

            <label class="required-input-label">Number of Attendees</label><br>
            <input name="event-num-attendees" type="number" min="0" class="form-control"
            value="<?php echo isset($row['Num_Attendees']) ? $row['Num_Attendees'] : '' ?>">
            <br>

            <label class="required-input-label">Weekly Revenue</label><br>
            <input name="event-weekly-revenue" type="number" step="0.1" class="form-control"
            value="<?php echo isset($row['Weekly_Revenue']) ? $row['Weekly_Revenue'] : '' ?>">
            <br>

            <label class="required-input-label">Event Date (YYYY-MM-DD)</label><br>
            <input name="event-date" type="text" class="form-control"
            value="<?php echo isset($row['Event_Date']) ? $row['Event_Date']->format('Y-m-d') : '' ?>">
            <br>

            <label class="required-input-label">Event Time (HH:MM:SS)</label><br>
            <input name="event-time" type="text" class="form-control"
            value="<?php echo isset($row['Event_Time']) ? $row['Event_Time'] : '' ?>">
            <br>

            <button name="event-update-2" type="submit" class="form-submit">Submit</button>
        </form>
    </div>
</body>
</html>
