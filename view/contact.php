<?php
// Kết nối cơ sở dữ liệu
include_once '../model/connect.php'; // Chèn file kết nối cơ sở dữ liệu

// Khởi tạo session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Kiểm tra xem người dùng đã đăng nhập hay chưa
$user_id = $_SESSION['user_id'] ?? null;

$success_message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['feedback'])) {
    if (is_null($user_id)) {
        die("Bạn cần đăng nhập để bình luận.");
    }

    $content = trim($_POST['feedback']);
    if (!empty($content)) {
        // Sửa lỗi câu lệnh SQL
        $sql_insert_comment = "INSERT INTO feedback (user_id, feed_content, time) VALUES (?, ?, NOW())";
        $stmt_insert = $conn->prepare($sql_insert_comment);
        $stmt_insert->bind_param("is", $user_id, $content);
        
        // Kiểm tra lỗi SQL
        if ($stmt_insert->execute()) {
            // Gửi feedback thành công
            $success_message = "Bạn đã gửi feedback thành công!";
        } else {
            die("Lỗi SQL: " . $stmt_insert->error);
        }
    } else {
        die("Nội dung feedback không được để trống.");
    }
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <!-- Header -->
     <?php include('../model/header.php'); ?>

     <?php if (!empty($success_message)): ?>
        <p style="color: green;"><?php echo $success_message; ?></p>
    <?php endif; ?>


     <!-- Main content -->
    <div class="contact">
        <h2>MoonPlay</h2>

        <p>Chúng tôi rất mong muốn lắng nghe từ bạn! Hãy liên hệ với chúng tôi để chia sẻ ý kiến, góp ý hoặc giải đáp mọi câu hỏi
        bạn có về trang web MoonPlay. Chúng tôi luôn sẵn sàng hỗ trợ bạn một cách tốt nhất.</p>

        <p>Bạn có thể liên hệ với chúng tôi thông qua mẫu liên hệ trê9n trang web hoặc gửi email trực tiếp đến địa chỉ hộp thư của
        chúng tôi. Chúng tôi sẽ cố gắng phản hồi nhanh chóng và đáp ứng mọi yêu cầu của bạn.</p>

        <div class="comment">
            <div class="input_comment">
                <form method="POST" action="">
                    <label for="">Họ tên <input type="text" name="name" placeholder="Họ tên của bạn" required></label>
                    <label for="">Góp ý <input type="text" name="feedback" placeholder="Góp ý của bạn" required></label>
                    <button type="submit">Gửi ngay!</button>
                </form>
            </div>

            <div class="film">
                <a href="#"><img src="../assets/image/Hình ảnh/chichiemem 1.jpg" alt=""></a>
                <a href="#"><img src="../assets/image/Hình ảnh/chichiemem 2.jpg" alt=""></a>
                <a href="#"><img src="../assets/image/Hình ảnh/chichiemem 3.jpg" alt=""></a>
                <a href="#"><img src="../assets/image/Hình ảnh/image 50.jpg" alt=""></i></a>
            </div>
        </div>
        <p>Ngoài ra, bạn cũng có thể kết nối với chúng tôi thông qua các mạng xã hội như Facebook, Twitter hoặc Instagram. Đừng
        ngần ngại gửi tin nhắn cho chúng tôi hoặc tham gia vào các cuộc thảo luận và sự kiện đặc biệt mà chúng tôi tổ chức.</p>


        <div class="Social">
            <div class="social_platform">
                <div>
                    <img src="../assets/image/Hình ảnh/Vector.jpg" alt="">
                    <p>Trang facebook</p>
                </div>
                <div>
                    <img src="../assets/image/Hình ảnh/Group.jpg" alt="">
                    <p>Instagram</p>
                </div>
                <div>
                    <img src="../assets/image/Hình ảnh/Vector (1).jpg" alt="">
                    <p>Trang Youtube</p>
                </div>
                <div>
                    <img src="../assets/image/Hình ảnh/Group (1).jpg" alt="">
                    <p>Trang Tiktok</p>
                </div>
            </div>
        
            <div class="film">
                <a href="#"><img src="../assets/image/Hình ảnh/image 53.jpg" alt=""></a>
                <a href="#"><img src="../assets/image/Hình ảnh/image 50.jpg" alt=""></a>
                <a href="#"><img src="../assets/image/Hình ảnh/image 49.jpg" alt=""></a>
                <a href="#"><img src="../assets/image/Hình ảnh/image 32.jpg" alt=""></a>
            </div>
        </div>
        <p>Chúng tôi luôn đặt sự hài lòng và phản hồi của người dùng lên hàng đầu. Vì vậy, hãy cho chúng tôi biết ý kiến của bạn và
        chúng tôi sẽ cùng nhau xây dựng MoonPlay trở thành một trang web xem phim tốt nhất.</p>

    </div>


    <?php include('../model/useMore.php')?>




     <!-- Footer -->
    <?php include('../model/footer.php'); ?>
    
</body>
</html>