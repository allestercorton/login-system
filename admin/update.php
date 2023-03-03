<?php

    // database
    include '../db.php';

    // edit button
    if (isset($_POST['edit'])) {
        $edit_id = $_POST['edit-id'];
        $results = mysqli_query($conn, "SELECT * FROM users where id='$edit_id';");
        $row = mysqli_fetch_assoc($results);
    } 
    
    // update button
    if (isset($_POST['update'])) {
        $update_id = mysqli_real_escape_string($conn, $_POST['update-id']);
        $update_firstname = mysqli_real_escape_string($conn, $_POST['update-firstname']);
        $update_lastname = mysqli_real_escape_string($conn, $_POST['update-lastname']);
        $update_username = mysqli_real_escape_string($conn, $_POST['update-username']);
        $update_email = mysqli_real_escape_string($conn, $_POST['update-email']);
        $update_password = mysqli_real_escape_string($conn, $_POST['update-password']);

        $update = mysqli_query($conn, "UPDATE users SET 
        firstname='$update_firstname',
        lastname='$update_lastname',
        username='$update_username',
        email='$update_email',
        password='$update_password' 
        WHERE id='$update_id';");

        if ($update > 0) {
            echo "<script>alert('User Updated Successfully!');</script>";
            echo "<script>window.location.href='../admin/index.php';</script>";
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update</title>
    <link rel="stylesheet" href="../css/admin-update.css">
</head>
<body>

    <div class="container">
        <div class="title">Update User</div>

        <form action="" method="POST">
            <div>
                <label for="firstname">Firstname</label>
                <input type="text" name="update-firstname" id="firstname" value="<?php echo $row['firstname']; ?>">
            </div>

            <div>
                <label for="lastname">Lastname</label>
                <input type="text" name="update-lastname" id="lastname" value="<?php echo $row['lastname']; ?>">
            </div>

            <div>
                <label for="username">Username</label>
                <input type="text" name="update-username" id="username" value="<?php echo $row['username']; ?>">
            </div>

            <div>
                <label for="email">Email</label>
                <input type="email" name="update-email" id="email" value="<?php echo $row['email']; ?>">
            </div>
            
            <div>
                <label for="password">Password</label>
                <input type="text" name="update-password" id="password" value="<?php echo $row['password']; ?>">
            </div>

            <div>
                <input type="submit" name="update" value="Update">
                <input type="hidden" name="update-id" value="<?php echo $row['id']; ?>">
            </div>
        </form>
    </div>

</body>
</html>