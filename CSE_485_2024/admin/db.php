<?php
$host = '127.0.0.1';
$db   = 'btth01_cse485';
$user = 'root';  // Tên người dùng MySQL
$pass = '';  // Mật khẩu MySQL
$charset = 'utf8mb4';
// Kết nối
$conn = new mysqli($host, $user, $pass, $db);
// Kiểm tra kết nối

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}


?>
