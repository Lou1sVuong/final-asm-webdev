<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/register.css?v=<?php echo time(); ?>">

</head>

<body>
    <section>
        <div class="RegisterForm">
            <h1>Đăng Ký Thành Viên</h1>
            <form method="post" action="register.php">
                <div class="FullName">
                    <p>Họ và Tên</p>
                    <input type="text" id="fullName" name="name" required>
                </div>
                <div class="Email">
                    <p>Email</p>
                    <input type="text" id="email" name="email" required>
                    <?php
                    include "class.database.php";

                    $message = "Đăng ký thành công";

                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        // Xử lý thêm dữ liệu vào cơ sở dữ liệu
                        $name = $_POST['name'];
                        $email = $_POST['email'];
                        $phone = $_POST['phone'];
                        $password = $_POST['pass'];
                        // $cfpassword = $_POST['cfpass'];

                        // Checking if email exists
                        $query = "SELECT * FROM users WHERE email = '$email'";
                        $result = mysqli_query($conn, $query);

                        if ($result->num_rows > 0) {
                            // Email đã tồn tại
                            echo '<p style="color:red">Email này đã tồn tại</p>';
                        } else {
                            // Inserting user data if email is not found
                            $sql = "INSERT INTO users(name, phone, email, password) VALUES ('$name', '$phone', '$email', '$password')";
                            $result_insert = mysqli_query($conn, $sql);

                            if ($result_insert) {
                                echo "<script>alert('$message'); window.location.href = 'login.php';</script>";
                            } else {
                                $message = "Thêm thất bại: " . mysqli_error($conn);
                                echo "<script>alert('$message');</script>";
                            }
                        }
                    }


                    ?>
                </div>
                <div class="Phone">
                    <p>Số Điện Thoại</p>
                    <input type="text" id="phone" name="phone" required>
                </div>
                <div class="Password">
                    <p>Mật Khẩu</p>
                    <input type="password" id="password" name="pass" required>
                </div>
                <!-- <div class="ConfirmPassword">
                    <p>Xác Nhận Mật Khẩu</p>
                    <input type="password" id="confirmPassword" name="cfpass" required>
                </div> -->

                <div class="btn-resgiter">
                  
                    <button type="submit" name="submit">Đăng Ký</button>
                </div>
                <p>Đã Có Tài Khoản?<a href="login.php"> Đăng Nhập</a></p>
            </form>
        </div>
    </section>


</body>

</html>