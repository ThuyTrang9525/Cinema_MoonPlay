
<!-- Hàm gửi mail -->

<?php
session_start();
require_once '../PHPMailer-master/src/PHPMailer.php';
require_once '../PHPMailer-master/src/SMTP.php';
require_once '../PHPMailer-master/src/Exception.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require_once '../model/connect.php';

$sum = $_SESSION['package'][1];
$current_date = date('Y-m-d'); // Ngày hiện tại
if (($_SERVER['REQUEST_METHOD'] == 'POST')) {
    // Lấy dữ liệu từ form

    $name = $_POST['name'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $email = $_POST['email'] ?? '';
    $note = $_POST['note'] ?? '';

    $total_money = $_SESSION['totalmoney']?? 0 ;
    // $start_date = $_SESSION['start_date'];
    $start_date = $current_date;
    $end_date=$_SESSION['end_date'];
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
            $mail->CharSet = 'UTF-8';
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = $content;
            $mail->send();
        } catch (Exception $e) {
            echo "Gửi email thất bại: {$mail->ErrorInfo}";
        }
    }


if (!empty($email)) {
  // Khi gửi email, lấy tổng tiền từ session
  // $total_money = isset($_SESSION['totalmoney']) ? $_SESSION['totalmoney'] : 0;
   $total_money = isset($_SESSION['totalmoney']) ? $_SESSION['totalmoney'] : $sum;
    // Lấy tổng tiền sau khi áp dụng mã giảm giá
    $subject = "Thanh toán thành công";
    $content = "Chào $name,<br><br>Cảm ơn bạn đã thanh toán. Bạn đã mua gói thành công với tổng số tiền là $total_money VNĐ và gói đăng ký này sẽ hết hạn vào  $end_date .<br><br>Chúc bạn có những trải nghiệm thú vị và mới mẻ tại MoonPlay.";
    sendMail($name, $email, $subject, $content);
    // Lưu thông tin đơn hàng vào cơ sở dữ liệu
    $sql = "INSERT INTO orders (order_name, phone, email, note, total, start_date, end_date, is_notified) 
    VALUES ('$name', '$phone', '$email', '$note', '$total_money', '$start_date', '$end_date', 0)";
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
      <h1>ĐĂNG KÝ GÓI THÀNH CÔNG</h1>
      <p>Bạn đã đăng ký gói thành công!</p>
      <p>Bạn có thể cập nhật và chỉnh sửa thông tin trong phần quản lý thông tin.</p>
      <button class="home-btn" onclick="window.location.href='../view/main.php'">ĐI ĐẾN TRANG CHỦ</button>
    </div>
  </div>
</body>
