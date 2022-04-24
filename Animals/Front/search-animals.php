<?php
// Include default Animal page
include(__DIR__ . "/../Animal.php");

// Include process code for forms & tables
include(__DIR__ . "/process-animals.php");
?>

<!doctype html>
<html>
<head>
    <title>Search Animals</title>
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
            <select name="Animal-sortBy" class="dropdown-control">
                <!-- Default option -->
                <option value="<?php echo isset($_POST['Animal-sortBy']) ? $_POST['Animal-sortBy'] : '' ?>" hidden>
                    <?php echo isset($_POST['Animal-sortBy']) ? $_POST['Animal-sortBy'] : 'Select an Option' ?>
                </option>

                <option value="Animal ID">Animal ID</option>
                <option value="Name">Name</option>
                <option value="Species">Species</option>
                <option value="Date of Birth">Date of Birth</option>
                <option value="Gender">Gender</option>
                <option value="Enclosure ID">Enclosure ID</option>

            </select><br>

            <!-- Dropdown list for Order By -->
            <label class="input-label">Order By:</label><br>
            <select name="Animal-orderBy" class="dropdown-control">
                <!-- Default option -->
                <option value="<?php echo isset($_POST['Animal-orderBy']) ? $_POST['Animal-orderBy'] : '' ?>" hidden>
                    <?php echo isset($_POST['Animal-orderBy']) ? $_POST['Animal-orderBy'] : 'Select an Option' ?>
                </option>

                <option value="Ascending">Ascending</option>
                <option value="Descending">Descending</option>
            </select><br>

            <button name="Animal-search-submit" type="submit" class="form-submit">Submit</button>
        </form>

        <!-- ==================================================================================================== -->
        <!-- ==================================================================================================== -->

        <!-- Break row -->
        <div class='break-row'></div>
        <div class='break-row'></div>
        <div class='break-row'></div>
        <div class='break-row'></div>

        <!-- Insert Animal -->
        <form action="#insert-popup" method="post" style="margin-bottom: -10%">
            <button name='Animal-insert-1' id='Animal-insert-1' type='submit' class="button button-insert">Insert Animal</button>
        </form>

        <!-- Break row -->
        <div class='break-row'></div>

        <!-- ==================================================================================================== -->
        <!-- ==================================================================================================== -->

        <!-- Display Animal as table -->
        <div>
            <label class='form-control'></label><br>
            <table class='styled-table'>
                <tr>
                    <th>Animal ID</th>
                    <th>Name</th>
                    <th>Species</th>
                    <th>Date of Birth</th>
                    <th>Gender</th>
                    <th>Enclosure ID</th>
                    <th colspan="2">Action</th>
                </tr>

                <!-- Fetch rows from Animal_Data -->
                <?php while ($row = sqlsrv_fetch_array($stmt_6, SQLSRV_FETCH_ASSOC)) : ?>
                    <tr>
                        <td><?php echo $row["Animal_ID"] ?></td>
                        <td><?php echo $row["Animal_Name"] ?></td>
                        <td><?php echo $row["Species"] ?></td>
                        <td><?php echo $row["Date_Of_Birth"]->format('Y-m-d') ?></td>
                        <td><?php echo $row["Gender"] ?></td>
                        <td><?php echo $row["Enclosure_ID"] ?></td>
                        <td>
                            <form action="#edit-popup" method="post">
                                <input name="animal-edit-ID-1" type="number" value="<?php echo $row['Animal_ID'] ?>" hidden>

                                <button name='Animal-edit-1' id='Animal-edit-1' type='submit' class="button button-edit">Edit</button>
                            </form>
                        </td>
                        <td>
                            <form action="" method="post">
                                <input name="animal-delete-ID" type="number" value="<?php echo $row['Animal_ID'] ?>" hidden>

                                <button name='Animal-delete' id='Animal-delete' type='submit' class="button button-delete">Delete</button>
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
                <h2>Edit Animal</h2>
                <a class="close" href="#">&times;</a>
                <div class="content content-form">
                    <form action="" method="post">
                        <!-- Hidden input to get Animal ID -->
                        <input name="animal-edit-ID-2" type="number" value="<?php echo $data['Animal_ID'] ?>" hidden>

                        <label class="required-input-label">Name</label><br>
                        <input name="Animal-Name" type="text" class="form-control" required 
                        value="<?php echo isset($data['Animal_Name']) ? $data['Animal_Name'] : '' ?>">
                        <br>

                        <label class="required-input-label">Species</label><br>
                        <input name="Animal-Species" type="text" class="form-control" required 
                        value="<?php echo isset($data['Species']) ? $data['Species'] : '' ?>">
                        <br>

                        <label class="required-input-label">Date of Birth (YYYY-MM-DD)</label><br>
                        <input name="Animal-date-of-birth" type="text" class="form-control" required 
                        value="<?php echo isset($data['Date_Of_Birth']) ? $data['Date_Of_Birth']->format('Y-m-d') : '' ?>">
                        <br>

                        <!-- Dropdown list for Gender -->
                        <label class="required-input-label">Gender</label><br>
                        <select name="Animal-gender" class="dropdown-control" required>
                            <!-- Default option -->
                            <option value="<?php echo isset($data['Gender']) ? $data['Gender'] : '' ?>" hidden>
                                <?php echo isset($data['Gender']) ? $data['Gender'] : 'Select an Option' ?>
                            </option>

                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select><br>

                        <label class="required-input-label">Animal ID</label><br>
                        <input name="Animal-Animal_ID" type="number" min="1" class="form-control" required 
                        value="<?php echo isset($data['Animal_ID']) ? $data['Animal_ID'] : '' ?>">
                        <br>

                        <label class="input-label">Enclosure ID</label><br>
                        <input name="Animal-Enclosure_ID" type="number" min="1" class="form-control" 
                        value="<?php echo isset($data['Enclosure_ID']) ? $data['Enclosure_ID'] : '' ?>">
                        <br>

                        <button name="Animal-edit-2" type="submit" class="form-submit">Submit</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- ==================================================================================================== -->
        <!-- ==================================================================================================== -->

        <!-- Insert form -->
        <div id="insert-popup" class="overlay">
            <div class="popup popup-form">
                <h2>Insert Animal</h2>
                <a class="close" href="#">&times;</a>
                <div class="content content-form">
                    <form method="post">
                        <label class="required-input-label">Name</label><br>
                        <input name="Animal-Name" type="text" class="form-control" required 
                        value="<?php echo isset($_POST['Animal-Name']) ? $_POST['Animal-Name'] : '' ?>">
                        <br>

                        <label class="required-input-label">Species</label><br>
                        <input name="Animal-Species" type="text" class="form-control" required 
                        value="<?php echo isset($_POST['Animal-Species']) ? $_POST['Animal-Species'] : '' ?>">
                        <br>

                        <label class="required-input-label">Date of Birth (YYYY-MM-DD)</label><br>
                        <input name="Animal-date-of-birth" type="text" class="form-control" required 
                        value="<?php echo isset($_POST['Animal-date-of-birth']) ? $_POST['Animal-date-of-birth'] : '' ?>">
                        <br>

                        <!-- Dropdown list for Gender -->
                        <label class="required-input-label">Gender</label><br>
                        <select name="Animal-gender" class="dropdown-control" required>
                            <!-- Default option -->
                            <option value="<?php echo isset($_POST['Animal-gender']) ? $_POST['Animal-gender'] : '' ?>" hidden>
                                <?php echo isset($_POST['Animal-gender']) ? $_POST['Animal-gender'] : 'Select an Option' ?>
                            </option>

                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select><br>

                        <label class="input-label">Enclosure ID</label><br>
                        <input name="Animal-Enclosure_ID" type="number" min="1" class="form-control" 
                        value="<?php echo isset($_POST['Animal-Enclosure_ID']) ? $_POST['Animal-Enclosure_ID'] : '' ?>">
                        <br>

                        <button name="Animal-insert-2" type="submit" class="form-submit">Submit</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</body>
</html>
