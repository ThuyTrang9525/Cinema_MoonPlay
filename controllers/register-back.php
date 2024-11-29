<?php
include '../model/connect.php'; // Kết nối đến database

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Lấy dữ liệu từ form
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $avatar = $_POST['avatar'] ?? ''; // Avatar là tùy chọn

    // Mã hóa mật khẩu
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Kiểm tra email đã tồn tại chưa
    $check_sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($check_sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        alert("Email đã được sử dụng!") ;
    } else {
        // Thêm người dùng vào bảng users
        $sql = "INSERT INTO users (username, email, password, role, avatar) VALUES (?, ?, ?, 'user', ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $username, $email, $hashed_password, $avatar);

        if ($stmt->execute()) {
            // Chuyển hướng đến trang login.php sau khi đăng ký thành công
            header("Location: ../view/login.php");
            exit();
        } else {
            alert( "Đã xảy ra lỗi. Vui lòng thử lại.");
        }
    }
}
?>
