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


            <label class="input-label">Animal ID</label><br>
            <input name="Animal-animal-id" type="number" min="1" class="form-control" 
            value="<?php echo isset($_POST['Animal-animal-id']) ? $_POST['Animal-animal-id'] : '' ?>">
            <br>

            
            <label class="input-label">Enclosure ID</label><br>
            <input name="Animal-enclosure-id" type="number" min="1" class="form-control" 
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
            $Animal_ID = $_POST["Animal-animal-id"] ;
            $Enclosure_ID =  $_POST["Animal-enclosure-id"] ;
           

            // Create insert statement
            $sql = "INSERT INTO [dbo].[Animal_Data] 
                ([name]
                ,[species]
                ,[Date_Of_Birth]
                ,[Gender]
                ,[Animal_ID]
                ,[Enclosure_ID])
                VALUES 
                (?, ?, ?, ?, ?, ?)";
            
            // Parameters of insert statement
            $params = array($name
                ,$species
                ,$Date_Of_Birth
                ,$Gender
                ,$Animal_ID
                ,$Enclosure_ID);
            
            // Status and error message to output on web page
            $message = "Successfully Inserted New Animal";
            $error_msg = NULL;

            $stmt = sqlsrv_query($conn, $sql, $params);
            if ($stmt == false) {
                //die(print_r(sqlsrv_errors(), true));
                $message = "Failed to Insert New Animal";
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
