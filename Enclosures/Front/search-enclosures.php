<?php
// Include default Enclosure page
include(__DIR__ . "/../Enclosure.php");

// Include process code for forms & tables
include(__DIR__ . "/process-enclosures.php");
?>

<!doctype html>
<html>

<head>
    <title>Search Enclosures</title>
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
            <select name="Enclosure-sortBy" class="dropdown-control">
                <!-- Default option -->
                <option value="<?php echo isset($_POST['Enclosure-sortBy']) ? $_POST['Enclosure-sortBy'] : '' ?>" hidden>
                    <?php echo isset($_POST['Enclosure-sortBy']) ? $_POST['Enclosure-sortBy'] : 'Select an Option' ?>
                </option>

                <option value="Maintenance Fees">Maintenance Fees</option>
                <option value="Number of Animals">Number of Animals</option>
                <option value="Enclosure ID">Enclosure ID</option>
                <option value="Department ID">Department ID</option>

            </select><br>

            <!-- Dropdown list for Order By -->
            <label class="input-label">Order By:</label><br>
            <select name="Enclosure-orderBy" class="dropdown-control">
                <!-- Default option -->
                <option value="<?php echo isset($_POST['Enclosure-orderBy']) ? $_POST['Enclosure-orderBy'] : '' ?>" hidden>
                    <?php echo isset($_POST['Enclosure-orderBy']) ? $_POST['Enclosure-orderBy'] : 'Select an Option' ?>
                </option>

                <option value="Ascending">Ascending</option>
                <option value="Descending">Descending</option>
            </select><br>

            <button name="Enclosure-search-submit" type="submit" class="form-submit">Submit</button>
        </form>

        <!-- ==================================================================================================== -->
        <!-- ==================================================================================================== -->

        <!-- Break row -->
        <div class='break-row'></div>

        <!-- Insert Enclosure -->
        <form action="#insert-popup" method="post" style="margin-bottom: -10%">
            <button name='Enclosure-insert-1' id='Enclosure-delete' type='submit' class="button button-insert">Insert Enclosure</button>
        </form>

        <!-- ==================================================================================================== -->
        <!-- ==================================================================================================== -->

        <!-- Display Enclosure as table -->
        <div>
            <label class='form-control'></label><br>
            <table class='styled-table'>
                <tr>
                    <th>Maintenance Fees</th>
                    <th>Number of Animals</th>
                    <th>Enclosure ID</th>
                    <th>Department ID</th>

                    <th colspan="2">Action</th>
                </tr>

                <!-- Fetch rows from Enclosure_Data -->
                <?php while ($row = sqlsrv_fetch_array($stmt_6, SQLSRV_FETCH_ASSOC)) : ?>
                    <tr>
                        <td><?php echo $row["Enclosure_ID"] ?></td>
                        <td><?php echo $row["Num_Animals"] ?></td>
                        <td><?php echo $row["Maintenance_Fees"] ?></td>
                        <td><?php echo $row["Department_ID"] ?></td>

                        <td>
                            <form action="#edit-popup" method="post">
                                <input name="emp-edit-ID-1" type="number" value="<?php echo $row['Enclosure_ID'] ?>" hidden>

                                <button name='Enclosure-edit-1' id='Enclosure-edit-1' type='submit' class="button button-edit">Edit</button>
                            </form>
                        </td>
                        <td>
                            <form action="" method="post">
                                <input name="emp-delete-ID" type="number" value="<?php echo $row['Enclosure_ID'] ?>" hidden>

                                <button name='Enclosure-delete' id='Enclosure-delete' type='submit' class="button button-delete">Delete</button>
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
                <h2>Edit Enclosure</h2>
                <a class="close" href="#">&times;</a>
                <div class="content content-form">
                    <form action="" method="post">
                        <!-- Hidden input to get Maintenance Fees -->
                        <input name="emp-edit-ID-2" type="number" value="<?php echo $data['Enclosure_ID'] ?>" hidden>

                        <label class="required-input-label">Number of Animals</label><br>
                        <input name="Enclosure-Num_Animals" type="text" class="form-control" required value="<?php echo isset($data['Num_Animals']) ? $data['Num_Animals'] : '' ?>">
                        <br>

                        <label class="required-input-label">Enclosure ID</label><br>
                        <input name="Enclosure-Maintenance_Fees" type="text" class="form-control" required value="<?php echo isset($data['Maintenance_Fees']) ? $data['Maintenance_Fees'] : '' ?>">
                        <br>

                        <label class="required-input-label">Department ID </label><br>
                        <input name="Enclosure-Department_ID" type="text" class="form-control" required value="<?php echo isset($data['Department_ID']) ? $data['Department_ID'] : '' ?>">
                        <br>



                        <button name="Enclosure-edit-2" type="submit" class="form-submit">Submit</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- ==================================================================================================== -->
        <!-- ==================================================================================================== -->

        <!-- Insert form -->
        <div id="insert-popup" class="overlay">
            <div class="popup popup-form">
                <h2>Insert Enclosure</h2>
                <a class="close" href="#">&times;</a>
                <div class="content content-form">
                    <form action="" method="post">
                        <label class="required-input-label">Number of Animals</label><br>
                        <input name="Enclosure-Num_Animals" type="text" class="form-control" required value="<?php echo isset($_POST['Enclosure-Num_Animals']) ? $_POST['Enclosure-Num_Animals'] : '' ?>">
                        <br>

                        <label class="required-input-label">Enclosure ID</label><br>
                        <input name="Enclosure-Maintenance_Fees" type="text" class="form-control" required value="<?php echo isset($_POST['Enclosure-Maintenance_Fees']) ? $_POST['Enclosure-Maintenance_Fees'] : '' ?>">
                        <br>

                        <label class="required-input-label">Department ID (YYYY-MM-DD)</label><br>
                        <input name="Enclosure-date-of-birth" type="text" class="form-control" required value="<?php echo isset($_POST['Enclosure-date-of-birth']) ? $_POST['Enclosure-date-of-birth'] : '' ?>">
                        <br>



                        <button name="Enclosure-insert-2" type="submit" class="form-submit">Submit</button>
                    </form>
                </div>
            </div>
        </div>

    </div>

    <!-- Popup alert when edit button clicked (TESTING JQuery) -->
    <!-- <script>
        $(document).ready(function() {
            $(document).on('click', '#Enclosure-edit-1', function() {
                alert("Edit button clicked");
            });
        });
    </script> -->

</body>

</html>