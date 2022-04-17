<!doctype html>
<html>
<head>
    <!-- Include default Enclosure page -->
    <?php include(__DIR__."/../Enclosure.php"); ?>

    <title>Insert New Enclosure</title>
</head>
<body>
    <div class="form-base">
        <!-- Insert form for Enclosure_Data -->
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            
        <label class="required-input-label">Maintanence Fees</label><br>
            <input name="enclosure-maintanenceFees" type="number" min="1" step="0.1" class="form-control" required
            value="<?php echo isset($_POST['enclosure-maintanenceFees']) ? $_POST['enclosure-maintanenceFees'] : '' ?>">
            <br>

            <label class="required-input-label">Number of Animals</label><br>
            <input name="enclosure-numAnimals" type="number" min="0" class="form-control" placeholder="0" required
            value="<?php echo isset($_POST['enclosure-numAnimals']) ? $_POST['enclosure-numAnimals'] : '' ?>">
            <br>
            
            <button name="enclosure-submit" type="submit" class="form-submit">Submit</button>
        </form>
    
        <?php
        // Connect to Microsoft Azure SQL Database
        include(__DIR__."/../../connect-sql.php");

        // Get data from Enclosure form once submit button is pressed
        if(isset($_POST["enclosure-submit"])) {
            $maintanenceFees = $_POST["enclosure-maintanenceFees"];
            $numAnimals = !empty($_POST["enclosure-numAnimals"]) ? $_POST["enclosure-numAnimals"] : "0";

            // Create insert statement
            $sql = "INSERT INTO [dbo].[Enclosure_Data] 
                ([Maintanence_Fees]
                ,[Num_Animals])
                VALUES 
                (?, ?)";
            
            // Parameters of insert statement
            $params = array($maintanenceFees
                ,$numAnimals);
            
            // Status and error message to output on web page
            $message = "Successfully Inserted New Enclosure";
            $error_msg = NULL;

            $stmt = sqlsrv_query($conn, $sql, $params);
            if ($stmt == false) {
                //die(print_r(sqlsrv_errors(), true));
                $message = "Failed to Insert New Enclosure";
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
