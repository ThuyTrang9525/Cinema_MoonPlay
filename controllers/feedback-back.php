<?php
// Gọi file kết nối
include '../model/connect.php';

// Kiểm tra nếu user đã đăng nhập
if (!isset($_SESSION['user_id'])) {
    // Chưa đăng nhập, chuyển hướng đến trang đăng nhập
    header("Location: ../view/login.php");
    exit();
}

// Lấy thông tin từ session
$user_id = $_SESSION['user_id']; // ID của người dùng đã đăng nhập

// Lấy dữ liệu từ form
$feedback = $_POST['feedback'];

// Chuẩn bị câu truy vấn
$sql = "INSERT INTO feedback (user_id, feed_content, time) VALUES (?, ?, NOW())";
$stmt = $conn->prepare($sql);

// Gán giá trị và thực thi
$stmt->bind_param("is", $user_id, $feedback);

if ($stmt->execute()) {
    echo "Góp ý đã được gửi thành công!";
} else {
    echo "Có lỗi xảy ra: " . $stmt->error;
}

// Đóng kết nối
$stmt->close();
$conn->close();
?>
