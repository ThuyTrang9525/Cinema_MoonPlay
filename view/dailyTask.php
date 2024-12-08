<?php
// session_start();

require_once("C:/xampp/htdocs/DoAn/Project_PHP/Cinema_MoonPlay/PHPMailer-master/src/PHPMailer.php");
require_once("C:/xampp/htdocs/DoAn/Project_PHP/Cinema_MoonPlay/PHPMailer-master/src/SMTP.php");
require_once("C:/xampp/htdocs/DoAn/Project_PHP/Cinema_MoonPlay/PHPMailer-master/src/Exception.php");


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;  
require_once 'C:/xampp/htdocs/DoAn/Project_PHP/Cinema_MoonPlay/model/connect.php';

function sendExpirationEmail($name, $email, $subject, $content) {
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'hothiduyenhai2005@gmail.com'; // Thay bằng email của bạn
        $mail->Password = 'ywpk ihvv monx ulxi'; // App Password (mật khẩu ứng dụng)
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 465;
        $mail->setFrom('no-reply@moonplay.com', 'MoonPlay');
        $mail->addAddress($email, $name);
        $mail->CharSet = 'UTF-8';
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $content;
        $mail->send();
        echo "Email đã được gửi đến $email thành công!<br>";
    } catch (Exception $e) {
        echo "Lỗi khi gửi email: {$mail->ErrorInfo}<br>";
    }
}

// Kiểm tra các gói hết hạn
$current_date = date('Y-m-d'); // Ngày hiện tại

$sql = "SELECT * FROM orders WHERE end_date <= '$current_date' AND is_notified = 0";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $name = $row['order_name']; // Tên người dùng
        $email = $row['email']; // Email người dùng
        $end_date = $row['end_date']; // Ngày hết hạn

        // Tạo nội dung email
        $subject = "Thông báo: Gói dịch vụ đã hết hạn!";
        $content = "
            Chào $name,<br><br>
            Gói dịch vụ của bạn đã hết hạn vào ngày $end_date. Vui lòng gia hạn để tiếp tục sử dụng dịch vụ.<br><br>
            <a href='https://moonplay.com/renew'>Gia hạn ngay</a>
        ";

        // Gửi email
        sendExpirationEmail($name, $email, $subject, $content);

        // Cập nhật trạng thái thông báo
        $update_sql = "UPDATE orders SET is_notified = 1 WHERE id = " . $row['id'];
        mysqli_query($conn, $update_sql);
    }
} else {
    echo "Không có gói nào cần thông báo.<br>";
}
?>
