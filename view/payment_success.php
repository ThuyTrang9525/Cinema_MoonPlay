<!-- Hàm gửi mail -->

<?php

session_start();
require '../PHPMailer-master/src/PHPMailer.php';
require '../PHPMailer-master/src/SMTP.php';
require '../PHPMailer-master/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require_once '../model/connect.php';

if (($_SERVER['REQUEST_METHOD'] == 'POST')) {
    // Kết nối cơ sở dữ liệu

    // Lấy dữ liệu từ form
    $name = $_POST['name'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $email = $_POST['email'] ?? '';
    $note = $_POST['note'] ?? '';
    $total_money = $_SESSION['totalmoney'] ?? 0;
}


function sendMail($name, $email, $subject, $content) {
  $mail = new PHPMailer(true);
    

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'hothiduyenhai2005@gmail.com';
        $mail->Password = 'ywpk ihvv monx ulxi';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 465;

        $mail->setFrom('no-reply@moonplay.com', 'MoonPlay');
        $mail->addAddress($email, $name);
  
        // Cấu hình mã hóa UTF-8
        $mail->CharSet = 'UTF-8';

        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $content;

        $mail->send();
        // echo 'Gửi email thành công';
    } catch (Exception $e) {
        echo "Gửi email thất bại. Lỗi Mailer: {$mail->ErrorInfo}";
    }
}

if (!empty($email)) {
    $subject = "Thanh toán thành công";
    $content = "Chào $name,<br><br>Cảm ơn bạn đã thanh toán. Bạn đã mua gói thành công với tổng số tiền là $total_money VNĐ.<br><br>Chúc bạn có những trải nghiệm thú vị và mới mẻ tại MoonPlay.";
    sendMail($name, $email, $subject, $content);

    // Lưu thông tin đơn hàng vào cơ sở dữ liệu
    $sql = "INSERT INTO orders (order_name, phone, email, note, total) 
            VALUES ('$name', '$phone', '$email', '$note', $total_money)";
    if (mysqli_query($conn, $sql)) {
        // echo "Lưu đơn hàng thành công!";
    } else {
        echo "Lỗi khi lưu đơn hàng: " . mysqli_error($conn);
    }
}
?>

<link rel="stylesheet" href="../assets/css/payment_success.css">
<body>
  <div class="success-page">
    <div class="content">
      <div class="icon">
        <img src="../assets/image/image_prev_ui.png" alt="Success Icon">
      </div>
      <h1>ĐĂNG KÝ THÀNH CÔNG</h1>
      <p>Bạn đã đăng ký tài khoản thành công!</p>
      <p>Bạn có thể cập nhật và chỉnh sửa thông tin trong phần quản lý thông tin.</p>
      <button class="home-btn" onclick="window.location.href='profile.html'">ĐI ĐẾN TRANG CHỦ</button>
    </div>
  </div>
</body>
</html>
