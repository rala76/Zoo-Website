<!doctype html>
<html>
<head>
    <!-- Include default Product page -->
    <?php include(__DIR__."/../Product.php"); ?>

    <title>Search Products</title>
</head>
<body>
    <div class="form-base">
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <!-- Dropdown list for Sort By -->
            <label class="required-input-label">Sort By:</label><br>
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

            <!-- Dropdown list for Order By -->
            <label class="required-input-label">Order By:</label><br>
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

        <?php
        // Connect to Microsoft Azure SQL Database
        include(__DIR__."/../../connect-sql.php");

        // Select query based on Sort/Order by
        if (isset($_POST["product-search-submit"])) {
            // Get Sort By value based on input
            if ($_POST["product-sortBy"] == "Product ID") {
                $Sort_By = "Product_ID";
            }
            else if ($_POST["product-sortBy"] == "Product Name") {
                $Sort_By = "Product_Name";
            }
            else if ($_POST["product-sortBy"] == "Category") {
                $Sort_By = "Category";
            }
            else if ($_POST["product-sortBy"] == "Purchase Date") {
                $Sort_By = "Purchase_Date";
            }
            else if ($_POST["product-sortBy"] == "Inventory Amount") {
                $Sort_By = "Inventory_Amount";
            }
            else if ($_POST["product-sortBy"] == "Amount Sold") {
                $Sort_By = "Amount_Sold";
            }
            else {
                $Sort_By = "Price";
            }
            

            // Create select query based on
            if ($_POST["product-orderBy"] == "Ascending") {
                $sql = "SELECT [Product_ID], [Product_Name], [Category], [Purchase_Date]
                    , [Inventory_Amount], [Amount_Sold], [Price]
                    FROM [dbo].[Product_Information] 
                    ORDER BY '$Sort_By' ASC ";
            }
            else {
                $sql = "SELECT [Product_ID], [Product_Name], [Category], [Purchase_Date]
                    , [Inventory_Amount], [Amount_Sold], [Price]
                    FROM [dbo].[Product_Information] 
                    ORDER BY '$Sort_By' DESC ";
            }

            $stmt = sqlsrv_query($conn, $sql);

            // Break row
            echo "<div class='break-row'></div>";

            // Display Product as table
            echo "<div>";
            echo "<label class='form-control'></label><br>";
            echo "<table>";
                echo "<tr>";
                    echo "<th>Product ID</th>";
                    echo "<th>Product Name</th>";
                    echo "<th>Category</th>";
                    echo "<th>Purchase Date</th>";
                    echo "<th>Inventory Amount</th>";
                    echo "<th>Amount Sold</th>";
                    echo "<th>Price</th>";
                echo "</tr>";

                // Fetch rows from Employee_Data
                while($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                    echo "<tr>";
                    echo "<td>" . $row["Product_ID"] . "</td>";
                    echo "<td>" . $row["Product_Name"] . "</td>";
                    echo "<td>" . $row["Category"] . "</td>";
                    echo "<td>" . $row["Purchase_Date"]->format('Y-m-d') . "</td>";
                    echo "<td>" . $row["Inventory_Amount"] . "</td>";
                    echo "<td>" . $row["Amount_Sold"] . "</td>";
                    echo "<td>$" . number_format($row["Price"], 2) . "</td>";
                    echo "</tr>";
                }
            echo "</table>";
            echo "</div>";
        }
        ?>
    </div>
</body>
</html>
