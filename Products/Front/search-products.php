<?php
// Include default Product page
include(__DIR__."/../Product.php");

// Include process code for forms & tables
include(__DIR__."/process-products.php");
?>

<!doctype html>
<html>
<head>
    <title>Search Products</title>
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
            <select name="product-sortBy" class="dropdown-control" required>
                <!-- Default option -->
                <option value="<?php echo isset($_POST['product-sortBy']) ? $_POST['product-sortBy'] : '' ?>" hidden>
                    <?php echo isset($_POST['product-sortBy']) ? $_POST['product-sortBy'] : 'Select an Option' ?>
                </option>

                <option value="Product ID">Product ID</option>
                <option value="Product Name">Product Name</option>
                <option value="Category">Category</option>
                <option value="Purchase Date">Purchase Date</option>
                <option value="Inventory Amount">Inventory Amount</option>
                <option value="Amount Sold">Amount Sold</option>
                <option value="Price">Price</option>
            </select><br>

            <label class="input-label">Product Category:</label><br>
            <select name="product-category" class="dropdown-control">
                <option value="<?php echo isset($_POST['product-category']) ? $_POST['product-category'] : '' ?>" hidden>
                    <?php echo isset($_POST['product-category']) ? $_POST['product-category'] : 'Select an Option' ?>
                </option>

                <option value="All">All</option>
                <option value="Food">Food</option>
                <option value="Ticket">Ticket</option>
                <option value="Souvenir">Souvenir</option>
            </select><br>

            <!-- Dropdown list for Order By -->
            <label class="input-label">Order By:</label><br>
            <select name="product-orderBy" class="dropdown-control" required>
                <!-- Default option -->
                <option value="<?php echo isset($_POST['product-orderBy']) ? $_POST['product-orderBy'] : '' ?>" hidden>
                    <?php echo isset($_POST['product-orderBy']) ? $_POST['product-orderBy'] : 'Select an Option' ?>
                </option>

                <option value="Ascending">Ascending</option>
                <option value="Descending">Descending</option>
            </select><br>

            <button name="product-search-submit" type="submit" class="form-submit">Submit</button>
        </form>

        <!-- ==================================================================================================== -->
        <!-- ==================================================================================================== -->

        <!-- Break row -->
        <div class='break-row'></div>
        <div class='break-row'></div>
        <div class='break-row'></div>
        <div class='break-row'></div>

        <!-- Insert Product -->
        <form action="#insert-popup" method="post" style="margin-bottom: -10%">
            <button name='product-insert-1' id='product-insert-1' type='submit' class="button button-insert">Insert Product</button>
        </form>

        <!-- Break row -->
        <div class='break-row'></div>

        <!-- ==================================================================================================== -->
        <!-- ==================================================================================================== -->

        <!-- Display Product as table -->
        <div>
        <label class='form-control'></label><br>
            <table class='styled-table'>
                <tr>
                <th>Product ID</th>
                <th>Product Name</th>
                <th>Category</th>
                <th>Purchase Date</th>
                <th>Inventory Amount</th>
                <th>Amount Sold</th>
                <th>Price</th>
                <th colspan="2">Action</th>
                </tr>

                <!-- Fetch rows from Product_Information -->
                <?php while($row = sqlsrv_fetch_array($stmt_6, SQLSRV_FETCH_ASSOC)): ?>
                    <tr>
                        <td><?php echo $row["Product_ID"] ?></td>
                        <td><?php echo $row["Product_Name"] ?></td>
                        <td><?php echo $row["Category"] ?></td>
                        <td><?php echo $row["Purchase_Date"]->format('Y-m-d') ?></td>
                        <td><?php echo $row["Inventory_Amount"] ?></td>
                        <td><?php echo $row["Amount_Sold"] ?></td>
                        <td>$<?php echo number_format($row["Price"], 2) ?></td>
                        <td>
                            <form action="#edit-popup" method="post">
                                <input name="product-edit-ID-1" type="number" value="<?php echo $row['Product_ID'] ?>" hidden>
                                
                                <button name='product-edit-1' id='product-edit-1' type='submit' class="button button-edit">Edit</button>
                            </form>
                        </td>
                        <td>
                            <form action="" method="post">
                                <input name="product-delete-ID" type="number" value="<?php echo $row['Product_ID'] ?>" hidden>
                                
                                <button name='product-delete' id='product-delete' type='submit' class="button button-delete">Delete</button>
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
                <h2>Edit Product</h2>
                <a class="close" href="#">&times;</a>
                <div class="content content-form">
                    <form action="" method="post">
                        <!-- Hidden input to get Product ID -->
                        <input name="product-edit-ID-2" type="number" value="<?php echo $data['Product_ID'] ?>"  hidden>

                        <label class="required-input-label">Category</label><br>
                        <select name="Product-category" class="dropdown-control" required>
                            <!-- Default option -->
                            <option value="<?php echo isset($data['Category']) ? $data['Category'] : '' ?>" hidden>
                                <?php echo isset($data['Category']) ? $data['Category'] : 'Select an Option' ?>
                            </option>

                            <option value="Food">Food</option>
                            <option value="Ticket">Ticket</option>
                            <option value="Souvenir">Souvenir</option>
                        </select><br>
                        
                        <label class="required-input-label">Purchase Date (YYYY-MM-DD)</label><br>
                        <input name="Product-purchaseDate" type="text" class="form-control" required
                        value="<?php echo isset($data['Purchase_Date']) ? $data['Purchase_Date']->format('Y-m-d') : '' ?>">
                        <br>

                        <label class="required-input-label">Product Name</label><br>
                        <input name="Product-name" type="text" class="form-control" required
                        value="<?php echo isset($data['Product_Name']) ? $data['Product_Name'] : '' ?>">
                        <br>

                        <label class="required-input-label">Inventory Amount</label><br>
                        <input name="Product-inventory" type="number" min="0" class="form-control" placeholder="0" required
                        value="<?php echo isset($data['Inventory_Amount']) ? $data['Inventory_Amount'] : '' ?>">
                        <br>

                        <label class="required-input-label">Amount Sold</label><br>
                        <input name="Product-amountSold" type="number" min="0" class="form-control" placeholder="0" required
                        value="<?php echo isset($data['Amount_Sold']) ? $data['Amount_Sold'] : '' ?>">
                        <br>

                        <label class="required-input-label">Price</label><br>
                        <input name="Product-price" type="number" min="1" step="0.1" class="form-control" required
                        value="<?php echo isset($data['Price']) ? $data['Price'] : '' ?>">
                        <br>

                        <button name="product-edit-2" type="submit" class="form-submit">Submit</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- ==================================================================================================== -->
        <!-- ==================================================================================================== -->

        <!-- Insert form -->
        <div id="insert-popup" class="overlay">
            <div class="popup popup-form">
                <h2>Insert Product</h2>
                <a class="close" href="#">&times;</a>
                <div class="content content-form">
                    <form action="" method="post">
                        <label class="required-input-label">Category</label><br>
                        <select name="Product-category" class="dropdown-control" required>
                            <!-- Default option -->
                            <option value="<?php echo isset($_POST['product-category']) ? $_POST['product-category'] : '' ?>" hidden>
                                <?php echo isset($_POST['product-category']) ? $_POST['product-category'] : 'Select an Option' ?>
                            </option>

                            <option value="Food">Food</option>
                            <option value="Ticket">Ticket</option>
                            <option value="Souvenir">Souvenir</option>
                        </select><br>
                        
                        <label class="required-input-label">Purchase Date (YYYY-MM-DD)</label><br>
                        <input name="Product-purchaseDate" type="text" class="form-control" required
                        value="<?php echo isset($_POST['Product-purchaseDate']) ? $_POST['Product-purchaseDate'] : '' ?>">
                        <br>

                        <label class="required-input-label">Product Name</label><br>
                        <input name="Product-name" type="text" class="form-control" required
                        value="<?php echo isset($_POST['Product-name']) ? $_POST['Product-name'] : '' ?>">
                        <br>

                        <label class="required-input-label">Inventory Amount</label><br>
                        <input name="Product-inventory" type="number" min="0" class="form-control" placeholder="0" required
                        value="<?php echo isset($_POST['Product-inventory']) ? $_POST['Product-inventory'] : '' ?>">
                        <br>

                        <label class="required-input-label">Amount Sold</label><br>
                        <input name="Product-amountSold" type="number" min="0" class="form-control" placeholder="0" required
                        value="<?php echo isset($_POST['Product-amountSold']) ? $_POST['Product-amountSold'] : '' ?>">
                        <br>

                        <label class="required-input-label">Price</label><br>
                        <input name="Product-price" type="number" min="1" step="0.1" class="form-control" required
                        value="<?php echo isset($_POST['Product-price']) ? $_POST['Product-price'] : '' ?>">
                        <br>

                        <button name="product-insert-2" type="submit" class="form-submit">Submit</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</body>
</html>
