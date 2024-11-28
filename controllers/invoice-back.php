<?php
session_start();

// Include PHPMailer classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once 'D:/Cinema_MoonPlay/PHPMailer-master/src/Exception.php';
require 'D:/Cinema_MoonPlay/PHPMailer-master/src/PHPMailer.php';
require 'D:/Cinema_MoonPlay/PHPMailer-master/src/SMTP.php';

// Hàm gửi email
function sendEmail($to, $subject, $message) {
    $mail = new PHPMailer(true); // Create a new PHPMailer instance

    try {
        // Cấu hình SMTP
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';  // Máy chủ SMTP của Gmail
            $mail->SMTPAuth = true;
            $mail->Username = 'on.ho26@student.passerellesnumeriques.org';  // Thay đổi với email của bạn
            $mail->Password = 'jriaycnpewjpslnu';     // Thay đổi với mật khẩu ứng dụng của bạn
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;  // Sử dụng STARTTLS
            $mail->Port = 587;  // Cổng cho STARTTLS

        // Thiết lập người gửi và người nhận
        $mail->setFrom('no-reply@moonplay.com', 'MoonPlay');
        $mail->addAddress($to); // Add a recipient

        // Cấu hình email
        $mail->isHTML(false); // Set email format to plain text
        $mail->Subject = $subject;
        $mail->Body = $message;

        // Gửi email
        $mail->send();
        return true; // Return true if email is sent successfully
    } catch (Exception $e) {
        return false; // Return false if there was an error
    }
}

// Kiểm tra nếu có yêu cầu POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $sdt = $_POST['sdt'] ?? '';
    $email = $_POST['email'] ?? '';
    $paymentMethod = $_POST['payment'] ?? '';
    $confirmationCodeInput = $_POST['maxn'] ?? '';

    // Bước 1: Xử lý yêu cầu gửi mã xác nhận
    if (isset($_POST['send_code'])) {
        if (empty($name) || empty($sdt) || empty($email) || empty($paymentMethod)) {
            $error = "Vui lòng nhập đầy đủ thông tin.";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = "Email không hợp lệ.";
        } else {
            $confirmationCode = rand(100000, 999999); // Tạo mã xác nhận
            $_SESSION['confirmation_code'] = $confirmationCode;
            $_SESSION['payment_info'] = compact('name', 'sdt', 'email', 'paymentMethod');

            // Gửi mã xác nhận qua email
            $subject = "Mã xác nhận thanh toán";
            $message = "Chào $name,\n\nMã xác nhận của bạn là: $confirmationCode\n\nCảm ơn bạn đã sử dụng dịch vụ của chúng tôi.";
            if (sendEmail($email, $subject, $message)) {
                $success = "Mã xác nhận đã được gửi đến email của bạn.";
            } else {
                $error = "Không thể gửi email. Vui lòng thử lại.";
            }
        }
    }

    // Bước 2: Xử lý xác nhận mã
    if (isset($_POST['confirm_payment'])) {
        $correctCode = $_SESSION['confirmation_code'] ?? null;

        if ($confirmationCodeInput === (string)$correctCode) {
            $paymentInfo = $_SESSION['payment_info'];

            // Gửi email xác nhận thanh toán thành công
            $subject = "Xác nhận thanh toán thành công";
            $message = "Chào {$paymentInfo['name']},\n\nChúc mừng bạn đã thanh toán thành công.\nThông tin chi tiết:\n- Họ tên: {$paymentInfo['name']}\n- SĐT: {$paymentInfo['sdt']}\n- Phương thức thanh toán: {$paymentInfo['paymentMethod']}\n\nTrân trọng,\nMoonPlay.";
            if (sendEmail($paymentInfo['email'], $subject, $message)) {
                $success = "Thanh toán thành công. Email xác nhận đã được gửi.";
                unset($_SESSION['confirmation_code'], $_SESSION['payment_info']); // Xóa thông tin sau khi hoàn tất
            } else {
                $error = "Có lỗi xảy ra khi gửi email xác nhận thanh toán.";
            }
        } else {
            $error = "Bạn đã nhập sai mã xác nhận.";
        }
    }
}
?>