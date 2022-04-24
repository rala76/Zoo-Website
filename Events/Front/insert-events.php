<!doctype html>
<html>
<head>
    <!-- Include default Event page -->
    <?php include(__DIR__."/../Events.php"); ?>

    <title>Insert New Event</title>
</head>
<body>
    <div class="form-base">
        <!-- Insert form for Event_Data -->
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <label class="required-input-label">Event Name</label><br>
            <input name="Event-name" type="text" class="form-control" required
            value="<?php echo isset($_POST['Event-name']) ? $_POST['Event-name'] : '' ?>">
            <br>

            <label class="required-input-label">Number of Attendees</label><br>
            <input name="Event-numAttendees" type="number" min="0" class="form-control" required
            value="<?php echo isset($_POST['Event-numAttendees']) ? $_POST['Event-numAttendees'] : '' ?>">
            <br>

            <label class="required-input-label">Weekly Revenue</label><br>
            <input name="Event-weeklyRevenue" type="number" step="0.1" class="form-control" required
            value="<?php echo isset($_POST['Event-weeklyRevenue']) ? $_POST['Event-weeklyRevenue'] : '' ?>">
            <br>

            <label class="required-input-label">Event Date (YYYY-MM-DD)</label><br>
            <input name="Event-eventDate" type="text" class="form-control" required
            value="<?php echo isset($_POST['Event-eventDate']) ? $_POST['Event-eventDate'] : '' ?>">
            <br>

            <label class="required-input-label">Event Time (HH:MM:SS)</label><br>
            <input name="Event-eventTime" type="text" class="form-control" required
            value="<?php echo isset($_POST['Event-eventTime']) ? $_POST['Event-eventTime'] : '' ?>">
            <br>

            <button name="Event-submit" type="submit" class="form-submit">Submit</button>
        </form>
    
        <?php
        // Connect to Microsoft Azure SQL Database
        include(__DIR__."/../../connect-sql.php");

        // Get data from Event form once submit button is pressed
        if(isset($_POST["Event-submit"])) {
            $name = $_POST["Event-name"];
            $numAttendees = !empty($_POST["Event-numAttendees"]) ? $_POST["Event-numAttendees"] : "0";
            $weeklyRevenue = !empty($_POST["Event-weeklyRevenue"]) ? $_POST["Event-weeklyRevenue"] : "0";
            $eventDate = $_POST["Event-eventDate"];
            $eventTime = $_POST["Event-eventTime"];
           

            // Create insert statement
            $sql = "INSERT INTO [dbo].[Events] 
                ([Event_Name]
                ,[Num_Attendees]
                ,[Weekly_Revenue]
                ,[Event_Date]
                ,[Event_Time])
                VALUES 
                (?, ?, ?, ?, ?)";
            
            // Parameters of insert statement
            $params = array($name
                ,$numAttendees
                ,$weeklyRevenue
                ,$eventDate
                ,$eventTime);

            $stmt = sqlsrv_query($conn, $sql, $params);
            if ($stmt == false) {
                $message = "Failed to Insert New Event";
            }
            
            $message = "Successfully Inserted New Event";
            
            $sql_trigger = "SELECT * FROM [dbo].[Trigger_Outputs]";
            $stmt_trigger = sqlsrv_query($conn, $sql_trigger);
            if (sqlsrv_has_rows($stmt_trigger) == 1) {
                $message = "Failed to Insert New Event: Number Of Attendees Must Be <= 100";
            }

            $sql_delete_trigger = "DELETE FROM [dbo].[Trigger_Outputs]";
            $stmt_delete_trigger = sqlsrv_query($conn, $sql_delete_trigger);
            
            echo "<h2>$message</h2>";
        }
        ?>
    </div>
</body>
</html>
