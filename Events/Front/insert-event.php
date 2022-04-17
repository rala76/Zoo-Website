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
            <input name="Event-numAttendees" type="number" class="form-control" required
            value="<?php echo isset($_POST['Event-numAttendees']) ? $_POST['Event-numAttendees'] : '' ?>">
            <br>

            <label class="required-input-label">Weekly Revenue</label><br>
            <input name="Event-weeklyRevenue" type="number" class="form-control" required
            value="<?php echo isset($_POST['Event-weeklyRevenue']) ? $_POST['Event-weeklyRevenue'] : '' ?>">
            <br>

            <label class="required-input-label">Event Date (YYYY-MM-DD)</label><br>
            <input name="Event-eventDate" type="text" class="form-control" required
            value="<?php echo isset($_POST['Event-eventDate']) ? $_POST['Event-eventDate'] : '' ?>">
            <br>

            <label class="required-input-label">Event Time (HH:MM))</label><br>
            <input name="Event-eventTime" type="text" class="form-control" required
            value="<?php echo isset($_POST['Event-eventTime']) ? $_POST['Event-eventTime'] : '' ?>">
            <br>

            <label class="required-input-label">Event ID</label><br>
            <input name="Event-Event-id" type="number" min="1" class="form-control" 
            value="<?php echo isset($_POST['Event-Event-id']) ? $_POST['Event-Event-id'] : '' ?>">
            <br>

            
            <label class="required-input-label">Animal ID</label><br>
            <input name="Event-animal-id" type="number" min="1" class="form-control" 
            value="<?php echo isset($_POST['Event-animal-id']) ? $_POST['Event-animal-id'] : '' ?>">
            <br>

           

            <button name="Event-submit" type="submit" class="form-submit">Submit</button>
        </form>
    
        <?php
        // Connect to Microsoft Azure SQL Database
        include(__DIR__."/../../connect-sql.php");

        // Get data from Event form once submit button is pressed
        if(isset($_POST["Event-submit"])) {
            $name = $_POST["Event-name"];
            $numAttendees = !empty($_POST["Event-numAttendees"]) ? $_POST["Event-numAttendees"] : "0";;
            $weeklyRevenue = !empty($_POST["Event-weeklyRevenue"]) ? $_POST["Event-weeklyRevenue"] : "0";;
            $eventDate = $_POST["Event-eventDate"];
            $eventTime = $_POST["Event-eventTime"];
            $Event_ID = $_POST["Event-Event-id"] ;
            $Animal_ID =  $_POST["Event-animal-id"] ;
           

            // Create insert statement
            $sql = "INSERT INTO [dbo].[Events] 
                ([Event_Name]
                ,[Num_Attendees]
                ,[Weekly_Revenue]
                ,[Event_Date]
                ,[Event_Time]
                ,[Event_ID]
                ,[Animal_ID])
                VALUES 
                (?, ?, ?, ?, ?, ?)";
            
            // Parameters of insert statement
            $params = array($name
                ,$numAttendees
                ,$weeklyRevenue
                ,$eventDate
                ,$eventTime
                ,$Event_ID
                ,$Animal_ID);
            
            // Status and error message to output on web page
            $message = "Successfully Inserted New Event";
            $error_msg = NULL;

            $stmt = sqlsrv_query($conn, $sql, $params);
            if ($stmt == false) {
                //die(print_r(sqlsrv_errors(), true));
                $message = "Failed to Insert New Event";
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
        }
        ?>
    </div>
</body>
</html>
