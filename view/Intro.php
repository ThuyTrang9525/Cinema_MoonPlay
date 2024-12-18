<?php
// Khởi tạo session
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

// Kiểm tra xem người dùng đã đăng nhập hay chưa
$user_id = $_SESSION['user_id'] ?? null;
?>



<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Giới Thiệu MoonPlay Cinema  </title>
  <link rel="stylesheet" href="../assets/css/intro.css">
  <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
<?php include('../model/header.php'); ?>
  <!-- Hero Section -->
  <section class="hero">
    <h1>MoonPlay Cinema - Nền tảng xem phim trực tuyến hàng đầu!</h1>
    <p>Thưởng thức những bộ phim chất lượng cao mọi lúc, mọi nơi.</p>
    <a href="../model/category.php" class="cta-button">Khám Phá Ngay</a>
  </section>

  <!-- Giới thiệu -->
  <section class="about">
    <h2>Về MoonPlay Cinema</h2>
    <p>MoonPlay Cinema được xây dựng với mục tiêu mang đến trải nghiệm xem phim chất lượng cao cho mọi người. Chúng tôi tự hào là nền tảng phim trực tuyến đa dạng, hiện đại và thân thiện với người dùng. Bạn có thể dễ dàng tìm kiếm và xem các bộ phim yêu thích bất cứ lúc nào.</p>
  </section>

  <!-- Đặc điểm nổi bật -->
  <section class="features">
    <div class="feature-item">
      <h3>Kho Phim Đa Dạng</h3>
      <p>Hơn 10,000+ bộ phim từ khắp nơi trên thế giới, bao gồm cả phim lẻ, phim bộ, phim chiếu rạp và hoạt hình.</p>
    </div>
    <div class="feature-item">
      <h3>Chất Lượng Đỉnh Cao</h3>
      <p>Phim chất lượng 4K, âm thanh sống động, không quảng cáo gây gián đoạn.</p>
    </div>
    <div class="feature-item">
      <h3>Hỗ Trợ 24/7</h3>
      <p>Đội ngũ hỗ trợ khách hàng luôn sẵn sàng giải đáp mọi thắc mắc và giúp đỡ bạn sử dụng nền tảng hiệu quả nhất.</p>
    </div>
  </section>

  <!-- Đội ngũ -->
  <section class="team">
    <h2>Đội Ngũ Của Chúng Tôi</h2>
    <div class="team-members">
      <div class="member">
        <img src="../assets/image/Hình ảnh/Kim.jpg" alt="Thành viên 1">
        <h3>Hồ Thị kim</h3>
      </div>

      <div class="member">
        <img src="../assets/image/Hình ảnh/Thiện.jpg" alt="Thành viên 2">
        <h3>Hồ Đức Thiện</h3>
      </div>
      <div class="member">
        <img src="../assets/image/Hình ảnh/Hà.img.jpg" alt="Thành viên 4">
        <h3>Hồ Thị Duyên Hà</h3>
      </div>

      <div class="member">
        <img src="../assets/image/Hình ảnh/On.jpg" alt="Thành viên 5">
        <h3>Hồ Thị Ơn</h3>
      </div>
      
      <div class="member">
        <img src="../assets/image/Hình ảnh/Trang.img.jpg" alt="Thành viên 3">
        <h3>Bùi Thị Thùy Trang</h3>
      </div>
    </div>
  </section>

<section class="faq">
  <h2>Câu Hỏi Thường Gặp (FAQ)</h2>
  <div class="faq-item">
    <h3>1. Làm thế nào để đăng ký tài khoản?</h3>
    <p>Để đăng ký tài khoản, bạn chỉ cần nhấn vào nút "Đăng Ký" trên trang chủ và điền thông tin cá nhân của bạn.</p>
  </div>
  <div class="faq-item">
    <h3>2. Tôi có thể xem phim trên những thiết bị nào?</h3>
    <p>MyMovie hỗ trợ xem phim trên mọi thiết bị như máy tính, điện thoại di động, TV thông minh và máy tính bảng.</p>
  </div>
  <div class="faq-item">
    <h3>3. Làm thế nào để thanh toán dịch vụ?</h3>
    <p>Chúng tôi chấp nhận nhiều hình thức thanh toán, bao gồm thẻ tín dụng, ví điện tử và chuyển khoản ngân hàng.</p>
  </div>
  <div class="faq-item">
    <h3>4. Có hỗ trợ khách hàng trực tuyến không?</h3>
    <p>Có, chúng tôi cung cấp hỗ trợ khách hàng trực tuyến qua hotline. Chúng tôi sẽ hỗ trợ bạn 24/7.</p>
  </div>
  <div class="faq-item">
    <h3>5. Làm thế nào để báo cáo nội dung không phù hợp?</h3>
    <p>Nếu bạn phát hiện nội dung không phù hợp, vui lòng liên hệ trực tiếp với chúng tôi qua email hỗ trợ. Chúng tôi sẽ xem xét và xử lý nhanh chóng</p>
  </div>
  <div class="faq-item">
    <h3>6. Có thời gian dùng thử miễn phí không?</h3>
    <p>Hiện tại chúng tôi chưa cung cấp thời gian dùng thử miễn phí cho người dùng mới. Bạn có thể đăng ký tài khoản và mua gói dịch vụ để có thể xem tất cả các bộ phim</p>
  </div>
</section>

  <?php include('../model/footer.php'); ?>
</body>
</html>
