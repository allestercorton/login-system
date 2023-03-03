<?php

    // database
    include '../db.php';

    // session
    if (!empty($_SESSION['admin-id'])) {
        header('Location: ../admin/index.php');
    }

    // admin login
    if (isset($_POST['admin-login'])) {
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);

        if ($username == '' || $password == '') {
            echo "<script>alert('Please fill all fields!');</script>";
        } else {
            $result = mysqli_query($conn, "SELECT * FROM admin;");
            $row = mysqli_fetch_assoc($result);
            if (mysqli_num_rows($result) > 0) {
                if ($username == $row['username']) {
                    if ($password == $row['password']) {
                        $_SESSION['login'] = true;
                        $_SESSION['admin-id'] = $row['id'];
                        header('Location: ../admin/index.php');
                    } else {
                        echo "<script>alert('Incorrect Password!');</script>";
                    }
                } else {
                    echo "<script>alert('Incorrect Admin Credentials!');</script>";
                }
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
    <title>Admin</title>
    <link rel="stylesheet" href="../css/admin-login.css">
</head>
<body>
    
    <div class="container">
        <div class="title">Admin Login</div>

        <form action="" method="POST">
            <input type="text" name="username" placeholder="Username"> <br>
            <input type="password" name="password" id="password" placeholder="Password"> <br>
            <div class="show-password">
                <input type="checkbox" id="checkbox" onclick="showPassword()">
                <label for="checkbox" id="checkbox" class="show-pass">Show Password</label>
            </div>
            <input type="submit" name="admin-login" value="Login">
        </form>
    </div>

    <script src="../script/index.js"></script>
</body>
</html>