<?php
session_start();
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
?>
