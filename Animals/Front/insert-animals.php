<!doctype html>
<html>
<head>
    <!-- Include default Animal page -->
    <?php include(__DIR__."/../Animal.php"); ?>

    <title>Insert New Animal</title>
</head>
<body>
    <div class="form-base">
        <!-- Insert form for Animal_Data -->
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <label class="required-input-label">Animal Name</label><br>
            <input name="Animal-name" type="text" class="form-control" required
            value="<?php echo isset($_POST['Animal-name']) ? $_POST['Animal-name'] : '' ?>">
            <br>

            <label class="required-input-label">Species</label><br>
            <input name="Animal-species" type="text" class="form-control" required
            value="<?php echo isset($_POST['Animal-species']) ? $_POST['Animal-species'] : '' ?>">
            <br>

            <label class="required-input-label">Date of Birth (YYYY-MM-DD)</label><br>
            <input name="Animal-date-of-birth" type="text" class="form-control" required
            value="<?php echo isset($_POST['Animal-date-of-birth']) ? $_POST['Animal-date-of-birth'] : '' ?>">
            <br>

            <!-- Dropdown list for Gender -->
            <label class="required-input-label">Gender</label><br>
            <select name="Animal-gender" class="dropdown-control" required>
                <!-- Default option -->
                <option value="<?php echo isset($_POST['Animal-gender']) ? $_POST['Animal-gender'] : '' ?>" hidden>
                    <?php echo isset($_POST['Animal-gender']) ? $_POST['Animal-gender'] : 'Select an Option' ?>
                </option>

                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select><br>
            
            <label class="required-input-label">Enclosure ID</label><br>
            <input name="Animal-enclosure-id" type="number" min="1" class="form-control" required
            value="<?php echo isset($_POST['Animal-enclosure-id']) ? $_POST['Animal-enclosure-id'] : '' ?>">
            <br>

            <button name="Animal-submit" type="submit" class="form-submit">Submit</button>
        </form>
    
        <?php
        // Connect to Microsoft Azure SQL Database
        include(__DIR__."/../../connect-sql.php");

        // Get data from Animal form once submit button is pressed
        if(isset($_POST["Animal-submit"])) {
            $name = $_POST["Animal-name"];
            $species = $_POST["Animal-species"];
            $Date_Of_Birth = $_POST["Animal-date-of-birth"];
            $Gender = $_POST["Animal-gender"];
            $Enclosure_ID =  $_POST["Animal-enclosure-id"] ;
           

            // Create insert statement
            $sql = "INSERT INTO [dbo].[Animal_Data] 
                ([Animal_Name]
                ,[Species]
                ,[Date_Of_Birth]
                ,[Gender]
                ,[Enclosure_ID])
                VALUES 
                (?, ?, ?, ?, ?)";
            
            // Parameters of insert statement
            $params = array($name
                ,$species
                ,$Date_Of_Birth
                ,$Gender
                ,$Enclosure_ID);
            
            $message = "Successfully Inserted New Animal";

            $stmt = sqlsrv_query($conn, $sql, $params);
            if ($stmt == false) {
                $message = "Failed to Insert New Animal";
            }
            
            echo "<h2>$message</h2>";
        }
        ?>
    </div>
</body>
</html>
