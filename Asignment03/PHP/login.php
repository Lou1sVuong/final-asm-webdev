<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/login.css?v=<?php echo time(); ?>">

</head>

<body>
    <section>

        <div class="RegisterForm">

            <h1>Đăng Nhập</h1>
            <form class="user" action="login.php" method="post">
                <div class="User">
                    <p>Email hoặc Số Điện Thoại</p>
                    <input type="text" id="fullName" name="user_name" required>
                </div>
                <div class="Password">
                    <p>Mật Khẩu</p>
                    <input type="password" id="password" name="user_pass" required>
                </div>
                <?php
                include "class.database.php";
                global $conn;
                if ($_POST) {
                    $user_name = $_POST['user_name'];
                    $user_pass = $_POST['user_pass'];
                    $result = mysqli_query($conn, "SELECT * FROM users WHERE email='$user_name' AND password='$user_pass'");
                    $row = mysqli_fetch_assoc($result);

                    if ($row) {
                        $_SESSION['login'] = $row['role'];
                        $_SESSION['username'] = $row['name'];

                        if ($_SESSION['login'] === 'admin') {
                            // Nếu là admin, chuyển hướng đến customers.php
                            header("Location: users.php");
                            exit();
                        } else {
                            // Nếu không phải admin, chuyển hướng đến main.php
                            header("Location: main.php");
                            exit();
                        }
                    } else {
                        echo '<p style="color:red">Tên đăng nhập hoặc mật khẩu không đúng!</p>';
                    }
                }
                ?>
                <div className="checkbox">
                    <input type="checkbox" name id="remember-me" />
                    <label htmlFor="remember-me">Nhớ Mật Khẩu</label>
                </div>

                <div class="btn-resgiter">
                    <button type="submit">Đăng Ký</button>
                </div>

                <p>Chưa có tài khoản? <a href="register.php">Đăng Ký Ngay</a></p>

            </form>
        </div>
    </section>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>


</body>

</html>