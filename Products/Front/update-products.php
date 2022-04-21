<!doctype html>
<html>
<head>
    <!-- Include default Product page -->
    <?php include(__DIR__."/../Product.php"); ?>

    <title>Update Product</title>
</head>
<body>
    <div class="form-base">
        <?php
        // Connect to Microsoft Azure SQL Database
        include(__DIR__."/../../connect-sql.php");

        // Declare
        $row = NULL;

        // Select Product by ID & Fetch Product Data to display
        if(isset($_POST["product-update-1"])) {
            $ID = $_POST["product-id"];

            // Info of product to be updated
            $sql_1 = "SELECT *
                FROM [dbo].[Product_Information] 
                WHERE [Product_ID]='$ID'";
            
            $message = "Product Found";
            
            $stmt_1 = sqlsrv_query($conn, $sql_1);
            if ($stmt_1 == false) {
                $message = "Failed to Find Product";
            }
            else if (sqlsrv_has_rows($stmt_1) <= 0) {
                $message = "Product Not Found";
            }

            echo "<h2>$message</h2>";

            echo "<div class='break-row'></div>";

            // Fetch row from Product_Information
            $row = sqlsrv_fetch_array($stmt_1, SQLSRV_FETCH_ASSOC);    
        }

        // Update Product Information
        if (isset($_POST["product-update-2"])) {
            $Category = $_POST["product-category"];
            $Purchase_Date = $_POST["product-purchase-date"];
            $Name = $_POST["product-name"];
            $Inventory_Amount = $_POST["product-inventory-amount"];
            $Amount_Sold = $_POST["product-amount-sold"];
            $Price = $_POST["product-price"];

            // Create update statement
            $ID = $_POST["product-id"];

            $sql_2 = "UPDATE [dbo].[Product_Information] 
                SET [Category] = '$Category'
                ,[Purchase_Date] = '$Purchase_Date'
                ,[Product_Name] = '$Name'
                ,[Inventory_Amount] = '$Inventory_Amount'
                ,[Amount_Sold] = '$Amount_Sold'
                ,[Price] = '$Price'
                WHERE [Product_ID]='$ID'";
                
            $message = "Successfully Updated Product";

            $stmt_2 = sqlsrv_query($conn, $sql_2);
            if ($stmt_2 == false || sqlsrv_rows_affected($stmt_2) <= 0) {
                $message = "Failed to Update Product";
            }

            echo "<h2>$message</h2>";

            echo "<div class='break-row'></div>";

            // Info of updated product
            $sql_1 = "SELECT *
                FROM [dbo].[Product_Information] 
                WHERE [Product_ID]='$ID'";
            
            $stmt_1 = sqlsrv_query($conn, $sql_1);

            // Fetch updated product from Product_Information
            $row = sqlsrv_fetch_array($stmt_1, SQLSRV_FETCH_ASSOC);
        }
        ?>

        <!-- Update form for Product_Information -->
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <p style="font-size:large"><b>Product to Update:</b></p>

            <label class="required-input-label">Product ID:</label>
            <input name="product-id" type="number" min="1" class="form-control"
            value="<?php echo isset($_POST['product-id']) ? $_POST['product-id'] : '' ?>">
            <br>

            <button name="product-update-1" type="submit" class="form-submit">Submit</button>

            <!-- ============================================================================== -->

            <p style="font-size:large"><b>Update Fields:</b></p>

            <label class="required-input-label">Category</label><br>
            <select name="product-category" class="dropdown-control">
                <!-- Default option -->
                <option value="<?php echo isset($row['Category']) ? $row['Category'] : '' ?>" hidden>
                    <?php echo isset($row['Category']) ? $row['Category'] : 'Select an Option' ?>
                </option>

                <option value="Food">Food</option>
                <option value="Ticket">Ticket</option>
                <option value="Souvenir">Souvenir</option>
            </select><br>

            <label class="required-input-label">Purchase Date (YYYY-MM-DD)</label><br>
            <input name="product-purchase-date" type="text" class="form-control"
            value="<?php echo isset($row['Purchase_Date']) ? $row['Purchase_Date']->format('Y-m-d') : '' ?>">
            <br>

            <label class="required-input-label">Product Name</label><br>
            <input name="product-name" type="text" class="form-control"
            value="<?php echo isset($row['Product_Name']) ? $row['Product_Name'] : '' ?>">
            <br>

            <label class="required-input-label">Inventory Amount</label><br>
            <input name="product-inventory-amount" type="number" min="0" class="form-control" placeholder="0"
            value="<?php echo isset($row['Inventory_Amount']) ? $row['Inventory_Amount'] : '' ?>">
            <br>

            <label class="required-input-label">Amount Sold</label><br>
            <input name="product-amount-sold" type="number" min="0" class="form-control" placeholder="0"
            value="<?php echo isset($row['Amount_Sold']) ? $row['Amount_Sold'] : '' ?>">
            <br>

            <label class="required-input-label">Price</label><br>
            <input name="product-price" type="number" min="1" step="0.1" class="form-control"
            value="<?php echo isset($row['Price']) ? $row['Price'] : '' ?>">
            <br>

            <button name="product-update-2" type="submit" class="form-submit">Submit</button>
        </form>
    </div>
</body>
</html>
