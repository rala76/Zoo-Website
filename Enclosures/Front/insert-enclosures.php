<!doctype html>
<html>
<head>
    <!-- Include default employee page -->
    <?php include(__DIR__."/../enclosure.php"); ?>

    <title>Insert New Enclosure</title>
</head>
<body>
    <div class="form-base">
        <!-- Insert form for Employee_Data -->
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            
        <label class="required-input-label">Maintanence Fees</label><br>
            <input name="enclosure-maintanenceFees" type="number" class="form-control" required
            value="<?php echo isset($_POST['enclosure-maintanenceFees']) ? $_POST['enclosure-maintanenceFees'] : '' ?>">
            <br>

            <label class="required-input-label">Number of Animals</label><br>
            <input name="enclosure-numAnimals" type="number" class="form-control" required
            value="<?php echo isset($_POST['enclosure-numAnimals']) ? $_POST['enclosure-numAnimals'] : '' ?>">
            <br>

            <label class="required-input-label">Enclosure ID</label><br>
            <input name="enclosure-enclosureID" type="number" class="form-control" required
            value="<?php echo isset($_POST['enclosure-enclosureID']) ? $_POST['enclosure-enclosureID'] : '' ?>">
            <br>

            
            <button name="enclosure-submit" type="submit" class="form-submit">Submit</button>
        </form>
    
        <?php
        // Connect to Microsoft Azure SQL Database
        include(__DIR__."/../../connect-sql.php");

        // Get data from employee form once submit button is pressed
        if(isset($_POST["enclosure-submit"])) {
            $maintanenceFees = $_POST["enclosure-maintanenceFees"];
            $numAnimals = !empty($_POST["enclosure-numAnimals"]) ? $_POST["enclosure-numAnimals"] : "0";
            $enclosureID = $_POST["enclosure-enclosureID"];

            // Create insert statement
            $sql = "INSERT INTO [dbo].[Enclosure_Data] 
                ([maintanenceFees]
                ,[numAnimals]
                ,[enclosureID])
                VALUES 
                (?, ?, ?)";
            
            // Parameters of insert statement
            $params = array($maintanenceFees
                ,$numAnimals
                ,$enclosureID
                );
            
            // Status and error message to output on web page
            $message = "Successfully Inserted New Employee";
            $error_msg = NULL;

            $stmt = sqlsrv_query($conn, $sql, $params);
            if ($stmt == false) {
                //die(print_r(sqlsrv_errors(), true));
                $message = "Failed to Insert New Employee";
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
