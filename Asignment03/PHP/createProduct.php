<?php
include "class.database.php";
if (!$_SESSION['login']) {
    header("Location:login.php");
}
if ($_SESSION['login'] && $_SESSION['login'] != 'admin') {
    header("Location:index.php");
}
global $conn;
$result = mysqli_query($conn, "SELECT * FROM products");
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
                    <h1>Create new Product</h1>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="name" id="name" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Image ( Image Address )</label>
                        <input type="text" class="form-control" name="image" id="phone" required>
                    </div>
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="text" class="form-control" name="price" id="price" required>
                    </div>
                    <div class="form-group">
                        <label for="role">Category</label>
                        <select class="form-control" name="category" id="category">
                            <option value="Laptop">Laptop</option>
                            <option value="Phone">Phone</option>
                        </select>
                    </div>
                    <?php


                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        $name = $_POST['name'];
                        $image = $_POST['image'];
                        $price = $_POST['price'];
                        $category = $_POST['category'];

                        $query = "SELECT * FROM products WHERE productName = '$name'";
                        $result = mysqli_query($conn, $query);

                        if (!$result) {
                            echo "Lỗi: " . mysqli_error($conn);
                        } else {
                            if ($result->num_rows > 0) {
                                echo '<p style="color:red">Tên sản phẩm này đã tồn tại</p>';
                            } else {
                                $sql = "INSERT INTO products(productName, img, price, category) VALUES ('$name', '$image', '$price', '$category')";
                                $result_insert = mysqli_query($conn, $sql);

                                if ($result_insert) {
                                    header('Location: products.php');
                                    exit(); // Đảm bảo kết thúc việc thực thi mã sau khi chuyển hướng
                                } else {
                                    echo '<p style="color:red">Thêm sản phẩm thất bại</p>';
                                }
                            }
                        }
                    }
                    ?>


                    <button type="submit" class="btn btn-success">Create</button>
                    <a href="products.php" class="btn btn-cancel">Cancel</a>

                </form>

        </section>
    </div>
</body>

</html>