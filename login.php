<?php
session_start();

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST["username"];
    $password = $_POST["password"];

    // Sample login credentials
    $correctUsername = "admin";
    $correctPassword = "admin123";

    if ($username === $correctUsername && $password === $correctPassword) {

        $_SESSION["username"] = $username;

        header("Location: ?page=dashboard");
        exit();

    } else {
        $message = "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f2f2f2;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-box {
            width: 350px;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.2);
        }

        h2 {
            text-align: center;
            margin-bottom: 25px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input[type="submit"] {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 5px;
            background: #333;
            color: white;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background: #555;
        }

        .error {
            color: red;
            text-align: center;
            margin-bottom: 15px;
        }

        .dashboard {
            text-align: center;
        }

        .logout {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background: #333;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
</head>

<body>

<?php if (isset($_SESSION["username"])): ?>

    <div class="login-box dashboard">
        <h2>Dashboard</h2>

        <p>Welcome, <?php echo htmlspecialchars($_SESSION["username"]); ?>!</p>

        <a class="logout" href="?logout=true">Logout</a>
    </div>

<?php else: ?>

    <div class="login-box">

        <h2>Login</h2>

        <?php if ($message != ""): ?>
            <div class="error">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="">

            <label for="username">Username</label>
            <input
                type="text"
                id="username"
                name="username"
                placeholder="Enter username"
                required
            >

            <label for="password">Password</label>
            <input
                type="password"
                id="password"
                name="password"
                placeholder="Enter password"
                required
            >

            <input type="submit" value="Login">

        </form>

    </div>

<?php endif; ?>

</body>
</html>

<?php

if (isset($_GET["logout"])) {
    session_destroy();
    header("Location: " . $_SERVER["PHP_SELF"]);
    exit();
}

?>