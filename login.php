<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - Books</title>
    <style>
        body { background: #f7f8fa; font-family: Arial, sans-serif; }
        .login-container { max-width: 350px; margin: 80px auto; background: #fff; border-radius: 8px; box-shadow: 0 2px 18px #0001; padding: 32px; }
        h2 { text-align: center; color: #444; }
        input[type="text"], input[type="password"] {
            width: 100%; padding: 10px; margin: 12px 0; border-radius: 4px; border: 1px solid #ddd;
        }
        button { width: 100%; background: #617dc2; color: #fff; border: none; padding: 12px; border-radius: 4px; font-size: 1em; }
        .register-link { display: block; text-align: center; margin-top: 18px; color: #617dc2; }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <form method="POST" action="login_process.php">
            <input type="text" name="username" placeholder="Username or Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
        <a class="register-link" href="register.php">Don't have an account? Register</a>
    </div>
</body>
</html>