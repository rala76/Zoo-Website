<!doctype html>
<html>
<head>
    <!-- Include default Event page -->
    <?php include(__DIR__."/../Events.php"); ?>

    <title>Search Events</title>
</head>
<body>
    <div class="form-base">
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <!-- Dropdown list for Sort By -->
            <label class="required-input-label">Sort By:</label><br>
            <select name="event-sortBy" class="dropdown-control" required>
                <!-- Default option -->
                <option value="<?php echo isset($_POST['event-sortBy']) ? $_POST['event-sortBy'] : '' ?>" hidden>
                    <?php echo isset($_POST['event-sortBy']) ? $_POST['event-sortBy'] : 'Select an Option' ?>
                </option>

                <option value="Event ID">Event ID</option>
                <option value="Event Name">Event Name</option>
                <option value="Event Date">Event Date</option>
                <option value="Event Time">Event Time</option>
                <option value="Number of Attendees">Number of Attendees</option>
                <option value="Weekly Revenue">Weekly Revenue</option>
            </select><br>

            <!-- Dropdown list for Order By -->
            <label class="required-input-label">Order By:</label><br>
            <select name="event-orderBy" class="dropdown-control" required>
                <!-- Default option -->
                <option value="<?php echo isset($_POST['event-orderBy']) ? $_POST['event-orderBy'] : '' ?>" hidden>
                    <?php echo isset($_POST['event-orderBy']) ? $_POST['event-orderBy'] : 'Select an Option' ?>
                </option>

                <option value="Ascending">Ascending</option>
                <option value="Descending">Descending</option>
            </select><br>

            <button name="event-search-submit" type="submit" class="form-submit">Submit</button>
        </form>

        <?php
        // Connect to Microsoft Azure SQL Database
        include(__DIR__."/../../connect-sql.php");

        // Select query based on Sort/Order by
        if (isset($_POST["event-search-submit"])) {
            // Get Sort By value based on input
            if ($_POST["event-sortBy"] == "Event ID") {
                $Sort_By = "Event_ID";
            }
            else if ($_POST["event-sortBy"] == "Event Name") {
                $Sort_By = "Event_Name";
            }
            else if ($_POST["event-sortBy"] == "Event Date") {
                $Sort_By = "Event_Date";
            }
            else if ($_POST["event-sortBy"] == "Event Time") {
                $Sort_By = "Event_Time";
            }
            else if ($_POST["event-sortBy"] == "Number of Attendees") {
                $Sort_By = "Num_Attendees";
            }
            else {
                $Sort_By = "Weekly_Revenue";
            }
            

            // Create select query based on
            if ($_POST["event-orderBy"] == "Ascending") {
                $sql = "SELECT [Event_ID], [Event_Name], [Event_Date], [Event_Time]
                    , [Num_Attendees], [Weekly_Revenue]
                    FROM [dbo].[Events] 
                    ORDER BY '$Sort_By' ASC ";
            }
            else {
                $sql = "SELECT [Event_ID], [Event_Name], [Event_Date], [Event_Time]
                    , [Num_Attendees], [Weekly_Revenue]
                    FROM [dbo].[Events] 
                    ORDER BY '$Sort_By' DESC ";
            }

            $stmt = sqlsrv_query($conn, $sql);

            // Break row
            echo "<div class='break-row'></div>";

            // Display Event as table
            echo "<div>";
            echo "<label class='form-control'></label><br>";
            echo "<table>";
                echo "<tr>";
                    echo "<th>Event ID</th>";
                    echo "<th>Event Name</th>";
                    echo "<th>Event Date</th>";
                    echo "<th>Event Time</th>";
                    echo "<th>Number of Attendees</th>";
                    echo "<th>Weekly Revenue</th>";
                echo "</tr>";

                // Fetch rows from Employee_Data
                while($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
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
