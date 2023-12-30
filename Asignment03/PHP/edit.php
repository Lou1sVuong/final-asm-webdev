<?php
include "class.database.php";
if (!$_SESSION['login']) {
    header("Location:login.php");
}
if ($_SESSION['login'] && $_SESSION['login'] != 'admin') {
    header("Location:index.php");
}

if (isset($_GET['email'])) {
    $email = $_GET['email'];
    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $userData = mysqli_fetch_assoc($result);
        $name = $userData['name'];
        $phone = $userData['phone'];
        $email = $userData['email'];
        $password = $userData['password'];
        $role = $userData['role'];
    } else {
        // Xử lý khi không tìm thấy thông tin người dùng
    }
}
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
                    <h1>Edit User</h1>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="name" id="name" value="<?php echo isset($name) ? $name : ''; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="text" class="form-control" name="phone" id="phone" value="<?php echo isset($phone) ? $phone : ''; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" id="email" value="<?php echo isset($email) ? $email : ''; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="text" class="form-control" name="password" id="password" value="<?php echo isset($password) ? $password : ''; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="role">Role</label>
                        <select class="form-control" name="role" id="role">
                            <option value="user" <?php if (isset($role) && $role === 'user') echo 'selected'; ?>>User</option>
                            <option value="admin" <?php if (isset($role) && $role === 'admin') echo 'selected'; ?>>Admin</option>
                        </select>
                    </div>
                    <?php

                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        if (isset($_POST['name']) && isset($_POST['phone']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['role'])) {
                            // Lấy dữ liệu từ form
                            $newName = $_POST['name'];
                            $newPhone = $_POST['phone'];
                            $newEmail = $_POST['email'];
                            $newPassword = $_POST['password'];
                            $newRole = $_POST['role'];

                            $updateQuery = "UPDATE users SET name='$newName', phone='$newPhone', email='$newEmail', password='$newPassword', role='$newRole' WHERE email='$email'";
                            $updateResult = mysqli_query($conn, $updateQuery);

                            if ($updateResult) {
                                header("Location: users.php");
                                exit();
                            } else {
                                echo "Cập nhật không thành công. Vui lòng thử lại.";
                            }
                        } else {
                            echo "Vui lòng điền đầy đủ thông tin.";
                        }
                    }
                    ?>

                    <button href="" class="btn btn-success">Save Changes</button>
                    <a href="users.php" class="btn btn-cancel">Cancel</a>
                </form>
            </div>


        </section>
    </div>
</body>

</html>