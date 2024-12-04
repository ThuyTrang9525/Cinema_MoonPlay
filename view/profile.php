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

// Xử lý khi người dùng tải ảnh lên
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['avatar'])) {
    if ($_FILES['avatar']['error'] === 0) {
        $allowed_types = array("jpg", "jpeg", "png", "gif");
        $file_type = strtolower(pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION));
        $file_size = $_FILES['avatar']['size'];
        $upload_dir = "../assets/image/";
        $size_image = "50000000";
        // Kiểm tra loại tệp và kích thước
        if (in_array($file_type, $allowed_types) && $file_size < $size_image) {
            // Đặt tên file duy nhất để tránh trùng lặp
            $new_file_name = time() . "_" . basename($_FILES['avatar']['name']);
            $avatar = $upload_dir . $new_file_name;

            // Di chuyển file tải lên
            if (move_uploaded_file($_FILES['avatar']['tmp_name'], $avatar)) {
                // Cập nhật đường dẫn ảnh trong cơ sở dữ liệu
                $sql = "UPDATE users SET avatar = ? WHERE user_id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("si", $avatar, $user_id);
                if ($stmt->execute()) {
                    // Cập nhật thông tin trong mảng $user
                    $user['avatar'] = $avatar;
                    // echo "Ảnh đã được tải lên và cập nhật thành công!";
                } else {
                    echo "Lỗi khi cập nhật cơ sở dữ liệu!";
                }
            } else {
                echo "Lỗi khi di chuyển file tải lên!";
            }
        } else {
            // echo "File không hợp lệ hoặc kích thước vượt quá 5MB!";
        }
    } else {
        echo "Lỗi khi tải file lên!";
    }
}

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
<div class="container" style="width:700px;">
    <div class="profile-card">
        <!-- Hiển thị ảnh đại diện -->
        <img class = "profile_image" src="<?php echo htmlspecialchars($user['avatar'] ?: '../assets/image/default-avatar.png'); ?>" alt="Profile Picture">
        <?php
        // echo "Duong dan anh " . htmlspecialchars($user['avatar']);
        ?>
        <!-- Icon tải ảnh -->
        <i style="position: absolute; bottom: 300px; right: 900px;" class="fas fa-camera upload-icon" onclick="triggerFileInput()"></i>
        <!-- Trường tải tệp -->
        <form method="POST" enctype="multipart/form-data" id="uploadForm">
            <input type="file" name="avatar" id="avatarInput" onchange="submitForm()" accept="image/*" required>
            <button type="submit" name="submit">Tải lên</button>
        </form>
    </div>
    <div class="profile-details">
        <h3>Thông tin tài khoản</h3>
        <div class="details">
            <p><span>Tên: </span><?php echo htmlspecialchars($user['username']); ?></p>
            <p><span>Email: </span><?php echo htmlspecialchars($user['email']); ?></p>
            <p><span>Số điện thoại: </span><?php echo "0345671230" ?></p>
        </div>
    </div>
</div>
<div class="logout-back" style="position: relative;">
    <div class="back" style="width: 150px; position: absolute; top: 200px; right: 300px;">
        <a href="../view/main.php"><button class="btt_back">Quay lại</button></a>
    </div>
    <div class="log-out" style="width: 150px; position: absolute; top: 200px; right: 200px;">
        <a href="../controllers/logout.php"><button class="btt_logout">Đăng xuất</button></a>
    </div>
</div>

<script>
    // Kích hoạt input file
    function triggerFileInput() {
        document.getElementById('avatarInput').click();
    }

    // Tải lên ảnh
    function submitForm() {
        const form = document.getElementById('uploadForm');
        const fileInput = document.getElementById('avatarInput');
        const profileImage = document.getElementById('profileImage');

        // Hiển thị ảnh đã chọn trước khi gửi form
        if (fileInput.files && fileInput.files[0]) {
            const reader = new FileReader();
            reader.onload = function (e) {
                profileImage.src = e.target.result;
            };
            reader.readAsDataURL(fileInput.files[0]);
        }

        form.submit();
    }
</script>
</body>
</html>