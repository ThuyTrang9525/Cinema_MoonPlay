<?php
session_start();
// Kiểm tra xem người dùng đã đăng nhập hay chưa
$isLoggedIn = isset($_SESSION['user_id']) && isset($_SESSION['username']);
$username = $isLoggedIn ? $_SESSION['username'] : null;
 
// var_dump($isLoggedIn, $username); 

?>

<link rel="stylesheet" href="../assets/css/header.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
<header class="header">
    <div class="header-logo">
        <img src="../assets/image/logo.png" alt="Logo">
    </div>

    <nav class="list">
        <ul class="header-left">
            <li><a href="../view/Intro.php">Giới thiệu</a></li>
            <li><a href="../view/main.php">Trang chủ</a></li>
            <li><a href="../model/category.php">Kho phim</a></li>
            <li><a href="../view/package.php">Các gói</a></li>
            <li><a href="#">Yêu thích</a></li>
            <li><a href="../view/histori.php">Lịch sử</a></li>
            <li><a href="../view/contact.php">Liên hệ</a></li>
        </ul>
        <div class="header-right">
            <form method="POST" action="../controllers/search-back.php">
                <div class="container-search" style="position: relative;">
                <input style="border:2px grey solid;width:250px;height: 50px; border-radius: 100px;" type="text" name="search_query" placeholder="Nhập tên phim cần tìm..." required>
                    <div style="height: 47px; align-items:center;border-radius:100px; position: absolute;bottom: 2px; right:0px;width: 47px; background-color: #222222;">
                        <i style=" font-size: 20px; color:grey; margin-top:13px; margin-left: 14px;" class="fas fa-search"></i>
                    </div>
                </div>
                <button style="border:2px grey solid; height:50px; width:100px; font-size: 15px;border-radius: 100px;" type="submit">Tìm kiếm</button>
            </form>
        </div>
        <?php 
            // Kiểm tra trạng thái đăng nhập
        if ($isLoggedIn): ?>
                <!-- Hiển thị thông tin người dùng nếu đã đăng nhập -->
                <div class="user-info" style="margin-top: 15px; font-size: 18px;">
                    <i><a href="../view/profile.php" class="fa fa-user" style="font-size: 20px; color: white;"></a></i>
                </div>
            <?php else: ?>
                <!-- Nút đăng nhập nếu chưa đăng nhập -->
                <button class="login-btn" id="loginButton">Đăng nhập</button>
            <?php endif; 
            ?>
    </nav>
    <div class = "logout-button"><a href="../view/login.php"><i class="fa-solid fa-right-from-bracket"></i></a></div>    
</header>
    <script>
    document.getElementById('loginButton').addEventListener('click', function() {
        window.location.href = '../view/login.php'; // Đường dẫn tới trang đăng nhập
    });
</script>

