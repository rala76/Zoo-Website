<!doctype html>
<html>
<head>
    <link rel="stylesheet" href="/Styles/loginStyles.css">
    <link rel="stylesheet" href="/Styles/styles.css">
    <title>Login to Zoo Database</title>
</head>
<body>
    <div class="login-header">
        <img src="/Login/Images/login-logo.png" alt="logo">
    </div>
    <h1 class="title">Zoo</h1>

    <div class="login">
        <h1>Login</h1>
        <form action="authenticate.php" method="post">
            <label for="Username"></label>
            <input type="text" name="Username" placeholder="Username" id="Username" required>
            <label for="Password"></label>
            <input type="Password" name="Password" placeholder="Password" id="Password" required>
            <input type="submit" value="Login">
        </form>
    </div>
    <div class="login" style="margin-top: 5%">
        <h1>
            <a href="/Login/registration.php">Create account</a>
        </h1>
    </div>
</body>
</html>