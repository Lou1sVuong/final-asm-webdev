<?php
session_start();
require_once('dbhelper.php');

$servername = "localhost";
$username = "root";
$password = "";
$db = "asm3";
$port = 3307;
global $conn;

$conn = mysqli_connect($servername, $username, $password, $db, $port);

if (!$conn) {
    die('Could not connect: ' . mysqli_connect_error());
}

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = 'DELETE FROM products WHERE id = ?';

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $id);

    if(mysqli_stmt_execute($stmt)) {
        header('Location: products.php');
    } else {
        echo "Lỗi khi thực thi truy vấn: " . mysqli_stmt_error($stmt);
    }
} else {
    echo "ID không tồn tại";
}

?>
