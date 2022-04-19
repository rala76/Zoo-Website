<!doctype html>
<html>
<head>
    <!-- Include default Customer page -->
    <?php include(__DIR__."/../Customer.php"); ?>

    <title>Search Customers</title>
</head>
<body>
    <div class="form-base">
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <!-- Dropdown list for Sort By -->
            <label class="required-input-label">Sort By:</label><br>
            <select name="customer-sortBy" class="dropdown-control" required>
                <!-- Default option -->
                <option value="<?php echo isset($_POST['customer-sortBy']) ? $_POST['customer-sortBy'] : '' ?>" hidden>
                    <?php echo isset($_POST['customer-sortBy']) ? $_POST['customer-sortBy'] : 'Select an Option' ?>
                </option>
                
                <option value="Customer ID">Customer ID</option>
                <option value="First Name">First Name</option>
                <option value="Last Name">Last Name</option>
                <option value="Age">Age</option>
            </select><br>

            <!-- Dropdown list for Order By -->
            <label class="required-input-label">Order By:</label><br>
            <select name="customer-orderBy" class="dropdown-control" required>
                <!-- Default option -->
                <option value="<?php echo isset($_POST['customer-orderBy']) ? $_POST['customer-orderBy'] : '' ?>" hidden>
                    <?php echo isset($_POST['customer-orderBy']) ? $_POST['customer-orderBy'] : 'Select an Option' ?>
                </option>

                <option value="Ascending">Ascending</option>
                <option value="Descending">Descending</option>
            </select><br>

            <button name="customer-search-submit" type="submit" class="form-submit">Submit</button>
        </form>

        <?php
        // Connect to Microsoft Azure SQL Database
        include(__DIR__."/../../connect-sql.php");

        // Select query based on Sort/Order by
        if (isset($_POST["customer-search-submit"])) {
            // Get Sort By value based on input
            if ($_POST["customer-sortBy"] == "Customer ID") {
                $Sort_By = "Customer_ID";
            }
            else if ($_POST["customer-sortBy"] == "First Name"){
                $Sort_By = "Fname";
            }
            else if ($_POST["customer-sortBy"] == "Last Name") {
                $Sort_By = "Lname";
            }
            else {
                $Sort_By = "Age";
            }

            // Create select query based on
            if ($_POST["customer-orderBy"] == "Ascending") {
                $sql = "SELECT [Customer_ID], [Fname], [Lname], [Age]
                    FROM [dbo].[Customer_Data]
                    ORDER BY '$Sort_By' ASC ";
            }
            else {
                $sql = "SELECT [Customer_ID], [Fname], [Lname], [Age]
                    FROM [dbo].[Customer_Data]
                    ORDER BY '$Sort_By' DESC ";
            }

            $stmt = sqlsrv_query($conn, $sql);

            // Break row
            echo "<div class='break-row'></div>";

            // Display customer as table
            echo "<div>";
            echo "<label class='form-control'></label><br>";
            echo "<table>";
                echo "<tr>";
                    echo "<th>Customer ID</th>";
                    echo "<th>First Name</th>";
                    echo "<th>Last Name</th>";
                    echo "<th>Age</th>";
                echo "</tr>";

                // Fetch rows from customer_Data
                while($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                    echo "<tr>";
                    echo "<td>" . $row["Customer_ID"] . "</td>";
                    echo "<td>" . $row["Fname"] . "</td>";
                    echo "<td>" . $row["Lname"] . "</td>";
                    echo "<td>" . $row["Age"] . "</td>";
                    echo "</tr>";
                }
            echo "</table>";
            echo "</div>";
        }
        ?>
    </div>
</body>
</html>
