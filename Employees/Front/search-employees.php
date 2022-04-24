<?php
// Include default Employee page
include(__DIR__."/../Employee.php");

// Include process code for forms & tables
include(__DIR__."/process-employees.php");
?>

<!doctype html>
<html>
<head>
    <title>Search Employees</title>
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
            <select name="employee-sortBy" class="dropdown-control">
                <!-- Default option -->
                <option value="<?php echo isset($_POST['employee-sortBy']) ? $_POST['employee-sortBy'] : '' ?>" hidden>
                    <?php echo isset($_POST['employee-sortBy']) ? $_POST['employee-sortBy'] : 'Select an Option' ?>
                </option>

                <option value="Employee ID">Employee ID</option>
                <option value="First Name">First Name</option>
                <option value="Last Name">Last Name</option>
                <option value="Date of Birth">Date of Birth</option>
                <option value="Department ID">Department ID</option>
                <option value="Hourly Wage">Hourly Wage</option>
                <option value="Weekly Hours Worked">Weekly Hours Worked</option>
            </select><br>

            <label class="input-label">Employee Status:</label><br>
            <select name="employee-status" class="dropdown-control">
                <!-- Default option -->
                <option value="<?php echo isset($_POST['employee-status']) ? $_POST['employee-status'] : '' ?>" hidden>
                    <?php echo isset($_POST['employee-status']) ? $_POST['employee-status'] : 'Select an Option' ?>
                </option>

                <option value="All">All</option>
                <option value="Part Time">Part Time</option>
                <option value="Full Time">Full Time</option>
            </select><br>

            <!-- Dropdown list for Order By -->
            <label class="input-label">Order By:</label><br>
            <select name="employee-orderBy" class="dropdown-control">
                <!-- Default option -->
                <option value="<?php echo isset($_POST['employee-orderBy']) ? $_POST['employee-orderBy'] : '' ?>" hidden>
                    <?php echo isset($_POST['employee-orderBy']) ? $_POST['employee-orderBy'] : 'Select an Option' ?>
                </option>

                <option value="Ascending">Ascending</option>
                <option value="Descending">Descending</option>
            </select><br>

            <button name="employee-search-submit" type="submit" class="form-submit">Submit</button>
        </form>

        <!-- ==================================================================================================== -->
        <!-- ==================================================================================================== -->

        <!-- Break row -->
        <div class='break-row'></div>
        <div class='break-row'></div>
        <div class='break-row'></div>
        <div class='break-row'></div>

        <!-- Insert Employee -->
        <form action="#insert-popup" method="post" style="margin-bottom: -10%">
            <button name='employee-insert-1' id='employee-insert-1' type='submit' class="button button-insert">Insert Employee</button>
        </form>

        <!-- Break row -->
        <div class='break-row'></div>

        <!-- ==================================================================================================== -->
        <!-- ==================================================================================================== -->

        <!-- Display Employee as table -->
        <div>
        <label class='form-control'></label><br>
            <table class='styled-table'>
                <tr>
                <th>Employee ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Date of Birth</th>
                <th>Gender</th>
                <th>Phone Number</th>
                <th>Department Name</th>
                <th>Department ID</th>
                <th>Hourly Wage</th>
                <th>Weekly Hours Worked</th>
                <th colspan="2">Action</th>
                </tr>

                <!-- Fetch rows from Employee_Data -->
                <?php while($row = sqlsrv_fetch_array($stmt_6, SQLSRV_FETCH_ASSOC)): ?>
                    <tr>
                        <td><?php echo $row["Employee_ID"] ?></td>
                        <td><?php echo $row["Fname"] ?></td>
                        <td><?php echo $row["Lname"] ?></td>
                        <td><?php echo $row["Date_Of_Birth"]->format('Y-m-d') ?></td>
                        <td><?php echo $row["Gender"] ?></td>
                        <td><?php echo $row["Phone_Number"] ?></td>
                        <td><?php echo $row["Department_Name"] ?></td>
                        <td><?php echo $row["Department_ID"] ?></td>
                        <td>$<?php echo number_format($row["Hourly_Wage"], 2) ?></td>
                        <td><?php echo $row["Weekly_Hours_Worked"] ?></td>
                        <td>
                            <form action="#edit-popup" method="post">
                                <input name="emp-edit-ID-1" type="number" value="<?php echo $row['Employee_ID'] ?>" hidden>
                                
                                <button name='employee-edit-1' id='employee-edit-1' type='submit' class="button button-edit">Edit</button>
                            </form>
                        </td>
                        <td>
                            <form action="" method="post">
                                <input name="emp-delete-ID" type="number" value="<?php echo $row['Employee_ID'] ?>" hidden>
                                
                                <button name='employee-delete' id='employee-delete' type='submit' class="button button-delete">Delete</button>
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
                <h2>Edit Employee</h2>
                <a class="close" href="#">&times;</a>
                <div class="content content-form">
                    <form action="" method="post">
                        <!-- Hidden input to get Employee ID -->
                        <input name="emp-edit-ID-2" type="number" value="<?php echo $data['Employee_ID'] ?>"  hidden>

                        <label class="required-input-label">First Name</label><br>
                        <input name="employee-Fname" type="text" class="form-control" required
                        value="<?php echo isset($data['Fname']) ? $data['Fname'] : '' ?>">
                        <br>

                        <label class="required-input-label">Last Name</label><br>
                        <input name="employee-Lname" type="text" class="form-control" required
                        value="<?php echo isset($data['Lname']) ? $data['Lname'] : '' ?>">
                        <br>

                        <label class="required-input-label">Date of Birth (YYYY-MM-DD)</label><br>
                        <input name="employee-date-of-birth" type="text" class="form-control" required
                        value="<?php echo isset($data['Date_Of_Birth']) ? $data['Date_Of_Birth']->format('Y-m-d') : '' ?>">
                        <br>

                        <!-- Dropdown list for Gender -->
                        <label class="required-input-label">Gender</label><br>
                        <select name="employee-gender" class="dropdown-control" required>
                            <!-- Default option -->
                            <option value="<?php echo isset($data['Gender']) ? $data['Gender'] : '' ?>" hidden>
                                <?php echo isset($data['Gender']) ? $data['Gender'] : 'Select an Option' ?>
                            </option>

                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select><br>

                        <label class="input-label">Phone Number (###-###-####)</label><br>
                        <input name="employee-phone-number" type="text" class="form-control" placeholder="NULL"
                        value="<?php echo isset($data['Phone_Number']) ? $data['Phone_Number'] : '' ?>">
                        <br>

                        <!-- Dropdown list for Department_Name -->
                        <label class="required-input-label">Department Name</label><br>
                        <select name="employee-department-name" class="dropdown-control" required>
                            <!-- Default option -->
                            <option value="<?php echo isset($data['Department_Name']) ? $data['Department_Name'] : '' ?>" hidden>
                                <?php echo isset($data['Department_Name']) ? $data['Department_Name'] : 'Select an Option' ?>
                            </option>

                            <option value="Animal Enclosure">Animal Enclosure</option>
                            <option value="Stores">Stores</option>
                            <option value="Ticket Office">Ticket Office</option>
                        </select><br>

                        <label class="required-input-label">Department ID</label><br>
                        <input name="employee-department-id" type="number" min="1" class="form-control" placeholder="NULL" required
                        value="<?php echo isset($data['Department_ID']) ? $data['Department_ID'] : '' ?>">
                        <br>

                        <label class="input-label">Hourly Wage</label><br>
                        <input name="employee-hourly-wage" type="number" min="0" step="0.01" class="form-control" placeholder="0"
                        value="<?php echo isset($data['Hourly_Wage']) ? $data['Hourly_Wage'] : '' ?>">
                        <br>

                        <label class="input-label">Weekly Wage</label><br>
                        <input name="employee-weekly-wage" type="number" min="0" step="0.01" class="form-control" placeholder="0"
                        value="<?php echo isset($data['Weekly_Wage']) ? $data['Weekly_Wage'] : '' ?>">
                        <br>

                        <label class="input-label">Weekly Hours Worked</label><br>
                        <input name="employee-weekly-hours-worked" type="number" min="0" class="form-control" placeholder="0"
                        value="<?php echo isset($data['Weekly_Hours_Worked']) ? $data['Weekly_Hours_Worked'] : '' ?>">
                        <br>

                        <button name="employee-edit-2" type="submit" class="form-submit">Submit</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- ==================================================================================================== -->
        <!-- ==================================================================================================== -->

        <!-- Insert form -->
        <div id="insert-popup" class="overlay">
            <div class="popup popup-form">
                <h2>Insert Employee</h2>
                <a class="close" href="#">&times;</a>
                <div class="content content-form">
                    <form action="" method="post">
                        <label class="required-input-label">First Name</label><br>
                        <input name="employee-Fname" type="text" class="form-control" required
                        value="<?php echo isset($_POST['employee-Fname']) ? $_POST['employee-Fname'] : '' ?>">
                        <br>

                        <label class="required-input-label">Last Name</label><br>
                        <input name="employee-Lname" type="text" class="form-control" required
                        value="<?php echo isset($_POST['employee-Lname']) ? $_POST['employee-Lname'] : '' ?>">
                        <br>

                        <label class="required-input-label">Date of Birth (YYYY-MM-DD)</label><br>
                        <input name="employee-date-of-birth" type="text" class="form-control" required
                        value="<?php echo isset($_POST['employee-date-of-birth']) ? $_POST['employee-date-of-birth'] : '' ?>">
                        <br>

                        <!-- Dropdown list for Gender -->
                        <label class="required-input-label">Gender</label><br>
                        <select name="employee-gender" class="dropdown-control" required>
                            <!-- Default option -->
                            <option value="<?php echo isset($_POST['employee-gender']) ? $_POST['employee-gender'] : '' ?>" hidden>
                                <?php echo isset($_POST['employee-gender']) ? $_POST['employee-gender'] : 'Select an Option' ?>
                            </option>

                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select><br>

                        <label class="input-label">Phone Number (###-###-####)</label><br>
                        <input name="employee-phone-number" type="text" class="form-control" placeholder="NULL"
                        value="<?php echo isset($_POST['employee-phone-number']) ? $_POST['employee-phone-number'] : '' ?>">
                        <br>

                        <!-- Dropdown list for Department_Name -->
                        <label class="required-input-label">Department Name</label><br>
                        <select name="employee-department-name" class="dropdown-control" required>
                            <!-- Default option -->
                            <option value="<?php echo isset($_POST['employee-department-name']) ? $_POST['employee-department-name'] : '' ?>" hidden>
                                <?php echo isset($_POST['employee-department-name']) ? $_POST['employee-department-name'] : 'Select an Option' ?>
                            </option>

                            <option value="Animal Enclosure">Animal Enclosure</option>
                            <option value="Stores">Stores</option>
                            <option value="Ticket Office">Ticket Office</option>
                        </select><br>

                        <label class="required-input-label">Department ID</label><br>
                        <input name="employee-department-id" type="number" min="1" class="form-control" placeholder="NULL" required
                        value="<?php echo isset($_POST['employee-department-id']) ? $_POST['employee-department-id'] : '' ?>">
                        <br>

                        <label class="input-label">Hourly Wage</label><br>
                        <input name="employee-hourly-wage" type="number" min="0" step="0.01" class="form-control" placeholder="0"
                        value="<?php echo isset($_POST['employee-hourly-wage']) ? $_POST['employee-hourly-wage'] : '' ?>">
                        <br>

                        <label class="input-label">Weekly Wage</label><br>
                        <input name="employee-weekly-wage" type="number" min="0" step="0.01" class="form-control" placeholder="0"
                        value="<?php echo isset($_POST['employee-weekly-wage']) ? $_POST['employee-weekly-wage'] : '' ?>">
                        <br>

                        <label class="input-label">Weekly Hours Worked</label><br>
                        <input name="employee-weekly-hours-worked" type="number" min="0" class="form-control" placeholder="0"
                        value="<?php echo isset($_POST['employee-weekly-hours-worked']) ? $_POST['employee-weekly-hours-worked'] : '' ?>">
                        <br>

                        <button name="employee-insert-2" type="submit" class="form-submit">Submit</button>
                    </form>
                </div>
            </div>
        </div>

    </div>

    <!-- Popup alert when edit button clicked (TESTING JQuery) -->
    <!-- <script>
        $(document).ready(function() {
            $(document).on('click', '#employee-edit-1', function() {
                alert("Edit button clicked");
            });
        });
    </script> -->
    
</body>
</html>
