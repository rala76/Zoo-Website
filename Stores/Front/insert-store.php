<!doctype html>
<html>
<head>
    <!-- Include default Store page -->
    <?php include(__DIR__."/../Stores.php"); ?>

    <title>Insert New Store</title>
</head>
<body>
    <div class="form-base">
        <!-- Insert form for Store_Data -->
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

            <label class="required-input-label">Hours Of Operation</label><br>
            <input name="Store-hours" type="text" class="form-control" required
            value="<?php echo isset($_POST['Store-hours']) ? $_POST['Store-hours'] : '' ?>">
            <br>

            <label class="input-label">Number of Customers</label><br>
            <input name="Store-numCustomers" type="text" class="form-control" required
            value="<?php echo isset($_POST['Store-numCustomers']) ? $_POST['Store-numCustomers'] : '' ?>">
            <br>

             <label class="input-label">Weekly Revenue</label><br>
            <input name="Store-weeklyRevenue" type="number" min="1" class="form-control" 
            value="<?php echo isset($_POST['Store-weeklyRevenue']) ? $_POST['Store-weeklyRevenue'] : '' ?>">
            <br>

            <label class="required-input-label">Product ID</label><br>
            <input name="Store-productID" type="number" min="1" class="form-control" 
            value="<?php echo isset($_POST['Store-productID']) ? $_POST['Store-productID'] : '' ?>">
            <br>

            <label class="required-input-label">Store ID</label><br>
            <input name="Store-Store-id" type="number" min="1" class="form-control" 
            value="<?php echo isset($_POST['Store-Store-id']) ? $_POST['Store-Store-id'] : '' ?>">
            <br>

            <label class="required-input-label">Employee ID</label><br>
            <input name="Store-employeeID" type="number" min="1" class="form-control" 
            value="<?php echo isset($_POST['Store-employeeID']) ? $_POST['Store-employeeID'] : '' ?>">
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
            $numCustomers = !empty($_POST["Store-numCustomers"]) ? $_POST["Store-numCustomers"] : "0";;
            $weeklyRevenue = !empty($_POST["Store-weeklyRevenue"]) ? $_POST["Store-weeklyRevenue"] : "0";;
            $productID = $_POST["Store-productID"];
            $Store_ID = $_POST["Store-Store-id"] ;
            $employeeID =  $_POST["Store-employeeID"] ;
           

            // Create insert statement
            $sql = "INSERT INTO [dbo].[Stores] 
                ([Category]
                ,[Store_Name]
                ,[Hours_Of_Operation]
                ,[Num_Customers]
                ,[Weekly_Revenue]
                ,[Product_ID]
                ,[Store_ID]
                ,[Employee_ID])
                VALUES 
                (?, ?, ?, ?, ?, ?, ?, ?)";
            
            // Parameters of insert statement
            $params = array($category
                ,$storeName
                ,$hours
                ,$numCustomers
                ,$weeklyRevenue
                ,$productID
                ,$Store_ID
                ,$employeeID);
            
            // Status and error message to output on web page
            $message = "Successfully Inserted New Store";
            $error_msg = NULL;

            $stmt = sqlsrv_query($conn, $sql, $params);
            if ($stmt == false) {
                //die(print_r(sqlsrv_errors(), true));
                $message = "Failed to Insert New Store";
                $error_msg = sqlsrv_errors();
            }
            
            // Output status and error message
            echo "<div>";
            echo "<h2>$message</h2>";
            echo "<details>";
            echo "<summary>Toggle Errors</summary>";
                if ($error_msg != NULL) {
                    foreach ( $error_msg as $error ) {
                        echo "<b>SQLSTATE: </b>".$error["SQLSTATE"]."<br>";
                        echo "<b>Code: </b> ".$error['code']."<br>";
                        echo "<b>Message: </b>".$error['message']."<br>";
                        echo "<br>";
                    }
                }
            echo "</details>";
            echo "</div>";
        }
        ?>
    </div>
</body>
</html>
