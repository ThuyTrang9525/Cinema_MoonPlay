<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include "../model/connect.php";

// Lấy dữ liệu từ form
$search_query = isset($_POST['search_query']) ? trim($_POST['search_query']) : '';

if ($search_query === '') {
    echo "Bạn chưa nhập từ khóa tìm kiếm.";
    exit;
}

// Tìm kiếm trong bảng `movies`
$sql = "
    SELECT * 
    FROM movies 
    WHERE title LIKE ? OR type LIKE ?
    ORDER BY 
        CASE 
            WHEN title LIKE ? THEN 1 -- Ưu tiên tiêu đề khớp trước
            WHEN type LIKE ? THEN 2  -- Sau đó là thể loại
            ELSE 3                   -- Cuối cùng là các kết quả khác
        END
";
$stmt = $conn->prepare($sql);
$search_param = "%" . $search_query . "%";
$stmt->bind_param("ssss", $search_param, $search_param, $search_param, $search_param);
$stmt->execute();
$result = $stmt->get_result();

/*Gợi ý phim*/
$suggest_movies_sql = "
    SELECT * 
    FROM movies 
    WHERE type != (SELECT type FROM movies WHERE title LIKE ? LIMIT 1)
    LIMIT 10
";
$suggest_stmt = $conn->prepare($suggest_movies_sql);
$suggest_stmt->bind_param("s", $search_param);
$suggest_stmt->execute();
$suggest_movies_result = $suggest_stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kết quả tìm kiếm</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/search-back.css">
</head>
<body>
  
    <?php
        include "../model/header.php"
    ?>
    <main>
         <p>Kết quả tìm kiếm của bạn</p>
    
    <?php if ($result->num_rows > 0): ?>
    <div class="movies-list">
        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="movie-item">
                <a href="../model/detail_movie.php? htmlspecialchars($row['movie_id']) ?>">
                    <img src="<?= htmlspecialchars($row['poster_url']) ?>" alt="<?= htmlspecialchars($row['title']) ?>">
                    <h3><?= htmlspecialchars($row['title']) ?></h3>
                </a>
                <input type="checkbox" class="toggle-checkbox" id="toggle-<?= $row['movie_id'] ?>" style="display: none;">
                <div class="movie-description">
                    <?= htmlspecialchars($row['description']) ?>
                </div>
                <label for="toggle-<?= $row['movie_id'] ?>" class="toggle-label">Xem thêm</label>
            </div>
        <?php endwhile; ?>
    </div>
<?php else: ?>
    <p>Không tìm thấy kết quả nào cho từ khóa.</p>
<?php endif; ?>

<?php if ($suggest_movies_result->num_rows > 0): ?>
    <div class="suggest-movies">
        <h2>Hãy tham khảo phim khác</h2>
        <div class="movies-list">
            <?php while ($row = $suggest_movies_result->fetch_assoc()): ?>
                <div class="movie-item">
                    <a href="../model/detail_movie.php?id=<?= htmlspecialchars($row['movie_id']) ?>">
                        <img src="<?= htmlspecialchars($row['poster_url']) ?>" alt="<?= htmlspecialchars($row['title']) ?>">
                        <h3><?= htmlspecialchars($row['title']) ?></h3>
                    </a>
                    <input type="checkbox" class="toggle-checkbox" id="toggle-<?= $row['movie_id'] ?>-suggest" style="display: none;">
                    <div class="movie-description">
                        <?= htmlspecialchars($row['description']) ?>
                    </div>
                    <label for="toggle-<?= $row['movie_id'] ?>-suggest" class="toggle-label">Xem thêm</label>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
<?php endif; ?>
    </main>

     <!-- footer -->
        <?php include("../model/footer.php"); ?>
    <!-- /footer -->

</body>
</html>

<?php
// Đóng kết nối
$stmt->close();
$conn->close();
?>
