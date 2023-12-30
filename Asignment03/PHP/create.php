<?php
include "class.database.php";
if (!$_SESSION['login']) {
    header("Location:login.php");
}
if ($_SESSION['login'] && $_SESSION['login'] != 'admin') {
    header("Location:index.php");
}
global $conn;
$result = mysqli_query($conn, "SELECT * FROM users");
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="stylesheet" href="../css/adminpage.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../css/createpage.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">



</head>

<body>

    <div class='container'>
        <aside>
            <img src="https://static.vecteezy.com/system/resources/previews/004/819/327/non_2x/male-avatar-profile-icon-of-smiling-caucasian-man-vector.jpg" alt="" class="avt">
            <h2 class="hello">Hello, Admin</h2>
            <a href="users.php" class="ationNav">
                <span>Management Users</span>
                <i class="fas fa-users"></i>
            </a>
            <a href="products.php" class="ationNav">
                <span>Management Products</span>
                <i class="fas fa-box"></i>
            </a>

            <a class="logoutBtn" href="logout.php">Logout</a>
        </aside>
        <section class='mainField'>
            <div class="container">
                <form method="post" class="my-form">
                    <h1>Create new User</h1>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="name" id="name" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="text" class="form-control" name="phone" id="phone" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" id="email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="text" class="form-control" name="password" id="password" required>
                    </div>
                    <div class="form-group">
                        <label for="role">Role</label>
                        <select class="form-control" name="role" id="role">
                            <option value="user">User</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                    <?php

                    $message = "Đăng ký thành công";

                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        $name = $_POST['name'];
                        $email = $_POST['email'];
                        $phone = $_POST['phone'];
                        $password = $_POST['password'];
                        $role = $_POST['role'];


                        $query = "SELECT * FROM users WHERE email = '$email'";
                        $result = mysqli_query($conn, $query);

                        if ($result->num_rows > 0) {
                            echo '<p style="color:red">Email này đã tồn tại</p>';
                        } else {
                            $sql = "INSERT INTO users(name, phone, email, password, role) VALUES ('$name', '$phone', '$email', '$password', '$role')";
                            $result_insert = mysqli_query($conn, $sql);

                            header('Location: users.php');
                        }
                    }
                    ?>


                    <button href="" class="btn btn-success">Create</button>
                    <a href="users.php" class="btn btn-cancel">Cancel</a>

                </form>

        </section>
    </div>

    <script>
        function confirmDelete(email) {
            var confirmation = confirm('Are you sure you want to delete ' + email + '?');

            if (confirmation) {
                window.location.href = 'delete.php?email=' + email;
            }
        }
    </script>
</body>

</html>