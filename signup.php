<?php

    // database
    include './db.php';

    // session
    if (!empty($_SESSION['id'])) {
        header('Location: ./index.php');
    }

    // signup
    if (isset($_POST['signup'])) {
        $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
        $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);

        if ($firstname == '' || $lastname == '' || $username == '' || $email == '' || $password == '') {
            echo "<script>alert('Please fill all fields!');</script>";
        } else {
            $duplicate = mysqli_query($conn, "SELECT * FROM users WHERE username='$username' || email='$email';");
            $row = mysqli_fetch_assoc($duplicate);
            if (mysqli_num_rows($duplicate) > 0) {
                if ($username == $row['username']) {
                    echo "<script>alert('Username is already taken!');</script>";
                } else if ($email == $row['email']) {
                    echo "<script>alert('Email is already taken!');</script>";
                }
            } else {
                $signup = mysqli_query($conn, "INSERT INTO users VALUES (
                    null,
                    '$firstname',
                    '$lastname',
                    '$username',
                    '$email',
                    '$password',
                    null
                );");
                if ($signup > 0) {
                    echo "<script>alert('Signup successfully!');</script>";
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
    <title>Signup</title>
    <link rel="stylesheet" href="./css/login-signup.css">
</head>
<body>

    <div class="container">
        <div class="title">Signup</div>

        <form action="" method="POST">
            <input type="text" name="firstname" placeholder="First name" required> <br>
            <input type="text" name="lastname" placeholder="Last name" required> <br>
            <input type="text" name="username" placeholder="Username" required> <br>
            <input type="email" name="email" placeholder="Email" required> <br>
            <input type="password" name="password" placeholder="Password" required> <br>
            <input type="submit" name="signup" value="Signup">
        </form>

        <div class="signup-login">
            <p>Done signup? <a href="./login.php">Login</a></p>
        </div>
    </div>

</body>
</html>