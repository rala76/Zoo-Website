<!doctype html>
<html>
<head>
    <!-- Include default Store page -->
    <?php include(__DIR__."/../Stores.php"); ?>

    <title>Search Stores</title>
</head>
<body>
    <div class="form-base">
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <!-- Dropdown list for Sort By -->
            <label class="required-input-label">Sort By:</label><br>
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
            <label class="required-input-label">Order By:</label><br>
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

        <?php
        // Connect to Microsoft Azure SQL Database
        include(__DIR__."/../../connect-sql.php");

        // Select query based on Sort/Order by
        if (isset($_POST["store-search-submit"])) {
            // Get Sort By value based on input
            if ($_POST["store-sortBy"] == "Store ID") {
                $Sort_By = "Store_ID";
            }
            else if ($_POST["store-sortBy"] == "Store Name") {
                $Sort_By = "Store_Name";
            }
            else if ($_POST["store-sortBy"] == "Category") {
                $Sort_By = "Category";
            }
            else if ($_POST["store-sortBy"] == "Department ID") {
                $Sort_By = "Department_ID";
            }
            else if ($_POST["store-sortBy"] == "Hours Of Operation") {
                $Sort_By = "Hours_Of_Operation";
            }
            else if ($_POST["store-sortBy"] == "Number Of Customers") {
                $Sort_By = "Num_Customers";
            }
            else if ($_POST["store-sortBy"] == "Product ID") {
                $Sort_By = "Product_ID";
            }
            else {
                $Sort_By = "Weekly_Revenue";
            }
            

            // Create select query based on
            if ($_POST["store-orderBy"] == "Ascending") {
                $sql = "SELECT [Store_ID], [Store_Name], [Category], [Department_ID]
                    , [Hours_Of_Operation], [Num_Customers], [Product_ID], [Weekly_Revenue]
                    FROM [dbo].[Stores] 
                    ORDER BY '$Sort_By' ASC ";
            }
            else {
                $sql = "SELECT [Store_ID], [Store_Name], [Category], [Department_ID]
                    , [Hours_Of_Operation], [Num_Customers], [Product_ID], [Weekly_Revenue]
                    FROM [dbo].[Stores] 
                    ORDER BY '$Sort_By' DESC ";
            }

            $stmt = sqlsrv_query($conn, $sql);

            // Break row
            echo "<div class='break-row'></div>";

            // Display Store as table
            echo "<div>";
            echo "<label class='form-control'></label><br>";
            echo "<table>";
                echo "<tr>";
                    echo "<th>Store ID</th>";
                    echo "<th>Store Name</th>";
                    echo "<th>Category</th>";
                    echo "<th>Department ID</th>";
                    echo "<th>Hours Of Operation</th>";
                    echo "<th>Number Of Customers</th>";
                    echo "<th>Product ID</th>";
                    echo "<th>Weekly Revenue</th>";
                echo "</tr>";

                // Fetch rows from Employee_Data
                while($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                    echo "<tr>";
                    echo "<td>" . $row["Store_ID"] . "</td>";
                    echo "<td>" . $row["Store_Name"] . "</td>";
                    echo "<td>" . $row["Category"] . "</td>";
                    echo "<td>" . $row["Department_ID"] . "</td>";
                    echo "<td>" . $row["Hours_Of_Operation"] . "</td>";
                    echo "<td>" . $row["Num_Customers"] . "</td>";
                    echo "<td>" . $row["Product_ID"] . "</td>";
                    echo "<td>$" . number_format($row["Weekly_Revenue"], 2) . "</td>";
                    echo "</tr>";
                }
            echo "</table>";
            echo "</div>";
        }
        ?>
    </div>
</body>
</html>
