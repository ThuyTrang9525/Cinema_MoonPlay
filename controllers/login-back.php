<?php
session_start();
error_reporting(E_ALL ^ E_DEPRECATED);
require_once '../model/connect.php';

// Kiểm tra kết nối
if (!$conn) {
    die("Kết nối cơ sở dữ liệu thất bại: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Lấy dữ liệu từ form
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // Truy vấn người dùng theo tên đăng nhập
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Tìm thấy người dùng, kiểm tra mật khẩu
        $user = $result->fetch_assoc();
        // So sánh mật khẩu (vì mật khẩu không mã hóa, so sánh trực tiếp)
        if ($password === $user['password']) {
            // var_dump($password === $user['password']);
            // Đăng nhập thành công, lưu thông tin vào session
            $_SESSION['username'] = $user['username'];
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['role'] = $user['role'];

            // Điều hướng dựa trên vai trò
            if ($user['role'] == "user") {
                header("location: ../view/main.php");
                exit();
            } else if ($user['role'] == "admin") {
                header("location: ../view/admin.php");
                exit();
            } else {
                header("location: ../view/login.php");
            }
            exit();
        } else {
            // Sai mật khẩu
            header("location: ../view/login.php?rf=wrong_password");
            exit();
        }
    } else {
        // Không tìm thấy tài khoản
        header("location: ../view/login.php?rf=user_not_found");
        exit();
    }
}
$conn->close();
?>