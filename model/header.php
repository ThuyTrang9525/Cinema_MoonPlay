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
            <li><a href="../view/history.php">Lịch sử</a></li>
            <li><a href="../view/contact.php">Liên hệ</a></li>
        </ul>
        <button class="login-btn" id="loginButton">Đăng nhập</button>
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

