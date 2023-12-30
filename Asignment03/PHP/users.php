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
      <a href="" class="ationNav">
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
      <h2>Management Users</h2>
      <input type="text" id="searchBar" name="search" placeholder="Search..." />
      <button type="submit" name="submit" class="addBtn"><i class="fas fa-search"></i></button> <!-- Nút tìm kiếm -->
      <div class="addObjects">
        <span>Users Information</span>
        <a href="create.php" class="addBtn">Add User</a>
      </div>

      <table class='table'>
        <thead>
          <tr>
            <th>Name</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Password</th>
            <th>Role</th>
            <th>Operations</th>
          </tr>
        </thead>
        <tbody>

          <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <tr class="userData">
              <td>
                <?= $row['name'] ?>
              </td>
              <td>
                <?= $row['phone'] ?>
              </td>
              <td>
                <?= $row['email'] ?>
              </td>
              <td>
                <?= $row['password'] ?>
              </td>
              <td>
                <?= $row['role'] ?>
              </td>
              <td>
                <a href="edit.php?email=<?php echo $row['email']; ?>" class="ationBtn editBtn"><span>Edit </span><i
                    class="fas fa-edit"></i></a>
                <a href="#" onclick="confirmDelete('<?php echo $row['email']; ?>')" class="ationBtn delBtn">
                  <span>Delete </span><i class="fas fa-trash-alt"></i>
                </a>
              </td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </section>
  </div>

  <script>
    function confirmDelete(email) {
      var confirmation = confirm('Are you sure you want to delete ' + email + '?');

      if (confirmation) {
        window.location.href = 'delete.php?email=' + email;
      }
    }
    document.addEventListener('DOMContentLoaded', function() {
      document.getElementById('searchBar').addEventListener('input', function() {
        var searchValue = this.value.toLowerCase();
        var userDataRows = document.querySelectorAll('.userData');

        userDataRows.forEach(function(row) {
          var rowData = row.textContent.toLowerCase();
          if (rowData.indexOf(searchValue) === -1) {
            row.style.display = 'none';
          } else {
            row.style.display = 'table-row';
          }
        });
      });
    });
   

  </script>
</body>

</html>