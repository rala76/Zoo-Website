<!doctype html>
<html>
<head>
    <!-- Include default Product page -->
    <?php include(__DIR__."/../Product.php"); ?>

    <title>Delete Product</title>
</head>
<body>
    <div class="form-base">
        <!-- Delete by ID from Product_Information -->
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <label class="input-label">Delete by ID:</label>
            <details <?php echo isset($_POST['product-delete-1']) ? 'open' : 'close' ?>>
            <summary>ID</summary>
                <label class="required-input-label">ID</label><br>
                <input name="product-id-1" type="number" min="1" class="details-control" required
                value="<?php echo isset($_POST['product-id-1']) ? $_POST['product-id-1'] : '' ?>">
                <br>

                <button name="product-delete-1" type="submit" class="form-submit">Submit</button>
            </details>
        </form>

        <?php
        // Connect to Microsoft Azure SQL Database
        include(__DIR__."/../../connect-sql.php");

        // Delete statement based on delete option
        if (isset($_POST["product-delete-1"])) {
            $ID = $_POST["product-id-1"];

            // Info of product to be deleted
            $sql_1 = "SELECT [Product_ID], [Product_Name], [Category]
                , [Purchase_Date], [Inventory_Amount], [Amount_Sold], [Price]
                FROM [dbo].[Product_Information] 
                WHERE [Product_ID]='$ID'";

            // Create delete statement (ID)
            $sql_2 = "DELETE FROM [dbo].[Product_Information] 
                WHERE [Product_ID]='$ID'";
        }

        if (isset($_POST["product-delete-1"])) {
            // Status and error message to output on web page
            $message = "Successfully Deleted Product";
            $error_msg = NULL;

            $stmt_1 = sqlsrv_query($conn, $sql_1); // Info of product to be deleted
            $stmt_2 = sqlsrv_query($conn, $sql_2); // Delete product
            if ($stmt_2 == false) {
                $message = "Failed to Delete Product";
                $error_msg = sqlsrv_errors();
            }
            else if (sqlsrv_rows_affected($stmt_2) <= 0) {
                $message = "Product not found";
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

            // Break row
            echo "<div class='break-row'></div>";

            // Display Product as table
            echo "<div>";
            echo "<label class='form-control'>Product Deleted:</label><br>";
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

                // Fetch row from Product_Information
                while($row = sqlsrv_fetch_array($stmt_1, SQLSRV_FETCH_ASSOC)) {
                    echo "<tr>";
                    echo "<td>" . $row["Product_ID"] . "</td>";
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
