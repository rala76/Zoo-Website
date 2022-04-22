<!doctype html>
<html>
<head>
    <!-- Include default Product page -->
    <?php include(__DIR__."/../Product.php"); ?>

    <title>Insert New Product</title>
</head>
<body>
    <div class="form-base">
        <!-- Insert form for Product_Information -->
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <label class="required-input-label">Category</label><br>
            <select name="product-category" class="dropdown-control" required>
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

            <button name="Product-submit" type="submit" class="form-submit">Submit</button>
        </form>
    
        <?php
        // Connect to Microsoft Azure SQL Database
        include(__DIR__."/../../connect-sql.php");

        // Get data from Product form once submit button is pressed
        if(isset($_POST["Product-submit"])) {
            $category = $_POST["product-category"];
            $purchaseDate = $_POST["Product-purchaseDate"];
            $name = $_POST["Product-name"];
            $inventoryAmount = !empty($_POST["Product-inventory"]) ? $_POST["Product-inventory"] : "0";
            $amountSold = !empty($_POST["Product-amountSold"]) ? $_POST["Product-amountSold"] : "0";
            $price = $_POST["Product-price"];

            // Create insert statement
            $sql = "INSERT INTO [dbo].[Product_Information] 
                ([Category]
                ,[Purchase_Date]
                ,[Product_Name]
                ,[Inventory_Amount]
                ,[Amount_Sold]
                ,[Price])
                VALUES 
                (?, ?, ?, ?, ?, ?)";
            
            // Parameters of insert statement
            $params = array($category
                ,$purchaseDate
                ,$name
                ,$inventoryAmount
                ,$amountSold
                ,$price);
            
            $message = "Successfully Inserted New Product";

            $stmt = sqlsrv_query($conn, $sql, $params);
            if ($stmt == false) {
                $message = "Failed to Insert New Product";
            }
            
            echo "<h2>$message</h2>";
        }
        ?>
    </div>
</body>
</html>
