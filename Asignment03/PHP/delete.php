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

if(isset($_GET['email'])){
    $email = $_GET['email'];
    $sql = 'DELETE FROM users WHERE email = ?';

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 's', $email);
    mysqli_stmt_execute($stmt);

    header('Location: users.php');
}
?>
