<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "moonplaycinema";

// Tạo kết nối
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
else {
    // echo "Kết nối đến cơ sở dữ liệu thành công!";
}

// Đóng kết nối
?>