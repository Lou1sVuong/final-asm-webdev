<?php
include "class.database.php";

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit();
}
global $conn;


$page = isset($_GET['page']) ? $_GET['page'] : 1;
$limit = 6;
$start = ($page - 1) * $limit;

$query = "SELECT * FROM products LIMIT $start, $limit";
$result = mysqli_query($conn, $query);

$total_pages_query = "SELECT COUNT(*) as total FROM products";
$total_result = mysqli_query($conn, $total_pages_query);
$total_rows = mysqli_fetch_assoc($total_result)['total'];
$total_pages = ceil($total_rows / $limit);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css?v=<?php echo time(); ?>">
</head>


<body>
    <section>
        <div class="main-banner"></div>
    </section>
    <!-- nav -->
    <section>
        <div class="nav">
            <div>
                <a href="#">Trang Chủ</a>
                <a href="#">Giới Thiệu</a>
                <a href="#">Dịch Vụ</a>
                <a href="#">Sản Phẩm</a>
                <a href="#">Liên Hệ</a>
            </div>


            <div class="login-nav">
                <p>Xin Chào: <?= $_SESSION['username'] ?></p>
                <a href="logout.php">Đăng Xuất</a>
            </div>


        </div>
    </section>
    <!-- mainlayout -->
    <section>
        <div class="main-layout">
            <div class="aside">
                <h1 class="title">Danh Mục Sản Phẩm</h1>
                <ul class="aside-list">
                    <li>
                        <a href="">Laptop</a>
                        <ul>
                            <li><a href="">Laptop Acer</a></li>
                            <li><a href="">Laptop Asus</a></li>
                            <li><a href="">Laptop Dell</a></li>
                            <li><a href="">Laptop Lenovo</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="">Điện Thoại</a>
                        <ul>
                            <li><a href="">Samsung</a></li>
                            <li><a href="">iPhone</a></li>
                            <li><a href="">Xiaomi</a></li>
                            <li><a href="">Asus</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="">Laptop</a>
                        <ul>
                            <li><a href="">Laptop Acer</a></li>
                            <li><a href="">Laptop Asus</a></li>
                            <li><a href="">Laptop Dell</a></li>
                            <li><a href="">Laptop Lenovo</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="content">
                <div class="sub-banner"></div>
                <div class="container">
                    <h1 class="title-product">sản phẩm nổi bật</h1>
                    <div class="listProduct">
                        <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                        <div class="product-card">
                        <img src="<?= $row['img'] ?> " alt="<?= $row['productName'] ?>">
                            <h3 class="wrap-text" ><?= $row['productName'] ?></h3>
                            <div class="stars">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                            <p><?= $row['price'] ?></p>
                            <a href="#" class="btn">Mua hàng</a>
                        </div>
                        <?php endwhile; ?>
                    </div>
                    <div class="pagination-container">
                        <div class="pagination">
                            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                                <a href="?page=<?php echo $i; ?>">
                                    <?php echo $i; ?>
                                </a>
                            <?php endfor; ?>
                        </div>
                    </div>

                </div>
            </div>
    </section>
    <!-- footer -->
    <section>
        <div class="footer">
            <div class="nav-footer">
                <a href="#">Liên Hệ</a>
                <a href="#">Sản Phẩm</a>
                <a href="#">Dịch Vụ</a>
                <a href="#">Giới Thiệu</a>
                <a href="#">Trang Chủ</a>
            </div>
            <div class="text-footer">
                <p align="center">2023 LTW XuanVuong VinhKhang</p>
            </div>
        </div>
    </section>
</body>

</html>