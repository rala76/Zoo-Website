<?php
// Include default Department page
include(__DIR__."/../Department.php");

// Include process code for forms & tables
include(__DIR__."/process-departments.php");
?>

<!doctype html>
<html>
<head>
    <title>Search Departments</title>
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
            <select name="department-sortBy" class="dropdown-control">
                <!-- Default option -->
                <option value="<?php echo isset($_POST['department-sortBy']) ? $_POST['department-sortBy'] : '' ?>" hidden>
                    <?php echo isset($_POST['department-sortBy']) ? $_POST['department-sortBy'] : 'Select an Option' ?>
                </option>

                <option value="Department ID">Department ID</option>
                <option value="Department Name">Department Name</option>
            </select><br>

            <!-- Dropdown list for Order By -->
            <label class="input-label">Order By:</label><br>
            <select name="department-orderBy" class="dropdown-control">
                <!-- Default option -->
                <option value="<?php echo isset($_POST['department-orderBy']) ? $_POST['department-orderBy'] : '' ?>" hidden>
                    <?php echo isset($_POST['department-orderBy']) ? $_POST['department-orderBy'] : 'Select an Option' ?>
                </option>

                <option value="Ascending">Ascending</option>
                <option value="Descending">Descending</option>
            </select><br>

            <button name="department-search-submit" type="submit" class="form-submit">Submit</button>
        </form>

        <!-- Break row -->
        <div class="break-row"></div>

        <!-- ==================================================================================================== -->
        <!-- ==================================================================================================== -->

        <!-- Display Departments as table -->
        <div>
        <label class='form-control'></label><br>
            <table class='styled-table'>
                <tr>
                <th>Department ID</th>
                <th>Department Name</th>
                </tr>

                <!-- Fetch rows from Department -->
                <?php while($row = sqlsrv_fetch_array($stmt_6, SQLSRV_FETCH_ASSOC)): ?>
                    <tr>
                        <td><?php echo $row["Department_ID"] ?></td>
                        <td><?php echo $row["Department_Name"] ?></td>
                    </tr>
                <?php endwhile; ?>
            </table>
        </div>

</body>
</html>
