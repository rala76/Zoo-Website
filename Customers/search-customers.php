<?php

include(__DIR__."/../Login/tables.php");

// Include process code for forms & tables
include(__DIR__ . "/process-customers.php");
?>

<!doctype html>
<html>

<head>
    <title>Search Customers</title>
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
            <select name="Customer-sortBy" class="dropdown-control">
                <!-- Default option -->
                <option value="<?php echo isset($_POST['Customer-sortBy']) ? $_POST['Customer-sortBy'] : '' ?>" hidden>
                    <?php echo isset($_POST['Customer-sortBy']) ? $_POST['Customer-sortBy'] : 'Select an Option' ?>
                </option>

                <option value="Customer ID">Customer ID</option>
                <option value="First Name">First Name</option>
                <option value="Last Name">Last Name</option>
                <option value="Age">Age</option>

            </select><br>

            <label class="input-label">Customer Age:</label><br>
            <select name="customer-age" class="dropdown-control">
                <option value="<?php echo isset($_POST['customer-age']) ? $_POST['customer-age'] : '' ?>" hidden>
                    <?php echo isset($_POST['customer-age']) ? $_POST['customer-age'] : 'Select an Option' ?>
                </option>

                <option value="All">All</option>
                <option value="Child">Child</option>
                <option value="Adult">Adult</option>
                <option value="Senior">Senior</option>
            </select><br>

            <!-- Dropdown list for Order By -->
            <label class="input-label">Order By:</label><br>
            <select name="Customer-orderBy" class="dropdown-control">
                <!-- Default option -->
                <option value="<?php echo isset($_POST['Customer-orderBy']) ? $_POST['Customer-orderBy'] : '' ?>" hidden>
                    <?php echo isset($_POST['Customer-orderBy']) ? $_POST['Customer-orderBy'] : 'Select an Option' ?>
                </option>

                <option value="Ascending">Ascending</option>
                <option value="Descending">Descending</option>
            </select><br>

            <button name="Customer-search-submit" type="submit" class="form-submit">Submit</button>
        </form>

        <!-- ==================================================================================================== -->
        <!-- ==================================================================================================== -->

        <!-- Break row -->
        <div class='break-row'></div>
        <div class='break-row'></div>
        <div class='break-row'></div>
        <div class='break-row'></div>

        <!-- Insert Customer -->
        <form action="#insert-popup" method="post" style="margin-bottom: -10%">
            <button name='Customer-insert-1' id='Customer-insert-1' type='submit' class="button button-insert">Insert Customer</button>
        </form>

        <!-- Break row -->
        <div class='break-row'></div>

        <!-- ==================================================================================================== -->
        <!-- ==================================================================================================== -->

        <!-- Display Customer as table -->
        <div>
            <label class='form-control'></label><br>
            <table class='styled-table'>
                <tr>
                    <th>Customer ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Age</th>
                    <th colspan="2">Action</th>
                </tr>

                <!-- Fetch rows from Customer_Data -->
                <?php while ($row = sqlsrv_fetch_array($stmt_6, SQLSRV_FETCH_ASSOC)) : ?>
                    <tr>
                        <td><?php echo $row["Customer_ID"] ?></td>
                        <td><?php echo $row["Fname"] ?></td>
                        <td><?php echo $row["Lname"] ?></td>
                        <td><?php echo $row["Age"] ?></td>
                        <td>
                            <form action="#edit-popup" method="post">
                                <input name="customer-edit-ID-1" type="number" value="<?php echo $row['Customer_ID'] ?>" hidden>

                                <button name='Customer-edit-1' id='Customer-edit-1' type='submit' class="button button-edit">Edit</button>
                            </form>
                        </td>
                        <td>
                            <form action="" method="post">
                                <input name="customer-delete-ID" type="number" value="<?php echo $row['Customer_ID'] ?>" hidden>

                                <button name='Customer-delete' id='Customer-delete' type='submit' class="button button-delete">Delete</button>
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
                <h2>Edit Customer</h2>
                <a class="close" href="#">&times;</a>
                <div class="content content-form">
                    <form action="" method="post">
                        <!-- Hidden input to get Customer ID -->
                        <input name="customer-edit-ID-2" type="number" value="<?php echo $data['Customer_ID'] ?>" hidden>

                        <label class="required-input-label">First Name</label><br>
                        <input name="Customer-Fname" type="text" class="form-control" required value="<?php echo isset($data['Fname']) ? $data['Fname'] : '' ?>">
                        <br>

                        <label class="required-input-label">Last Name</label><br>
                        <input name="Customer-Lname" type="text" class="form-control" required value="<?php echo isset($data['Lname']) ? $data['Lname'] : '' ?>">
                        <br>

                        <label class="required-input-label">Age</label><br>
                        <input name="Customer-Age" type="number" min="1" class="form-control" required value="<?php echo isset($data['Age']) ? $data['Age'] : '' ?>">
                        <br>

                        <button name="Customer-edit-2" type="submit" class="form-submit">Submit</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- ==================================================================================================== -->
        <!-- ==================================================================================================== -->

        <!-- Insert form -->
        <div id="insert-popup" class="overlay">
            <div class="popup popup-form">
                <h2>Insert Customer</h2>
                <a class="close" href="#">&times;</a>
                <div class="content content-form">
                    <form action="" method="post">
                        <label class="required-input-label">First Name</label><br>
                        <input name="Customer-Fname" type="text" class="form-control" required value="<?php echo isset($_POST['Customer-Fname']) ? $_POST['Customer-Fname'] : '' ?>">
                        <br>

                        <label class="required-input-label">Last Name</label><br>
                        <input name="Customer-Lname" type="text" class="form-control" required value="<?php echo isset($_POST['Customer-Lname']) ? $_POST['Customer-Lname'] : '' ?>">
                        <br>

                        <label class="required-input-label">Age</label><br>
                        <input name="Customer-Age" type="number" min="1" class="form-control" required value="<?php echo isset($_POST['Customer-Age']) ? $_POST['Customer-Age'] : '' ?>">
                        <br>

                        <button name="Customer-insert-2" type="submit" class="form-submit">Submit</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</body>
</html>