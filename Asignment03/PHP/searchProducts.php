<?php
include "class.database.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['search'])) {
  $searchValue = $_POST['search'];
  $query = "SELECT * FROM products WHERE productName LIKE '%$searchValue%' OR price LIKE '%$searchValue%' OR category LIKE '%$searchValue%'";
  $result = mysqli_query($conn, $query);

  if ($result) {
    if (mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr class='userProduct'>
                <td>{$row['id']}</td>
                <td><img src='{$row['img']}' alt=''></td>
                <td class='wrap-text'>{$row['productName']}</td>
                <td>{$row['price']}</td>
                <td>{$row['category']}</td>
                <td>
                  <a href='editProduct.php?id={$row['id']}' class='ationBtn editBtn'><span>Edit </span><i class='fas fa-edit'></i></a>
                  <a href='#' onclick=\"confirmDelete('{$row['id']}','{$row['productName']}')\" class='ationBtn delBtn'><span>Delete </span><i class='fas fa-trash-alt'></i></a>
                </td>
              </tr>";
      }
    } else {
      echo "<tr><td colspan='6'>No products found</td></tr>";
    }
  } else {
    echo "Query failed: " . mysqli_error($conn);
  }
}
?>
