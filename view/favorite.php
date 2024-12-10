<?php
session_start();

// Kết nối cơ sở dữ liệu
include('../model/connect.php'); // Đảm bảo file kết nối được gọi

// Kiểm tra session trước khi khởi tạo
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Kiểm tra xem người dùng đã đăng nhập hay chưa
$user_id = $_SESSION['user_id'] ?? null;
if (is_null($user_id)) {
    die("Bạn chưa đăng nhập.");
}

// Truy vấn để lấy danh sách phim yêu thích
$sql = "
    SELECT m.movie_id, m.title, m.poster_url, m.description
    FROM favorites f
    INNER JOIN movies m ON f.movie_id = m.movie_id
    WHERE f.user_id = ?
";
$stmt = $conn->prepare($sql);
if (!$stmt) {
    die("Lỗi khi chuẩn bị truy vấn: " . $conn->error);
}
$stmt->bind_param("i", $user_id);
if (!$stmt->execute()) {
    die("Lỗi khi thực thi truy vấn: " . $stmt->error);
}
$result = $stmt->get_result();

// Lưu danh sách phim
$movies = $result->fetch_all(MYSQLI_ASSOC);
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách yêu thích</title>
    <link rel="stylesheet" href="../assets/css/history.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <?php
        include "../model/header.php"
    ?>
    <div class="lich_su_xem">
        <h3>Danh sách yêu thích của bạn</h3>
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
                <p>Không có phim nào trong danh sách yêu thích.</p>
            <?php endif; ?>
        </div>
    </div>

    <?php
        include "../model/footer.php"
    ?>
    
</body>
</html>
