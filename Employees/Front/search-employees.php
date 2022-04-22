<?php
// Include default Employee page
include(__DIR__."/../Employee.php");

// Connect to Microsoft Azure SQL Database
include(__DIR__."/../../connect-sql.php");

// Get input values for Edit form
if (isset($_POST["employee-edit-1"])) {
    $Employee_ID = $_POST["emp-edit-ID-1"];

    // Info of employee to be updated
    $sql_4 = "SELECT * FROM [dbo].[Employee_Data] 
        WHERE [Employee_ID]={$Employee_ID}";
    
    $stmt_4 = sqlsrv_query($conn, $sql_4);
    if ($stmt_4 == false) {
        echo "<script> alert('Failed to Find Employee'); </script>";
    }
    else if (sqlsrv_has_rows($stmt_4) <= 0) {
        echo "<script> alert('Employee Not Found'); </script>";
    }

    // Fetch Employee from Employee_Data
    $data = sqlsrv_fetch_array($stmt_4, SQLSRV_FETCH_ASSOC);
}

// Update employee based on Edit form
if (isset($_POST["employee-edit-2"])) {
    $Employee_ID = $_POST["emp-edit-ID-2"];

    $Fname = $_POST["employee-Fname"];
    $Lname = $_POST["employee-Lname"];
    $Date_Of_Birth = $_POST["employee-date-of-birth"];
    $Gender = $_POST["employee-gender"];
    $Phone_Number = !empty($_POST["employee-phone-number"]) ? $_POST["employee-phone-number"] : NULL;
    $Department_Name = $_POST["employee-department-name"];
    $Department_ID = $_POST["employee-department-id"];
    $Hourly_Wage = !empty($_POST["employee-hourly-wage"]) ? $_POST["employee-hourly-wage"] : "0";
    $Weekly_Wage = !empty($_POST["employee-weekly-wage"]) ? $_POST["employee-weekly-wage"] : "0";
    $Weekly_Hours_Worked = !empty($_POST["employee-weekly-hours-worked"]) ? $_POST["employee-weekly-hours-worked"] : "0";

    $sql_3 = "UPDATE [dbo].[Employee_Data] 
        SET [Fname] = '$Fname'
        ,[Lname] = '$Lname'
        ,[Date_Of_Birth] = '$Date_Of_Birth'
        ,[Gender] = '$Gender'
        ,[Phone_Number] = '$Phone_Number'
        ,[Department_Name] = '$Department_Name'
        ,[Department_ID] = '$Department_ID'
        ,[Hourly_Wage] = '$Hourly_Wage'
        ,[Weekly_Wage] = '$Weekly_Wage'
        ,[Weekly_Hours_Worked] = '$Weekly_Hours_Worked'
        WHERE [Employee_ID]='$Employee_ID'";
    
    $stmt_3 = sqlsrv_query($conn, $sql_3);
    if ($stmt_3 == false || sqlsrv_rows_affected($stmt_3) <= 0) {
        echo "<script> alert('Failed to Update Employee'); </script>";
    }
    else {
        echo "<script> alert('Successfully Updated Employee'); </script>";
    }
}

// Delete employee
if (isset($_POST["employee-delete"])) {
    $Employee_ID = $_POST["emp-delete-ID"];

    $sql_2 = "DELETE FROM [dbo].[Employee_Data]
        WHERE [Employee_ID]={$Employee_ID}";
    
    $stmt_2 = sqlsrv_query($conn, $sql_2);
    if ($stmt_2 == false) {
        echo "<script> alert('Failed to Delete Employee'); </script>";
    }
    else if (sqlsrv_rows_affected($stmt_2) <= 0) {
        echo "<script> alert('Employee Not Found'); </script>";
    }
    else {
        echo "<script> alert('Successfully Deleted Employee'); </script>";
    }
}

// Select query based on Sort/Order by value
if (!isset($_POST["employee-search-submit"])) {
    $_POST["employee-sortBy"] = "Employee ID";
    $_POST["employee-orderBy"] = "Ascending";

    $sql_1 = "SELECT [Employee_ID], [Fname], [Lname], [Date_Of_Birth]
        , [Gender], [Phone_Number], [Department_Name], [Department_ID]
        , [Hourly_Wage], [Weekly_Hours_Worked]
        FROM [dbo].[Employee_Data] 
        ORDER BY Employee_ID ASC ";
}
else {
    // Get Sort By value based on input
    if ($_POST["employee-sortBy"] == "Employee ID") { $Sort_By = "Employee_ID"; }
    else if ($_POST["employee-sortBy"] == "First Name") { $Sort_By = "Fname"; }
    else if ($_POST["employee-sortBy"] == "Last Name") { $Sort_By = "Lname"; }
    else if ($_POST["employee-sortBy"] == "Date of Birth") { $Sort_By = "Date_Of_Birth"; }
    else if ($_POST["employee-sortBy"] == "Department ID") { $Sort_By = "Department_ID"; }
    else if ($_POST["employee-sortBy"] == "Hourly Wage") { $Sort_By = "Hourly_Wage"; }
    else { $Sort_By = "Weekly_Hours_Worked"; }

    // Create select query based on
    if ($_POST["employee-orderBy"] == "Ascending") {
        $sql_1 = "SELECT [Employee_ID], [Fname], [Lname], [Date_Of_Birth]
            , [Gender], [Phone_Number], [Department_Name], [Department_ID]
            , [Hourly_Wage], [Weekly_Hours_Worked]
            FROM [dbo].[Employee_Data] 
            ORDER BY '$Sort_By' ASC ";
    }
    else {
        $sql_1 = "SELECT [Employee_ID], [Fname], [Lname], [Date_Of_Birth]
            , [Gender], [Phone_Number], [Department_Name], [Department_ID]
            , [Hourly_Wage], [Weekly_Hours_Worked]
            FROM [dbo].[Employee_Data] 
            ORDER BY '$Sort_By' DESC ";
    }
}

$stmt_1 = sqlsrv_query($conn, $sql_1);
if ($stmt_1 == false) {
    echo "<script> alert('Failed to load table') </script>";
}

?>

<!doctype html>
<html>
<head>
    <title>Search Employees</title>
    <link rel="stylesheet" href="/Styles/popupStyles.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>
    <div class="form-base">
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

        <!-- Break row -->
        <div class='break-row'></div>

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
                <!-- <th></th> -->
                </tr>

                <!-- Fetch rows from Employee_Data -->
                <?php while($row = sqlsrv_fetch_array($stmt_1, SQLSRV_FETCH_ASSOC)): ?>
                    <tr>
                        <td><?php echo $row["Employee_ID"] ?></td>
                        <td><?php echo $row["Fname"] ?></td>
                        <td><?php echo $row["Lname"] ?></td>
                        <td><?php echo $row["Date_Of_Birth"]->format('Y-m-d') ?></td>
                        <td><?php echo $row["Gender"] ?></td>
                        <td><?php echo $row["Phone_Number"] ?></td>
                        <td><?php echo $row["Department_Name"] ?></td>
                        <td><?php echo $row["Department_ID"] ?></td>
                        <td><?php echo number_format($row["Hourly_Wage"], 2) ?></td>
                        <td><?php echo $row["Weekly_Hours_Worked"] ?></td>
                        <td>
                            <form action="#edit-popup" method="post">
                                <input name="emp-edit-ID-1" type="number" value="<?php echo $row['Employee_ID'] ?>" hidden>
                                
                                <button name='employee-edit-1' id='employee-edit-1' type='submit' class="button button-edit">Edit</button>
                            </form>
                        </td>
                        <td>
                            <form method="post">
                                <input name="emp-delete-ID" type="number" value="<?php echo $row['Employee_ID'] ?>" hidden>
                                
                                <button name='employee-delete' id='employee-delete' type='submit' class="button button-delete">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </table>
        </div>

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

    </div>

    <!-- <script>
        $(document).ready(function() {
            $(document).on('click', '#employee-edit-1', function() {
                alert("Edit button clicked");
            });
        });
    </script> -->
    
</body>
</html>
