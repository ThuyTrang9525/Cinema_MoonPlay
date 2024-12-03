<?php
// Kết nối cơ sở dữ liệu
require_once "../model/connect.php";

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}



// Lấy giá trị từ tham số GET
$type = isset($_GET['type']) ? trim($_GET['type']) : "";

// Xây dựng truy vấn
if ($type === "") {
    // Nếu không có loại phim, lấy tất cả phim
    $sql = "SELECT * FROM movies";
    $stmt = $conn->prepare($sql);
} else {
    // Nếu có loại phim, lấy phim theo loại
    $sql = "SELECT * FROM movies WHERE type = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $type);
}

// Thực thi truy vấn
$stmt->execute();
$result = $stmt->get_result();

// Kiểm tra và lưu kết quả
$movies = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $movies[] = $row;
    }
}

// Đóng kết nối
$stmt->close();
$conn->close();
?>

