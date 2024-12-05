<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Kiểm tra xem người dùng đã đăng nhập hay chưa
$isLoggedIn = isset($_SESSION['user_id']);
$isLoggedIn = isset($_SESSION['username']);
// $username = $isLoggedIn ? $_SESSION['username'] : null;
?>

<link rel="stylesheet" href="../assets/css/style.css<?php echo time(); ?>">
<header class="header">
    <div class="header-logo">
        <img src="../assets/image/logo.png" alt="Logo">
    </div>

    <nav class="list">
        <ul class="header-left">
            <li><a href="../view/Intro.php">Giới thiệu</a></li>
            <li><a href="../view/main.php">Trang chủ</a></li>
            <li><a href="../model/category.php">Kho phim</a></li>
            <li><a href="../model/voucher.php">Khuyến mãi</a></li>
            <li><a href="#">Yêu thích</a></li>
            <li><a href="../view/histori.php">Lịch sử</a></li>
            <li><a href="../view/contact.php">Liên hệ</a></li>
        </ul>
        <?php 
            // Kiểm tra trạng thái đăng nhập
           if ($isLoggedIn): ?>
                <!-- Hiển thị thông tin người dùng nếu đã đăng nhập -->
                <div class="user-info" style="margin-top: 15px; font-size: 18px;">
                    <i><a href="../view/profile.php" class="fas fa-user" style="font-size: 20px; color: white;"></a></i>
                    <span> <a href="../view/profile.php"> </a></span>
                </div>
            <?php else: ?>
                <!-- Nút đăng nhập nếu chưa đăng nhập -->
                <button class="login-btn" id="loginButton">Đăng nhập</button>
            <?php endif; 
            ?>
    </nav>    
</header>
    <div class="header-right">
        <form method="POST" action="../controllers/search-back.php">
            <input type="text" name="search_query" placeholder="Nhập tên phim cần tìm..." required>
            <button type="submit">Tìm kiếm</button>
        </form>
        
    </div>
    <script>
    document.getElementById('loginButton').addEventListener('click', function() {
        window.location.href = '../view/login.php'; // Đường dẫn tới trang đăng nhập
    });
</script>

