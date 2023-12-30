<?php
include "class.database.php";
if (!$_SESSION['login']) {
  header("Location:login.php");
}
if ($_SESSION['login'] && $_SESSION['login'] != 'admin') {
  header("Location:index.php");
}
global $conn;

$page = isset($_GET['page']) ? $_GET['page'] : 1;
$limit = 3;
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

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <link rel="stylesheet" href="../css/adminpage.css?v=<?php echo time(); ?>">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <title>Customers - Danh sách khách hàng </title>



</head>

<body>

  <div class='container'>
    <aside>
      <img
        src="https://static.vecteezy.com/system/resources/previews/004/819/327/non_2x/male-avatar-profile-icon-of-smiling-caucasian-man-vector.jpg"
        alt="" class="avt">
      <h2 class="hello">Xin Chào:
        <?= $_SESSION['username'] ?>
      </h2>
      <a href="users.php" class="ationNav">
        <span>Management Users</span>
        <i class="fas fa-users"></i>
      </a>
      <a href="" class="ationNav">
        <span>Management Products</span>
        <i class="fas fa-box"></i>
      </a>

      <a class="logoutBtn" href="logout.php">Logout</a>
    </aside>

    <section class='mainField'>
      <h2>Management Products</h2>
      <input type="text" id="searchBar" name="search" placeholder="Search..." />
      <button type="submit" name="submit" class="addBtn"><i class="fas fa-search"></i></button> <!-- Nút tìm kiếm -->
      <div class="addObjects">
        <span>Products Information</span>
        <a href="createProduct.php" class="addBtn">Add Product</a>
      </div>

      <table class='table'>
        <thead>
          <tr>
            <th>ProductID</th>
            <th>Image</th>
            <th>Name</th>
            <th>Price</th>
            <th>Category</th>
            <th>Operations</th>
          </tr>
        </thead>
        <tbody>

          <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <tr class="userProduct">
              <td>
                <?= $row['id'] ?>
              </td>
              <td><img src="<?= $row['img'] ?> " alt=""></td>
              <td class="wrap-text">
                <?= $row['productName'] ?>
              </td>
              <td>
                <?= $row['price'] ?>
              </td>
              <td>
                <?= $row['category'] ?>
              </td>
              <td>
                <a href="editProduct.php?id=<?php echo $row['id']; ?>" class="ationBtn editBtn"><span>Edit </span><i
                    class="fas fa-edit"></i></a>
                <a href="#" onclick="confirmDelete('<?php echo $row['id']; ?>','<?php echo $row['productName']; ?>')"
                  class="ationBtn delBtn">
                  <span>Delete </span><i class="fas fa-trash-alt"></i>
                </a>
              </td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
      <div class="pagination-container">
        <div class="pagination">
          <?php for ($i = 1; $i <= $total_pages; $i++): ?>
            <a href="?page=<?php echo $i; ?>">
              <?php echo $i; ?>
            </a>
          <?php endfor; ?>
        </div>
      </div>

    </section>
  </div>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>

    function confirmDelete(id, name) {
      console.log('Delete function called with ID:', id);
      var confirmation = confirm('Are you sure you want to delete product has name : ' + name + '?' + ' and ID is' + id + '?');

      if (confirmation) {
        window.location.href = 'deleteProduct.php?id=' + id;
      }
    }

    // document.addEventListener('DOMContentLoaded', function() {
    //   document.getElementById('searchBar').addEventListener('input', function() {
    //     var searchValue = this.value.toLowerCase();
    //     var userDataRows = document.querySelectorAll('.userProduct');

    //     userDataRows.forEach(function(row) {
    //       var rowData = row.textContent.toLowerCase();
    //       if (rowData.indexOf(searchValue) === -1) {
    //         row.style.display = 'none';
    //       } else {
    //         row.style.display = 'table-row';
    //       }
    //     });
    //   });
    // });
    $(document).ready(function () {
      function performSearch() {
        var searchValue = $('#searchBar').val().trim(); // Lấy giá trị và loại bỏ khoảng trắng
        if (searchValue !== '') {
          $.ajax({
            url: 'searchProducts.php',
            method: 'POST',
            data: { search: searchValue },
            success: function (response) {
              $('.table tbody').html(response);
            }
          });
        } else {
          loadInitialData(); // Gọi hàm để load lại dữ liệu ban đầu và phân trang khi ô input trống
        }
      }

      $(document).ready(function() {
  function performSearch() {
    var searchValue = $('#searchBar').val().trim(); // Lấy giá trị và loại bỏ khoảng trắng
    if (searchValue !== '') {
      $.ajax({
        url: 'searchProducts.php',
        method: 'POST',
        data: { search: searchValue },
        success: function(response) {
          $('.table tbody').html(response);
        }
      });
    } else {
      window.location.href = 'products.php?page=1'; // Chuyển về trang products.php?page=1 khi ô input trống
    }
  }

  $('#searchBar').on('input', function() {
    performSearch();
  });

  // Focus vào ô input khi trở về trang products.php?page=1
  if (window.location.href.indexOf('products.php?page=1') > -1) {
    $('#searchBar').focus();
  }
});
    });
  </script>
</body>

</html>