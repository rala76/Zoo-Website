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
            
        <label class="required-input-label">Maintenance Fees</label><br>
            <input name="enclosure-maintenanceFees" type="number" min="1" step="0.1" class="form-control" required
            value="<?php echo isset($_POST['enclosure-maintenanceFees']) ? $_POST['enclosure-maintenanceFees'] : '' ?>">
            <br>

            <label class="required-input-label">Number of Animals</label><br>
            <input name="enclosure-numAnimals" type="number" min="0" class="form-control" placeholder="0" required
            value="<?php echo isset($_POST['enclosure-numAnimals']) ? $_POST['enclosure-numAnimals'] : '' ?>">
            <br>

            <label class="required-input-label">Department ID</label><br>
            <input name="enclosure-departmentID" type="number" min="1" class="form-control" required
            value="<?php echo isset($_POST['enclosure-departmentID']) ? $_POST['enclosure-departmentID'] : '' ?>">
            <br>
            
            <button name="enclosure-submit" type="submit" class="form-submit">Submit</button>
        </form>
    
        <?php
        // Connect to Microsoft Azure SQL Database
        include(__DIR__."/../../connect-sql.php");

        // Get data from Enclosure form once submit button is pressed
        if(isset($_POST["enclosure-submit"])) {
            $maintenanceFees = $_POST["enclosure-maintenanceFees"];
            $numAnimals = !empty($_POST["enclosure-numAnimals"]) ? $_POST["enclosure-numAnimals"] : "0";
            $departmentID = $_POST["enclosure-departmentID"];

            // Create insert statement
            $sql = "INSERT INTO [dbo].[Enclosure_Data] 
                ([Maintenance_Fees]
                ,[Num_Animals]
                ,[Department_ID])
                VALUES 
                (?, ?, ?)";
            
            // Parameters of insert statement
            $params = array($maintenanceFees
                ,$numAnimals
                ,$departmentID);
            
            $message = "Successfully Inserted New Enclosure";

            $stmt = sqlsrv_query($conn, $sql, $params);
            if ($stmt == false) {
                $message = "Failed to Insert New Enclosure";
            }

            echo "<h2>$message</h2>";
        }
        ?>
    </div>
</body>
</html>
