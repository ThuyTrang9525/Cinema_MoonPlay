<?php
// Bắt đầu phiên
session_start();

// Bật hiển thị lỗi để phát hiện vấn đề
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Kết nối cơ sở dữ liệu
include '../model/connect.php'; // Đảm bảo đường dẫn đúng đến tệp kết nối

// Kiểm tra nếu form đã được gửi
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy và làm sạch dữ liệu đầu vào
    $name = trim($_POST['name']);
    $feedback = trim($_POST['feedback']);
    
    // Kiểm tra dữ liệu đầu vào
    if (empty($name) || empty($feedback)) {
        echo "Please fill in all fields.";
        exit;
    }

    // Kiểm tra người dùng đã đăng nhập
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
        echo "User  ID: " . htmlspecialchars($user_id) . "<br>"; // Kiểm tra user_id

        // Chuẩn bị câu lệnh SQL để thêm feedback vào cơ sở dữ liệu
        $stmt = $pdo->prepare("INSERT INTO feedback (user_id, feed_content, time) VALUES (:user_id, :content, NOW())");

        // Liên kết tham số
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':content', $feedback);

        // Thực thi câu lệnh
        if ($stmt->execute()) {
            echo "Feedback submitted successfully!";
        } else {
            // Lấy thông tin lỗi
            $errorInfo = $stmt->errorInfo();
            echo "Error submitting feedback: " . $errorInfo[2]; // In ra thông báo lỗi
        }
    } else {
        echo "User  is not logged in.";
    }
} else {
    echo "Invalid request method.";
}

// Đóng kết nối cơ sở dữ liệu
$pdo = null;
?>