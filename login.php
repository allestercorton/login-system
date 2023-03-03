<?php

    // database
    include './db.php';

    // session
    if (!empty($_SESSION['id'])) {
        header('Location: ./index.php');
    }

    // login
    if (isset($_POST['login'])) {
        $username_email = mysqli_real_escape_string($conn, $_POST['username-email']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);

        if ($username_email == '' || $password == '') {
            echo "<script>alert('Please input all fields!');</script>";
        } else {
            $result = mysqli_query($conn, "SELECT * FROM users WHERE username='$username_email' || email='$username_email';");
            $row = mysqli_fetch_assoc($result);
            if (mysqli_num_rows($result) > 0) {
                if ($username_email == $row['username'] || $username_email == $row['email']) {
                    if ($password == $row['password']) {
                        $_SESSION['login'] = true;
                        $_SESSION['id'] = $row['id'];
                        header('Location: ./index.php');
                    } else {
                        echo "<script>alert('Incorrect password!');</script>";
                    }
                }
            } else {
                echo "<script>alert('User is not registered!');</script>";
            }
        }
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./css/login-signup.css">
</head>
<body>

    <div class="container">
        <div class="title">Login</div>

        <form action="" method="POST">
            <input type="text" name="username-email" placeholder="Username or email" required> <br>
            <input type="password" name="password" id="password" placeholder="Password" required> <br>
            <div class="show-password">
                <input type="checkbox" id="checkbox" onclick="showPassword()">
                <label for="checkbox" id="checkbox" class="show-pass">Show Password</label>
            </div>
            <input type="submit" name="login" value="Login">
        </form>

        <div class="signup-login">
            <p>Don't have account? <a href="./signup.php">Signup</a></p>
        </div>
    </div>

    <script src="./script/index.js"></script>
</body>
</html>