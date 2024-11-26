<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

    <!-- Header -->
     <?php include('../model/header.php'); ?>

     <!-- Main content -->
    <main>
        <section class="intro">
            <h2>MoonPlay</h2>
            <p>Chào mừng bạn đến với MoonPlay - nơi bạn có thể khám phá thế giới tuyệt vời của điện ảnh và trải nghiệm
                những bộ phim đẹp và đầy cảm xúc. Với một thư viện phong phú chứa đựng hàng ngàn tác phẩm từ mọi thể
                loại, chúng tôi mang đến cho bạn những giờ phút thư giãn và hứng khởi.</p>
        
        </section>
        <h3>Lịch sử xem phim</h3>
        <div class="options">
            <ul class="category-list">
                <li data-value="">Tất cả</li>
                <li data-value="horror">Kinh dị</li>
                <li data-value="comedy">Hài</li>
                <li data-value="korean">Tình cảm</li>
                <li data-value="animation">Hoạt hình</li>
                <li data-value="sci-fi">Khoa học viễn tưởng</li>
                <li data-value="nature">Phim tài liệu thiên nhiên</li>
            </ul>
        </div>

        <div class="lich_su_xem">
            <h3>Gần đây nhất</h3>
            <div class="card-container">
                <!-- Movie Card -->
                <div class="card">
                    <img src="../assets/image/Hình ảnh/chichiemem 1.jpg" alt="Đào, Phở và Piano">
                    <h3>Đào, Phở và Piano</h3>
                    <p>Đã xem tới 21:45</p>
                    <p>8/11/2024 12:04</p>
                </div>

                <!-- Repeat the card structure for each movie -->
                <div class="card">
                    <img src="../assets/image/Hình ảnh/chichiemem 3.jpg" alt="Đào, Phở và Piano">
                    <h3>Đào, Phở và Piano</h3>
                    <p>Đã xem tới 21:45</p>
                    <p>8/11/2024 12:04</p>
                </div>

                <div class="card">
                    <img src="../assets/image/Hình ảnh/chichiemem 2.jpg" alt="Đào, Phở và Piano">
                    <h3>Đào, Phở và Piano</h3>
                    <p>Đã xem tới 21:45</p>
                    <p>8/11/2024 12:04</p>
                </div>

                <div class="card">
                    <img src="../assets/image/Hình ảnh/image 32.jpg" alt="Đào, Phở và Piano">
                    <h3>Đào, Phở và Piano</h3>
                    <p>Đã xem tới 21:45</p>
                    <p>8/11/2024 12:04</p>
                </div>

                <div class="card">


                    <img src="../assets/image/Hình ảnh/image 52.jpg" alt="Đào, Phở và Piano">
                    <h3>Đào, Phở và Piano</h3>
                    <p>Đã xem tới 21:45</p>
                    <p>8/11/2024 12:04</p>
                </div>

                <div class="card">
                    <img src="../assets/image/Hình ảnh/image 50.jpg" alt="Đào, Phở và Piano">
                    <h3>Đào, Phở và Piano</h3>
                    <p>Đã xem hết</p>
                    <p>8/11/2024 12:04</p>
                </div>

                <div class="card">
                    <img src="../assets/image/Hình ảnh/image 7.jpg" alt="Đào, Phở và Piano">
                    <h3>Đào, Phở và Piano</h3>
                    <p>Đã xem tới 21:45</p>
                    <p>8/11/2024 12:04</p>
                </div>
            </div>
        </div>
    </main>

     <!-- Footer -->
    <?php include('../model/footer.php'); ?>
    
</body>
</html>