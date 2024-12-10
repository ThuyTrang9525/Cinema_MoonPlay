<?php
session_start();
error_reporting(2);
error_reporting(E_ALL ^ E_DEPRECATED);
require_once '../model/connect.php';


function showpayment(){
    if(isset($_SESSION['package'])&&(is_array($_SESSION['package']))){
      $sum=0;
      $package = $_SESSION['package'];
        echo '<p>Tên Gói: ' . $package[0] . '</p>';

        $sum += $package[1];
    }
    echo '<p>Giá: <span class="price">' . $sum . '</span></p>';
}
if( ($_SERVER['REQUEST_METHOD'] == 'POST')){
    if(!isset($_SESSION['package'])) {
      $_SESSION['package']=[];
    }
    if (isset($_SESSION['totalmoney'])) {
      unset($_SESSION['totalmoney']);  
  }
   
   
  $name = isset($_POST['package_name']) ? $_POST['package_name'] : null;
  $price = isset($_POST['package_price']) ? $_POST['package_price'] : null;
  $quality = isset($_POST['package_quality']) ? $_POST['package_quality'] : null;

  $start_date = isset($_POST['start_date']) ? $_POST['start_date'] : date('Y-m-d'); // Sử dụng ngày hôm nay nếu không có ngày được nhập
  // $_SESSION['start_date'] = $start_date;

 // Kiểm tra nếu thông tin gói hợp lệ
 if ($name && $price > 0 && $quality > 0) {
  // Tính ngày hết hạn dựa vào package_name
  $name = strtolower(trim($_POST['package_name']));
  switch ($name) {
      case '1 tháng':
          $end_date = date('Y-m-d', strtotime('+1 month', strtotime($start_date)));
          break;
      case '3 tháng':
          $end_date = date('Y-m-d', strtotime('+3 months', strtotime($start_date)));
          break;
      case '7 tháng':
          $end_date = date('Y-m-d', strtotime('+7 months', strtotime($start_date)));
          break;
      case '12 tháng':
          $end_date = date('Y-m-d', strtotime('+12 months', strtotime($start_date)));
          break;
      default:
          $end_date = 'Không xác định';
          break;
  }
     $packages = [$name, $price, $quality];
        $_SESSION['package'] = $packages;
        $_SESSION['end_date'] = $end_date; // Lưu ngày hết hạn
        $_SESSION['start_date'] = $start_date;
  } 
  // require_once '../model/connect.php';
  // $sql = "INSERT INTO orders (order_name, phone, email, note, total, ten_goi, start_date, end_date, is_notified)
  //       VALUES ('$order_name', '$phone', '$email', '$note', $sum, '$name', '$start_date', '$end_date', 0)";

    // Kết nối và chèn dữ liệu vào bảng
  // echo "Start date: $start_date, End date: $end_date";
}


// session_unset();

?>
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Form Thanh Toán</title>
  <link rel="stylesheet" href="../assets/css/payment.css">
</head>
<body>

             <!-- Header -->
             <div class="header">
                <div class="logo">
                    <a href="../view/main.php">
                    <img src="../assets/image/Hình ảnh/logo.png" alt="Logo">
                </a>
                </div>
                <div class="exit">
                    <b>Đăng xuất</b>
                </div>
            </div>

  <div class="container">
    <!-- Form Section -->
    <div class="form-section">
      <h2>Thông tin thanh toán</h2>
      <form method="POST" action="payment_success.php"onsubmit="return validateForm()" >
      <div class="form-group">
        <label for="name">Họ và tên *</label>
        <input type="text" id="name" name="name" placeholder="Nhập đầy đủ họ và tên của bạn" required 
        value="<?= isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>">
    </div>
    <div class="form-group">
        <label for="phone">Số điện thoại *</label>
        <input type="text" id="phone" name="phone" placeholder="Nhập số điện thoại của bạn" required 
        value="<?= isset($_POST['phone']) ? htmlspecialchars($_POST['phone']) : ''; ?>">

    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="Nhập email" required 
        value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">

    </div>
    <div class="form-group">
        <label for="note">Ghi chú đơn hàng (tùy chọn)</label>
        <textarea id="note" name="note" placeholder="Ghi chú đơn hàng"><?= isset($_POST['note']) ? htmlspecialchars($_POST['note']) : ''; ?></textarea>
       </div>
    <button type="submit" name="submit_payment" class="order-button">Thanh Toán</button>

      </form>
    </div>
<?php
?>
    <!-- Order Section -->
    <div class="order-section">
      <h2>Đơn hàng của bạn</h2>
      <div class="order-summary">
            <h3>Chi tiết đơn hàng</h3>
            <?php showpayment(); ?>
      </div>
      <?php
      ?>
      <!-- Thêm form mã giảm giá -->
      <div class="discount-section">
        
        <form method="POST" action="payment.php">
          <label for="discount">Nhập mã giảm giá:</label>
          <input type="text" name="discount_code" id="discount" placeholder="Nhập mã giảm giá" required>
          <!-- Giữ lại thông tin người dùng đã nhập -->
          <input type="hidden" name="name" value="<?= isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>">
          <input type="hidden" name="phone" value="<?= isset($_POST['phone']) ? htmlspecialchars($_POST['phone']) : ''; ?>">
          <input type="hidden" name="email" value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
          <input type="hidden" name="note" value="<?= isset($_POST['note']) ? htmlspecialchars($_POST['note']) : ''; ?>">
          <button type="submit" name="apply_discount" value="1" class="discount_button">Áp dụng</button>
        </form>
      </div>

  

  <?php
/// Kiểm tra nếu người dùng đã nhập mã giảm giá
if (isset($_POST['apply_discount']) && !empty($_POST['discount_code'])) {
  $discount_code = $_POST['discount_code'];

  // Kiểm tra mã giảm giá hợp lệ dựa trên gói dịch vụ
  $valid_discount_codes = [];

  // Lấy gói dịch vụ từ session
  $package_name = isset($_SESSION['package']) ? $_SESSION['package'][0] : '';

  // Xác định các mã giảm giá hợp lệ dựa trên gói dịch vụ
  switch ($package_name) {
      case '1 tháng':
          $valid_discount_codes = ['SALE10'];
          break;
      case '3 tháng':
          $valid_discount_codes = ['SALE10', 'SUMMER15'];
          break;
      case '7 tháng':
          $valid_discount_codes = ['SALE10','SUMMER15', 'CHRISTMAS20'];
          break;
      case '12 tháng':
          $valid_discount_codes = ['SALE10','SUMMER15', 'CHRISTMAS20','NEWUSER50'];
          break;
      default:
          // Nếu gói dịch vụ không hợp lệ, không cho áp dụng mã giảm giá
          $valid_discount_codes = [];
          break;
  }

  // Kiểm tra mã giảm giá có hợp lệ trong danh sách hay không
// Kiểm tra mã giảm giá có hợp lệ trong danh sách của gói hiện tại không
if (!in_array($discount_code, $valid_discount_codes)) {
  // Trường hợp mã không hợp lệ cho gói hiện tại nhưng có tồn tại trong cơ sở dữ liệu
  $sql = "SELECT * FROM discount_codes WHERE code = '$discount_code'";
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0) {
      // Nếu mã giảm giá tồn tại nhưng không áp dụng cho gói hiện tại
      echo "<p style='color: red;'>Mã giảm giá không áp dụng cho gói này</p>";
      unset($_SESSION['totalmoney']); // Xóa giá trị cũ
  } else {
      // Nếu mã giảm giá không tồn tại trong cơ sở dữ liệu
      echo "<p style='color: red;'>Mã giảm giá không hợp lệ</p>";
      unset($_SESSION['totalmoney']); // Xóa giá trị cũ
  }
} else {
  // Nếu mã giảm giá nằm trong danh sách hợp lệ
  $sql = "SELECT * FROM discount_codes WHERE code = '$discount_code' AND usage_limit > 0";
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0) {
      $row = mysqli_fetch_assoc($result);
      $discount_percent = $row['discount_percentage'];

      // Giảm số lượng mã sử dụng
      $update_discount = "UPDATE discount_codes SET usage_limit = usage_limit - 1 WHERE code = '$discount_code'";
      mysqli_query($conn, $update_discount);

      echo "<p style='color: green;'>Mã giảm giá hợp lệ! Giảm $discount_percent%</p>";

      // Tính tổng tiền sau khi giảm giá
      $sum = $_SESSION['package'][1];
      $sum_after_percent = $sum - ($sum * $discount_percent / 100);

      // Lưu tổng tiền sau khi giảm giá vào session
      $_SESSION['totalmoney'] = $sum_after_percent;
  } else {
      echo "<p style='color: red;'>Mã giảm giá không hợp lệ hoặc đã hết lượt sử dụng</p>";
      unset($_SESSION['totalmoney']); // Xóa giá trị cũ nếu mã giảm giá không hợp lệ
  }
}

} else {
  unset($_SESSION['totalmoney']); // Xóa giá trị cũ nếu không nhập mã giảm giá
}

// Kiểm tra và gán giá trị tổng tiền
$sum = 0;
if (isset($_SESSION['package']) && is_array($_SESSION['package'])) {
  $sum = $_SESSION['package'][1]; // Lấy giá gói từ session
}

// Nếu có tổng tiền sau giảm giá, ưu tiên sử dụng
if (isset($_SESSION['totalmoney'])) {
  $sum = $_SESSION['totalmoney']; // Cập nhật tổng tiền nếu có mã giảm giá
}
// Hiển thị tổng tiền
echo '<p>Tổng tiền là: <span class="totalPrice">' . number_format($sum, 0) . ' VNĐ</span></p>';

if (isset($_SESSION['end_date'])) {
  echo '<p>Ngày hết hạn: ' . $_SESSION['end_date'] . '</p>';
}


?>

 
      <div class="payment-options">
        <label>
          <input type="radio" name="payment" checked>
          Chuyển khoản ngân hàng
        </label>
        <p class="note">Thực hiện thanh toán vào ngay tài khoản ngân hàng của chúng tôi. Đơn hàng sẽ được giao sau khi tiền đã chuyển.</p>
      </div>



      <p class="note">Thông tin cá nhân của bạn sẽ được sử dụng để xử lý đơn hàng, tăng trải nghiệm sử dụng website, và cho các mục đích khác được mô tả trong chính sách bảo mật của chúng tôi.</p>
    </div>
  </div>
  <script>
    function validateForm() {
      const name = document.getElementById('name').value;
      const email = document.getElementById('email').value;

      if (!name || !email) {
        alert("Vui lòng nhập đầy đủ thông tin.");
        return false;
      }
      return true;
    }
  </script>
</body>
</html>