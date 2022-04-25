<?php

include(__DIR__."/../Login/tables.php");

// Include process code for forms & tables
include(__DIR__ . "/process-events.php");
?>

<!doctype html>
<html>

<head>
    <title>Search Events</title>
    <link rel="stylesheet" href="/Styles/popupStyles.css">

    <!-- Include JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<body>
    <div class="form-base">
        <!-- Sort table results -->
        <form method="post">
            <!-- Dropdown list for Sort By -->
            <label class="input-label">Sort By:</label><br>
            <select name="Event-sortBy" class="dropdown-control">
                <!-- Default option -->
                <option value="<?php echo isset($_POST['Event-sortBy']) ? $_POST['Event-sortBy'] : '' ?>" hidden>
                    <?php echo isset($_POST['Event-sortBy']) ? $_POST['Event-sortBy'] : 'Select an Option' ?>
                </option>

                <option value="Event ID">Event ID</option>
                <option value="Event Name">Event Name</option>
                <option value="Number of Attendees">Number of Attendees</option>
                <option value="Weekly Revenue">Weekly Revenue</option>
                <option value="Event Date">Event Date</option>
                <option value="Event Time">Event Time</option>
            </select><br>

            <!-- Dropdown list for Order By -->
            <label class="input-label">Order By:</label><br>
            <select name="Event-orderBy" class="dropdown-control">
                <!-- Default option -->
                <option value="<?php echo isset($_POST['Event-orderBy']) ? $_POST['Event-orderBy'] : '' ?>" hidden>
                    <?php echo isset($_POST['Event-orderBy']) ? $_POST['Event-orderBy'] : 'Select an Option' ?>
                </option>

                <option value="Ascending">Ascending</option>
                <option value="Descending">Descending</option>
            </select><br>

            <button name="Event-search-submit" type="submit" class="form-submit">Submit</button>
        </form>

        <!-- ==================================================================================================== -->
        <!-- ==================================================================================================== -->

        <!-- Break row -->
        <div class='break-row'></div>
        <div class='break-row'></div>
        <div class='break-row'></div>
        <div class='break-row'></div>

        <!-- Insert Event -->
        <form action="#insert-popup" method="post" style="margin-bottom: -10%">
            <button name='event-insert-1' id='event-insert-1' type='submit' class="button button-insert">Insert Event</button>
        </form>

        <div class='break-row'></div>
        <!-- ==================================================================================================== -->
        <!-- ==================================================================================================== -->

        <!-- Display Event as table -->
        <div>
            <label class='form-control'></label><br>
            <table class='styled-table'>
                <tr>
                    <th>Event ID</th>
                    <th>Event Name</th>
                    <th>Number of Attendees</th>
                    <th>Weekly Revenue</th>
                    <th>Event Date</th>
                    <th>Event Time</th>

                    <th colspan="2">Action</th>
                </tr>

                <!-- Fetch rows from Event_Data -->
                <?php while ($row = sqlsrv_fetch_array($stmt_6, SQLSRV_FETCH_ASSOC)) : ?>
                    <tr>
                        <td><?php echo $row["Event_ID"] ?></td>
                        <td><?php echo $row["Event_Name"] ?></td>
                        <td><?php echo $row["Num_Attendees"] ?></td>
                        <td>$<?php echo $row["Weekly_Revenue"] ?></td>
                        <td><?php echo $row["Event_Date"]->format('Y-m-d') ?></td>
                        <td><?php echo $row["Event_Time"] ?></td>
                        
                        <td>
                        <form action="#edit-popup" method="post">
                                <input name="event-edit-ID-1" type="number" value="<?php echo $row['Event_ID'] ?>" hidden>

                                <button name='Event-edit-1' id='Event-edit-1' type='submit' class="button button-edit">Edit</button>
                        </form>
                        </td>
                        <td>
                            <form action="" method="post">
                                <input name="event-delete-ID" type="number" value="<?php echo $row['Event_ID'] ?>" hidden>

                                <button name='Event-delete' id='Event-delete' type='submit' class="button button-delete">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </table>
        </div>

        <!-- ==================================================================================================== -->
        <!-- ==================================================================================================== -->

        <!-- Edit form -->
        <div id="edit-popup" class="overlay">
            <div class="popup popup-form">
                <h2>Edit Event</h2>
                <a class="close" href="#">&times;</a>
                <div class="content content-form">
                    <form action="" method="post">
                        <!-- Hidden input to get Event ID -->
                        <input name="event-edit-ID-2" type="number" value="<?php echo $data['Event_ID'] ?>" hidden>

                        <label class="required-input-label">Event Name</label><br>
                        <input name="Event_Name" type="text" class="form-control" required 
                        value="<?php echo isset($data['Event_Name']) ? $data['Event_Name'] : '' ?>">
                        <br>

                        <label class="required-input-label">Number of Attendees</label><br>
                        <input name="Event-Num_Attendees" type="number" min="0" class="form-control" required 
                        value="<?php echo isset($data['Num_Attendees']) ? $data['Num_Attendees'] : '' ?>">
                        <br>

                        <label class="required-input-label">Weekly Revenue</label><br>
                        <input name="Event-Weekly_Revenue" type="number" step="0.1" class="form-control" required 
                        value="<?php echo isset($data['Weekly_Revenue']) ? $data['Weekly_Revenue'] : '' ?>">
                        <br>

                        <label class="required-input-label">Event Date (YYYY-MM-DD)</label><br>
                        <input name="Event_Date" type="text" class="form-control" required 
                        value="<?php echo isset($data['Event_Date']) ? $data['Event_Date']->format('Y-m-d') : '' ?>">

                        <label class="required-input-label">Event Time (HH:MM:SS)</label><br>
                        <input name="Event_Time" type="text" class="form-control" required
                        value="<?php echo isset($data['Event_Time']) ? $data['Event_Time'] : '' ?>">
                        <br>

                        <button name="Event-edit-2" type="submit" class="form-submit">Submit</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- ==================================================================================================== -->
        <!-- ==================================================================================================== -->

        <!-- Insert form -->
        <div id="insert-popup" class="overlay">
            <div class="popup popup-form">
                <h2>Insert Event</h2>
                <a class="close" href="#">&times;</a>
                <div class="content content-form">
                    <form action="" method="post">
                        <label class="required-input-label">Event Name</label><br>
                        <input name="Event_Name" type="text" class="form-control" required
                        value="<?php echo isset($_POST['Event_Name']) ? $_POST['Event_Name'] : '' ?>">
                        <br>

                        <label class="required-input-label">Number of Attendees</label><br>
                        <input name="Event-Num_Attendees" type="number" min="0" class="form-control" required
                        value="<?php echo isset($_POST['Event-Num_Attendees']) ? $_POST['Event-Num_Attendees'] : '' ?>">
                        <br>

                        <label class="required-input-label">Weekly Revenue</label><br>
                        <input name="Event-Weekly_Revenue" type="number" step="0.1" class="form-control" required
                        value="<?php echo isset($_POST['Event-Weekly_Revenue']) ? $_POST['Event-Weekly_Revenue'] : '' ?>">
                        <br>

                        <label class="required-input-label">Event Date (YYYY-MM-DD)</label><br>
                        <input name="event_Date" type="text" class="form-control" required
                        value="<?php echo isset($_POST['event_Date']) ? $_POST['event_Date'] : '' ?>">
                        <br>

                        <label class="required-input-label">Event Time (HH:MM:SS)</label><br>
                        <input name="event_Time" type="text" class="form-control" required
                        value="<?php echo isset($_POST['event_Time']) ? $_POST['event_Time'] : '' ?>">
                        <br>

                        <button name="Event-insert-2" type="submit" class="form-submit">Submit</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</body>
</html>