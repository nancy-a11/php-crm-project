<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = $_POST['username'];
    $pass = hash("sha256", $_POST['password']);
    $res = $conn->query("SELECT * FROM users WHERE username='$user' AND password='$pass'");
    if ($res->num_rows === 1) {
        $_SESSION['user'] = $user;
        header("Location: index.php");
        exit();
    } else {
        $error = "Invalid credentials!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            margin: 0;
            display: flex;
            height: 100vh;
        }

        .background {
            width: 60%;
            height: 100vh;
            background: url('assets/images/BackgroundforLoginPage.png') no-repeat center center;
            background-size: cover;
        }

        .login-container {
            width: 40%;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: rgba(223, 225, 231, 0.95);
            box-shadow: -5px 0px 15px rgba(0, 0, 0, 0.2);
        }

        .login-box {
            width: 80%;
            padding: 30px;
            text-align: center;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
            background:rgb(7, 45, 140); ;
            border-radius: 10px;
        }

        h2 {
            color: #007BFF;
            font-weight: bold;
        }

        .form-control {
            margin-bottom: 15px;
            border-radius: 5px;
            padding: 10px;
            font-size: 16px;
        }

        .btn {
            background: #007BFF;
            border: none;
            font-size: 18px;
            font-weight: bold;
            padding: 10px;
            border-radius: 5px;
        }

        .btn:hover {
            background: #0056b3;
        }

        .error {
            color: red;
            font-weight: bold;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="background"></div>
    
    <div class="login-container">
        <div class="login-box">
            <h2>Login</h2>
            <form method="post">
                <input class="form-control" name="username" placeholder="Username" required>
                <input class="form-control" name="password" type="password" placeholder="Password" required>
                <button class="btn btn-primary w-100" type="submit">Login</button>
            </form>
            <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
        </div>
    </div>
</body>
</html>
