<?php
include "class.database.php";
if (!$_SESSION['login']) {
    header("Location:login.php");
}
if ($_SESSION['login'] && $_SESSION['login'] != 'admin') {
    header("Location:index.php");
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM products WHERE id = '$id'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $ProductData = mysqli_fetch_assoc($result);
        $name = $ProductData['productName'];
        $image = $ProductData['img'];
        $price = $ProductData['price'];
        $category = $ProductData['category'];
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
            <img src="https://static.vecteezy.com/system/resources/previews/004/819/327/non_2x/male-avatar-profile-icon-of-smiling-caucasian-man-vector.jpg"
                alt="" class="avt">
            <h2 class="hello">Hello, Admin</h2>
            <a href="products.php" class="ationNav">
                <span>Management products</span>
                <i class="fas fa-products"></i>
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
                    <h1>Edit Product</h1>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="productName" id="productName"
                            value="<?php echo isset($name) ? $name : ''; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="image">Image ( Image Address )</label>
                        <input type="text" class="form-control" name="img" id="img"
                            value="<?php echo isset($image) ? $image : ''; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="text" class="form-control" name="price" id="price"
                            value="<?php echo isset($price) ? $price : ''; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="category">Category</label>
                        <select class="form-control" name="category" id="category">
                            <option value="laptop" <?php if (isset($category) && $category === 'laptop')
                                echo 'selected'; ?>>laptop</option>
                            <option value="phone" <?php if (isset($category) && $category === 'phone')
                                echo 'selected'; ?>>phone</option>
                        </select>
                    </div>
                    <?php
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        if (isset($_POST['productName']) && isset($_POST['img']) && isset($_POST['price']) && isset($_POST['category'])) {
                            $newName = $_POST['productName'];
                            $newImage = $_POST['img'];
                            $newPrice = $_POST['price'];
                            $newCategory = $_POST['category'];

                            $updateQuery = "UPDATE products SET productName='$newName', img='$newImage', price='$newPrice', category='$newCategory' WHERE id='$id'";
                            $updateResult = mysqli_query($conn, $updateQuery);

                            if ($updateResult) {
                                header("Location: products.php");
                                exit();
                            } else {
                                echo '<p style="color:red">Cập nhật không thành công. Vui lòng thử lại.</p>';
                            }
                        } else {
                            echo "Vui lòng điền đầy đủ thông tin.";
                        }
                    }
                    ?>

                    <button href="" class="btn btn-success">Save Changes</button>
                    <a href="products.php" class="btn btn-cancel">Cancel</a>
                </form>
            </div>


        </section>
    </div>
</body>

</html>