<link rel="stylesheet" href="../assets/css/style.css">
<header class="header">
        <div class="header-logo">
            <img src="../assets/image/logo.png" alt="Logo">
        </div>

        <nav>
            <ul class="header-left">
                <li><a href="#">Trang chủ</a></li>
                <li><a href="#">Kho phim</a></li>
                <li><a href="#">Khuyến mãi</a></li>
                <li><a href="#">Yêu thích</a></li>
                <li><a href="#">Liên hệ</a></li>
            </ul>
        </nav>

        <div class="header-right">
            <form method="POST" action="/controllers/search-back.php">
                <input type="text" name="search_query" placeholder="Nhập tên phim cần tìm..." required>
                <button type="submit">Tìm kiếm</button>
            </form>
            <button class="login-btn">Đăng nhập</button>
        </div>
    </header>
