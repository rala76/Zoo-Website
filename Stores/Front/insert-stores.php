<!doctype html>
<html>
<head>
    <!-- Include default Store page -->
    <?php include(__DIR__."/../Stores.php"); ?>

    <title>Insert New Store</title>
</head>
<body>
    <div class="form-base">
        <!-- Insert form for Store -->
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
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

            <button name="Store-submit" type="submit" class="form-submit">Submit</button>
        </form>
    
        <?php
        // Connect to Microsoft Azure SQL Database
        include(__DIR__."/../../connect-sql.php");

        // Get data from Store form once submit button is pressed
        if(isset($_POST["Store-submit"])) {
            $category = $_POST["Store-category"];
            $storeName = $_POST["Store-storeName"];
            $hours = $_POST["Store-hours"];
            $numCustomers = !empty($_POST["Store-numCustomers"]) ? $_POST["Store-numCustomers"] : "0";
            $weeklyRevenue = !empty($_POST["Store-weeklyRevenue"]) ? $_POST["Store-weeklyRevenue"] : "0";
            $productID = !empty($_POST["Store-productID"]) ? $_POST["Store-productID"] : NULL;
            $departmentID =  $_POST["Store-departmentID"];

            // Create insert statement
            $sql = "INSERT INTO [dbo].[Stores] 
                ([Category]
                ,[Store_Name]
                ,[Hours_Of_Operation]
                ,[Num_Customers]
                ,[Weekly_Revenue]
                ,[Product_ID]
                ,[Department_ID])
                VALUES 
                (?, ?, ?, ?, ?, ?, ?)";
            
            // Parameters of insert statement
            $params = array($category
                ,$storeName
                ,$hours
                ,$numCustomers
                ,$weeklyRevenue
                ,$productID
                ,$departmentID);
            
            $message = "Successfully Inserted New Store";

            $stmt = sqlsrv_query($conn, $sql, $params);
            if ($stmt == false) {
                $message = "Failed to Insert New Store";
            }
            
            echo "<h2>$message</h2>";
        }
        ?>
    </div>
</body>
</html>
