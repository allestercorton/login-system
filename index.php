<?php

    // database
    include './db.php';

    // session
    if (empty($_SESSION['id'])) {
        header('Location: ./login.php');
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page</title>
    <link rel="stylesheet" href="./css/landing-page.css">
</head>
<body>

    <header>
        <div class="title">
            <a href="#">Corton's Website</a>
        </div>

        <div class="logout">
            <a href="./logout.php">logout</a>
        </div>
    </header>

    <section>
        <div class="welcome">Hello, Welcome to the Landing Page!</div>
    </section>

    <footer>
        <p>2023 @Copyright Allester Corton's website. You can contact us at cortonallester@gmail.com.</p>
    </footer>
</body>
</html>