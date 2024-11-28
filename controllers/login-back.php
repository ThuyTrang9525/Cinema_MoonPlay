<?php
session_start();
require_once '../model/connect.php'; // Kết nối đến cơ sở dữ liệu

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Lấy dữ liệu từ form
    $username= $_POST['username'];   // Đảm bảo lấy đúng giá trị từ form
    $password = $_POST['password'];  // Đảm bảo lấy đúng giá trị từ form

    // Kiểm tra xem email có tồn tại trong cơ sở dữ liệu không
    $check_sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($check_sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Lấy thông tin người dùng
        $user = $result->fetch_assoc();

        // Kiểm tra mật khẩu
        if (password_verify($password, $user['password'])) {
            // Đăng nhập thành công, lưu thông tin người dùng vào session
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['role'] = $user['role'];

            // Chuyển hướng đến trang main.php
            header("Location: /PHP_Project/view/main.php");
            exit();
        } else {
            // Mật khẩu sai
            echo "Mật khẩu không đúng.";
        }
    } 
} else {
    // Nếu không phải POST request
    echo "Vui lòng gửi form đăng nhập.";
}
?>
