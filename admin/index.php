<?php

    // database
    include '../db.php';

    // session
    if (empty($_SESSION['admin-id'])) {
        header('Location: ../admin/login.php');
    }

    // database results
    $results = mysqli_query($conn, "SELECT * FROM users;");

    // delete
    if (isset($_POST['delete'])) {
        $delete_id = $_POST['delete-id'];

        $delete = mysqli_query($conn, "DELETE FROM users WHERE id='$delete_id';");
        if ($delete > 0) {
            echo "<script>alert('User Deleted Successfully!');</script>";
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
    <title>Admin dashboard</title>
    <link rel="stylesheet" href="../css/admin-dashboard.css">
    <style>
        table, th, td {
            border: 1px solid #333;
            border-collapse: collapse;
        }

        th, td {
            padding: 0.4rem 1rem;
        }
    </style>
</head>
<body>

    <header>
        <div class="title">
            <a href="#">Admin Dashboard</a>
        </div>

        <div class="logout">
            <a href="../admin/logout.php">logout</a>
        </div>
    </header>

    <section>
        <div class="dashboard">
            <div class="text">User login records</div>

            <table>
                <tr>
                    <th>ID</th>
                    <th>FULLNAME</th>
                    <th>EMAIL</th>
                    <th>USERNAME</th>
                    <th>PASSWORD</th>
                    <th>DATE SIGNUP</th>
                    <th>ACTIONS</th>
                </tr>
                <?php while ($result = mysqli_fetch_assoc($results)) { ?>
                <tr>
                    <td><?php echo $result['id']; ?></td>
                    <td><?php echo $result['firstname'] . ' ' . $result['lastname']; ?></td>
                    <td><?php echo $result['email']; ?></td>
                    <td><?php echo $result['username']; ?></td>
                    <td><?php echo $result['password']; ?></td>
                    <td><?php echo $result['date']; ?></td>
                    <td>
                        <div class="action-btn">
                            <form action="../admin/update.php" method="POST">
                                <input type="submit" name="edit" class="edit" value="Edit">
                                <input type="hidden" name="edit-id" value="<?php echo $result['id']; ?>">
                            </form>

                            <form action="" method="POST">
                                <input type="submit" name="delete" class="delete" value="Delete">
                                <input type="hidden" name="delete-id" value="<?php echo $result['id']; ?>">
                            </form>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            </table>
        </div>
    </section>


</body>
</html>