<?php
session_start();
error_reporting(E_ALL ^ E_DEPRECATED);
require_once '../model/connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    // Mã hóa mật khẩu
    // $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Kiểm tra email hợp lệ
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = "Email không hợp lệ!";
        header("location:../view/register.php");
        exit();
    }

    // Kiểm tra xem đã có admin hay chưa
    $check_admin_sql = "SELECT * FROM users WHERE role = 'admin'";
    $admin_res = mysqli_query($conn, $check_admin_sql);

    if (!$admin_res) {
        $_SESSION['error'] = "Lỗi truy vấn: " . mysqli_error($conn);
        header("location:../view/register.php");
        exit();
    }

    if (mysqli_num_rows($admin_res) > 0) {
        $role = "user";
    } else {
        $role = "admin"; // Gán admin nếu chưa có admin
    }

    // Thêm người dùng vào cơ sở dữ liệu
    $stmt = $conn->prepare("INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $username, $email, $password, $role);
    $res = $stmt->execute();

    if ($res) {
        $_SESSION['success'] = "Đăng ký thành công!";
        header("location:../view/login.php");
        exit();
    } else {
        $_SESSION['error'] = "Lỗi khi đăng ký: " . $stmt->error;
        header("location:../view/register.php");
        exit();
    }
}
?>