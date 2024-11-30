<?php
session_start();
error_reporting(2);
error_reporting(E_ALL ^ E_DEPRECATED);
require_once '../model/connect.php';
require_once '../controllers/payment_back.php';
// session_unset();

// Khởi tạo session nếu chưa có
// Lấy dữ liệu từ form


// Thanh toán đơn hàng

           
        

// Kiểm tra mã giảm giá 

  
?>
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Form Thanh Toán</title>
  <link rel="stylesheet" href="../assets/css/check_out.css">
</head>
<body>
             <!-- Header -->
             <div class="header">
                <div class="logo">
                    <img src="../assets/image/Hình ảnh/logo.png">
                </div>
                <div class="exit">
                    <b>Đăng xuất</b>
                </div>
            </div>
  <div class="container">
    <!-- Form Section -->
    <div class="form-section">
      <h2>Thông tin thanh toán</h2>
      <form>
        <div class="form-group">
          <label for="name">Họ và tên *</label>
          <input type="text" id="name" placeholder="Nhập đầy đủ họ và tên của bạn" required>
        </div>
        <div class="form-group">
          <label for="phone">Số điện thoại *</label>
          <input type="text" id="phone" placeholder="Nhập số điện thoại của bạn" required>
        </div>
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" id="email" placeholder="Nhập email của bạn">
        </div>
        <div class="form-group">
          <label for="note">Ghi chú đơn hàng (tùy chọn)</label>
          <textarea id="note" placeholder="Ghi chú về thời gian giao hàng hoặc yêu cầu khác"></textarea>
        </div>
      </form>
    </div>

    <!-- Order Section -->
    <div class="order-section">
      <h2>Đơn hàng của bạn</h2>
      <div class="order-summary">
            <h3>Chi tiết đơn hàng</h3>
            <?php showpayment(); ?>
      </div>
        <!-- Thêm form mã giảm giá -->
    <div class="discount-section">
        <form method="POST" action="payment.php">
            <label for="discount">Nhập mã giảm giá:</label>
            <input type="text" name="discount_code"  id="discount" placeholder="Nhập mã giảm giá" required>
            <button type="submit" name="apply_discount" value="1" class="discount_button" >áp dụng</button>
        </form>
    </div>


      <?php
if (isset($_POST['apply_discount']) && !empty($_POST['discount_code'])) {
    $discount_code = $_POST['discount_code'];
    // Truy vấn cơ sở dữ liệu để kiểm tra mã giảm giá
    $sql = "SELECT * FROM discount_codes WHERE code = '$discount_code' AND usage_limit > 0";
    $result = mysqli_query($conn, $sql);

    // Kiểm tra mã giảm giá hợp lệ
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        // Lấy phần trăm giảm giá
        $discount_percent = $row['discount_percentage'];

        // Giảm số lượng mã sử dụng
        $update_discount = "UPDATE discount_codes SET usage_limit = usage_limit - 1 WHERE code = '$discount_code'";
        mysqli_query($conn, $update_discount);

        echo "<p style='color: red;'>Mã giảm giá hợp lệ! Giảm $discount_percent%</p>";

        // Tính tổng tiền sau khi giảm giá
        $sum = $_SESSION['package'][1]; // Lấy giá trị ban đầu từ session
        $sum_after_percent = $sum - ($sum * $discount_percent / 100);

        // Lưu tổng tiền sau khi giảm giá vào session
        $_SESSION['totalmoney'] = $sum_after_percent;

    } else {
        echo "<p style='color: red;'>Mã giảm giá không hợp lệ</p>";
    }
}
?>

<?php
// Kiểm tra xem có dữ liệu trong session package chưa
$sum = 0;
if (isset($_SESSION['package']) && is_array($_SESSION['package'])) {
    // Nếu mã giảm giá không được áp dụng, sử dụng tổng tiền ban đầu từ $_SESSION['package'][1]
    $sum = $_SESSION['package'][1];
}

// Nếu có tổng tiền sau khi giảm giá, sử dụng giá trị trong $_SESSION['totalmoney']
if (isset($_SESSION['totalmoney'])) {
    $sum = $_SESSION['totalmoney'];
}

echo '<p>Tổng tiền là: <span class="totalPrice">' . number_format($sum, 0) . '</span></p>';
?>


        
      <div class="payment-options">
        <label>
          <input type="radio" name="payment" checked>
          Chuyển khoản ngân hàng
        </label>
        <p class="note">Thực hiện thanh toán vào ngay tài khoản ngân hàng của chúng tôi. Đơn hàng sẽ được giao sau khi tiền đã chuyển.</p>
        <label>
          <input type="radio" name="payment">
          Trả tiền mặt khi nhận hàng
        </label>
      </div>

      <button class="order-button">Thanh Toán</button>
      <p class="note">Thông tin cá nhân của bạn sẽ được sử dụng để xử lý đơn hàng, tăng trải nghiệm sử dụng website, và cho các mục đích khác được mô tả trong chính sách bảo mật của chúng tôi.</p>
    </div>
  </div>
</body>
</html>