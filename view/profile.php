<?php
session_start();
require_once '../model/connect.php';

// Bật hiển thị lỗi (chỉ bật trong môi trường phát triển, không nên bật trên môi trường sản phẩm)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Kiểm tra kết nối cơ sở dữ liệu
if (!$conn) {
    die("Kết nối cơ sở dữ liệu thất bại: " . mysqli_connect_error());
}

// Kiểm tra nếu chưa đăng nhập
if (!isset($_SESSION['user_id'])) {
    header("Location: profile.php");
    exit();
}

// Lấy thông tin người dùng từ database
$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM users WHERE user_id = ?";

$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    die("Không tìm thấy thông tin người dùng.");
}
$avatar ='';
if (isset($_POST['submit'])) {
    $avatar = "image/" . basename($_FILES['avatar']['name']);
    move_uploaded_file($_FILES['avatar']['tmp_name'],$avatar);
}
    // Chèn dữ liệu vào bảng
    $sql = "UPDATE users SET avatar = '$avatar' WHERE user_id = $user_id";
    $result = mysqli_query($conn, $sql);

    
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="../assets/css/profile.css">
</head>
<body>
<div class="container">
    <div class="profile-card">
        <img src="<?php echo htmlspecialchars($user['avatar']); ?>" alt="Profile Picture" width="100" height="100">
    </div>
    <div class="profile-details">
        <h3>Thông tin tài khoản</h3>
        <div class="details">
            <p><span>Tên:</span><?php echo htmlspecialchars($user['username']); ?></p>
            <p><span>Email:</span><?php echo htmlspecialchars($user['email']); ?></p>
        </div>
        <form method="POST" enctype="multipart/form-data"> 
            <label for="profile_picture">Cập nhật ảnh đại diện:</label> 
            <input type="file" name="avatar" required> 
            <button type="submit">Cập nhật</button> 
        </form>
    </div>
</div>
</body>
</html>