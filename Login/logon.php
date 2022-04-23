
<!doctype html>
<html>
	
<head>
    <link rel="stylesheet" href="loginStyles.css">
    <title>Login to Zoo Database</title>
</head>
	
<div class="header">
	<a href="https://zoo-project.azurewebsites.net/Login/logon.php">

	</a>
</div>
	
<body>
	<h1 class="zoo">Uma Zoo</h1>
    <div class="login">
        <h1>Login</h1>
        <form action="authenticate.php" method="post">
            <label for="Username"></label>
            <input type="text" name="Username" placeholder="Username" id="Username" required>
            <label for="Password"></label>
            <input type="Password" name="Password" placeholder="Password" id="Password" required>
            <input type="submit" value="Submit">
        </form>
    </div>
        <div class="login">
        <h1>
            <a href="/Login/registration.php">Create account</a>
        </h1>
    </div>
</body>
</html>
