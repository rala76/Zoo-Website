<!doctype html>
<html>
<head>
    <link rel="stylesheet" href="/Styles/loginStyles.css">
    <link rel="stylesheet" href="/Styles/styles.css">
    <title>Register for Zoo Account</title>
</head>
<body>
    <div class="login">
        <h1>Register for Zoo Acount</h1>
        <form action="register-authenticate.php" method="post">
            <label for="Username"></label>
            <input type="text" name="Username" placeholder="Username" id="Username" required>
            <label for="Password"></label>
            <input type="Password" name="Password" placeholder="Password" id="Password" required>
            <label for="Email"></label>
            <input type="Email" name="Email" placeholder="Email" id="Email" required>
            <input type="submit" value="Register Account">
        </form>
    </div>
    <div class="login">
        <h1>
            <a href="/Login/logon.php">Already have an account?</a>
        </h1>
    </div>
</body>
</html>