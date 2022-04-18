<!doctype html>
<html>
<head>
    <link rel="stylesheet" href="/loginStyles.css">
    <link rel="stylesheet" href="/styles.css">
    <title>Login to Zoo Database</title>
</head>
<body>
    <div class="login">
        <h1>Login to Zoo Database</h1>
        <form action="authenticate.php" method="post">
            <label for="Username"></label>
            <input type="text" name="Username" placeholder="Username" id="Username" required>
            <label for="Password"></label>
            <input type="Password" name="Password" placeholder="Password" id="Password" required>
            <input type="submit" value="Login">
        </form>
    </div>
</body>
</html>