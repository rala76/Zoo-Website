<?php

include(__DIR__."/../Login/tables.php");

// Include process code for forms & tables
include(__DIR__."/process-stores.php");
?>

<!doctype html>
<html>
<head>
    <title>Search Stores</title>
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
            <select name="store-sortBy" class="dropdown-control" required>
                <!-- Default option -->
                <option value="<?php echo isset($_POST['store-sortBy']) ? $_POST['store-sortBy'] : '' ?>" hidden>
                    <?php echo isset($_POST['store-sortBy']) ? $_POST['store-sortBy'] : 'Select an Option' ?>
                </option>

                <option value="Store ID">Store ID</option>
                <option value="Store Name">Store Name</option>
                <option value="Category">Category</option>
                <option value="Department ID">Department ID</option>
                <option value="Hours Of Operation">Hours Of Operation</option>
                <option value="Number Of Customers">Number of Customers</option>
                <option value="Product ID">Product ID</option>
                <option value="Weekly Revenue">Weekly Revenue</option>
            </select><br>

            <!-- Dropdown list for Order By -->
            <label class="input-label">Order By:</label><br>
            <select name="store-orderBy" class="dropdown-control" required>
                <!-- Default option -->
                <option value="<?php echo isset($_POST['store-orderBy']) ? $_POST['store-orderBy'] : '' ?>" hidden>
                    <?php echo isset($_POST['store-orderBy']) ? $_POST['store-orderBy'] : 'Select an Option' ?>
                </option>

                <option value="Ascending">Ascending</option>
                <option value="Descending">Descending</option>
            </select><br>

            <button name="store-search-submit" type="submit" class="form-submit">Submit</button>
        </form>

        <!-- ==================================================================================================== -->
        <!-- ==================================================================================================== -->

        <!-- Break row -->
        <div class='break-row'></div>
        <div class='break-row'></div>
        <div class='break-row'></div>
        <div class='break-row'></div>

        <!-- Insert Store -->
        <form action="#insert-popup" method="post" style="margin-bottom: -10%">
            <button name='store-insert-1' id='store-insert-1' type='submit' class="button button-insert">Insert Store</button>
        </form>

        <!-- Break row -->
        <div class='break-row'></div>

        <!-- ==================================================================================================== -->
        <!-- ==================================================================================================== -->

        <!-- Display Stores as table -->
        <div>
        <label class='form-control'></label><br>
            <table class='styled-table'>
                <tr>
                <th>Store ID</th>
                <th>Store Name</th>
                <th>Category</th>
                <th>Department ID</th>
                <th>Hours Of Operation</th>
                <th>Number Of Customers</th>
                <th>Product ID</th>
                <th>Weekly Revenue</th>
                <th colspan="2">Action</th>
                </tr>

                <!-- Fetch rows from Stores -->
                <?php while($row = sqlsrv_fetch_array($stmt_6, SQLSRV_FETCH_ASSOC)): ?>
                    <tr>
                        <td><?php echo $row["Store_ID"] ?></td>
                        <td><?php echo $row["Store_Name"] ?></td>
                        <td><?php echo $row["Category"] ?></td>
                        <td><?php echo $row["Department_ID"] ?></td>
                        <td><?php echo $row["Hours_Of_Operation"] ?></td>
                        <td><?php echo $row["Num_Customers"] ?></td>
                        <td><?php echo $row["Product_ID"] ?></td>
                        <td>$<?php echo number_format($row["Weekly_Revenue"], 2) ?></td>

                        <td>
                            <form action="#edit-popup" method="post">
                                <input name="store-edit-ID-1" type="number" value="<?php echo $row['Store_ID'] ?>" hidden>
                                
                                <button name='store-edit-1' id='store-edit-1' type='submit' class="button button-edit">Edit</button>
                            </form>
                        </td>
                        <td>
                            <form action="" method="post">
                                <input name="store-delete-ID" type="number" value="<?php echo $row['Store_ID'] ?>" hidden>
                                
                                <button name='store-delete' id='store-delete' type='submit' class="button button-delete">Delete</button>
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
                <h2>Edit Store</h2>
                <a class="close" href="#">&times;</a>
                <div class="content content-form">
                    <form action="" method="post">
                        <!-- Hidden input to get Store ID -->
                        <input name="store-edit-ID-2" type="number" value="<?php echo $data['Store_ID'] ?>"  hidden>

                        <label class="required-input-label">Category</label><br>
                        <select name="Store-category" class="dropdown-control" required>
                            <!-- Default option -->
                            <option value="<?php echo isset($data['Category']) ? $data['Category'] : '' ?>" hidden>
                                <?php echo isset($data['Category']) ? $data['Category'] : 'Select an Option' ?>
                            </option>

                            <option value="Gift Shop">Gift Shop</option>
                            <option value="Restaurant">Restaurant</option>
                            <option value="Ticket Booth">Ticket Booth</option>
                        </select><br>

                        <label class="required-input-label">Store Name</label><br>
                        <input name="Store-storeName" type="text" class="form-control" required
                        value="<?php echo isset($data['Store_Name']) ? $data['Store_Name'] : '' ?>">
                        <br>

                        <label class="required-input-label">Hours Of Operation ( HH:MM[AM/PM]-HH:MM[AM/PM] )</label><br>
                        <input name="Store-hours" type="text" class="form-control" required
                        value="<?php echo isset($data['Hours_Of_Operation']) ? $data['Hours_Of_Operation'] : '' ?>">
                        <br>

                        <label class="input-label">Number of Customers</label><br>
                        <input name="Store-numCustomers" type="text" class="form-control" placeholder="0"
                        value="<?php echo isset($data['Num_Customers']) ? $data['Num_Customers'] : '' ?>">
                        <br>

                        <label class="input-label">Weekly Revenue</label><br>
                        <input name="Store-weeklyRevenue" type="number" min="0" class="form-control" placeholder="0"
                        value="<?php echo isset($data['Weekly_Revenue']) ? $data['Weekly_Revenue'] : '' ?>">
                        <br>

                        <label class="required-input-label">Product ID</label><br>
                        <input name="Store-productID" type="number" min="1" class="form-control" required
                        value="<?php echo isset($data['Product_ID']) ? $data['Product_ID'] : '' ?>">
                        <br>

                        <label class="required-input-label">Department ID</label><br>
                        <input name="Store-departmentID" type="number" min="1" class="form-control" required
                        value="<?php echo isset($data['Department_ID']) ? $data['Department_ID'] : '' ?>">
                        <br>

                        <button name="store-edit-2" type="submit" class="form-submit">Submit</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- ==================================================================================================== -->
        <!-- ==================================================================================================== -->

        <!-- Insert form -->
        <div id="insert-popup" class="overlay">
            <div class="popup popup-form">
                <h2>Insert Store</h2>
                <a class="close" href="#">&times;</a>
                <div class="content content-form">
                    <form action="" method="post">
                        <label class="required-input-label">Category</label><br>
                        <select name="Store-category" class="dropdown-control" required>
                            <!-- Default option -->
                            <option value="<?php echo isset($_POST['Store-category']) ? $_POST['Store-category'] : '' ?>" hidden>
                                <?php echo isset($_POST['Store-category']) ? $_POST['Store-category'] : 'Select an Option' ?>
                            </option>

                            <option value="Gift Shop">Gift Shop</option>
                            <option value="Restaurant">Restaurant</option>
                            <option value="Ticket Booth">Ticket Booth</option>
                        </select><br>

                        <label class="required-input-label">Store Name</label><br>
                        <input name="Store-storeName" type="text" class="form-control" required
                        value="<?php echo isset($_POST['Store-storeName']) ? $_POST['Store-storeName'] : '' ?>">
                        <br>

                        <label class="required-input-label">Hours Of Operation ( HH:MM[AM/PM]-HH:MM[AM/PM] )</label><br>
                        <input name="Store-hours" type="text" class="form-control" required
                        value="<?php echo isset($_POST['Store-hours']) ? $_POST['Store-hours'] : '' ?>">
                        <br>

                        <label class="input-label">Number of Customers</label><br>
                        <input name="Store-numCustomers" type="text" class="form-control" placeholder="0"
                        value="<?php echo isset($_POST['Store-numCustomers']) ? $_POST['Store-numCustomers'] : '' ?>">
                        <br>

                        <label class="input-label">Weekly Revenue</label><br>
                        <input name="Store-weeklyRevenue" type="number" min="0" class="form-control" placeholder="0"
                        value="<?php echo isset($_POST['Store-weeklyRevenue']) ? $_POST['Store-weeklyRevenue'] : '' ?>">
                        <br>

                        <label class="required-input-label">Product ID</label><br>
                        <input name="Store-productID" type="number" min="1" class="form-control" required
                        value="<?php echo isset($_POST['Store-productID']) ? $_POST['Store-productID'] : '' ?>">
                        <br>

                        <label class="required-input-label">Department ID</label><br>
                        <input name="Store-departmentID" type="number" min="1" class="form-control" required
                        value="<?php echo isset($_POST['Store-departmentID']) ? $_POST['Store-departmentID'] : '' ?>">
                        <br>

                        <button name="store-insert-2" type="submit" class="form-submit">Submit</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</body>
</html>