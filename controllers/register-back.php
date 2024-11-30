<?php
session_start();
error_reporting(E_ALL ^ E_DEPRECATED);
require_once '../model/connect.php';

require '../PHPMailer-master/src/PHPMailer.php';
require '../PHPMailer-master/src/SMTP.php';
require '../PHPMailer-master/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Kiểm tra kết nối
    if (!$conn) {
        $_SESSION['error'] = "Kết nối cơ sở dữ liệu thất bại.";
        header("location:../view/register.php");
        exit();
    }

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

    // Kiểm tra email đã tồn tại
    $check_email_sql = "SELECT * FROM users WHERE email = ?";
    $email_stmt = $conn->prepare($check_email_sql);
    $email_stmt->bind_param("s", $email);
    $email_stmt->execute();
    $email_res = $email_stmt->get_result();

    if ($email_res->num_rows > 0) {
        $_SESSION['error'] = "Email đã tồn tại!";
        header("location:../view/register.php");
        exit();
    }

    // Kiểm tra và xác định vai trò
    $role = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users WHERE role = 'admin'")) > 0 ? "user" : "admin";

    // Mã hóa mật khẩu
    // $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Thêm người dùng vào cơ sở dữ liệu
    $stmt = $conn->prepare("INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $username, $email, $password, $role);

    if ($stmt->execute()) {
        sendWelcomeEmail($username, $email, $password); // Gửi email chào mừng
        $_SESSION['success'] = "Đăng ký thành công!";
        header("location:../view/login.php");
        exit();
    } else {
        $_SESSION['error'] = "Lỗi khi đăng ký: " . $stmt->error;
        header("location:../view/register.php");
        exit();
    }
}

// Hàm gửi email chào mừng
function sendWelcomeEmail($username, $email, $password) {
    $mail = new PHPMailer(true);

    try {
        // Cấu hình SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'kim.ho26@student.passerellesnumeriques.org'; // Thay bằng mail của bạn
        $mail->Password = 'bdoc dfau sfex isqw';  // Thay bằng mk mail của bạn
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom('no-reply@moonplay.com', 'MoonPlay');
        $mail->addAddress($email, $username);

        // Cấu hình mã hóa UTF-8
        $mail->CharSet = 'UTF-8';


        // Nội dung email
        $mail->isHTML(true);
        $mail->Subject = "CHÀO MỪNG ĐẾN VỚI MoonPlay";
        $mail->Body = 'XIN CHÀO ' . $username . ',<br><br>CẢM ƠN BẠN ĐÃ ĐĂNG KÝ. CHÚC BẠN CÓ TRẢI NGHIỆM TUYỆT VỜI VỚI MoonPlay!<br><br>'
            . 'TÊN ĐĂNG NHẬP CỦA BẠN LÀ: ' . $username . '<br>'
            . 'MẬT KHẨU CỦA BẠN LÀ: ' . $password . '<br><br> CHÚC BẠN MỘT NGÀY TỐT LÀNH!';
        $mail->AltBody = 'XIN CHÀO ' . $username . "\n"
            . 'TÊN ĐĂNG NHẬP CỦA BẠN LÀ: ' . $username . "\n"
            . 'MẬT KHẨU CỦA BẠN LÀ: ' . $password . "\n\n CHÚC BẠN MỘT NGÀY TỐT LÀNH!";

        // Gửi email
        $mail->send();
    } catch (Exception $e) {
        echo "Email không gửi được. Lỗi: {$mail->ErrorInfo}";
    }
}
?>