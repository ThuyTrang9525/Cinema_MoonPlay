
<?php
// Bao gồm file xử lý
include('../controllers/history-back.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MoonPlay - Lịch sử xem phim</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/history.css">
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
            <form method="GET" action="">
                <input type="hidden" name="type" value="">
                <button type="submit">Tất cả</button>
            </form>
            <form method="GET" action="">
                <input type="hidden" name="type" value="Phim kinh dị">
                <button type="submit">Kinh dị</button>
            </form>
            <form method="GET" action="">
                <input type="hidden" name="type" value="Phim hài">
                <button type="submit">Hài</button>
            </form>
            <form method="GET" action="">
                <input type="hidden" name="type" value="Phim tình cảm">
                <button type="submit">Tình cảm</button>
            </form>
            <form method="GET" action="">
                <input type="hidden" name="type" value="Phim hoạt hình">
                <button type="submit">Hoạt hình</button>
            </form>
            <form method="GET" action="">
                <input type="hidden" name="type" value="Khoa học viễn tưởng">
                <button type="submit">Khoa học viễn tưởng</button>
            </form>
        </div>

        <div class="lich_su_xem">
            <h3>Gần đây nhất</h3>
            <div class="card-container">
                <?php if (!empty($movies)): ?>
                    <?php foreach ($movies as $movie): ?>
                        <div class="card">
                           <a href="../model/detail_movie.php?movie_id=<?= htmlspecialchars($movie['movie_id']) ?>">
                                <img src="<?= htmlspecialchars($movie['poster_url']) ?>" alt="<?= htmlspecialchars($movie['title']) ?>">
                                <h3><?= htmlspecialchars($movie['title']) ?></h3>
                            </a>

                            <!-- Checkbox ẩn để kiểm soát trạng thái -->
                            <input type="checkbox" id="toggle-<?= $movie['movie_id'] ?>" class="toggle-checkbox" style="display: none;">

                            <!-- Mô tả phim -->
                            <div class="movie-description">
                                <?= htmlspecialchars($movie['description']) ?>
                            </div>

                            <!-- Nhãn "Xem thêm" liên kết với checkbox -->
                            <label for="toggle-<?= $movie['movie_id'] ?>" class="toggle-label">Xem thêm</label>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>Không có dữ liệu phim.</p>
                <?php endif; ?>
            </div>
        </div>

    </main>

    <!-- Footer -->
    <?php include('../model/footer.php'); ?>
</body>
</html>
