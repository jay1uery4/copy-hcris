<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
    <link rel="stylesheet" type="text/css" href="../Css/styles.css">
</head>
<body>
    <div class="login-container">
        <form action="login.php" method="post">
            <h2>Login </h2>
            <?php if (isset($_GET['error'])) { ?>
                <p class="error"><?php echo $_GET['error']; ?></p>
            <?php } ?>
            <div class="input-box">
                <label>Username</label>
                <input type="text" name="uname" placeholder="Username">
            </div>
            <div class="input-box">
                <label>Password</label>
                <input type="password" name="password" placeholder="Password">
            </div>
            <button type="submit" class="login-btn">Login</button>
            <a href="adminsignup.php" class="ca">Create an account</a>
        </form>
    </div>
</body>
</html>