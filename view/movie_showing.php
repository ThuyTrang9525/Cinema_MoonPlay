<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie Screening</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        body.movieShow {
            background-color: black;
            color: #fff;
        }
        .video {
            width: 100%;
            height: auto;
            border-radius: 10px;
            margin-bottom: 20px;
        }
        .comment .box-cmt2 {
            display: flex;
            align-items: flex-start;
            margin-bottom: 10px;
        }
        .comment .box-cmt2 .avt img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            margin-right: 10px;
        }
        .comment .box-cmt2 .commented {
            flex: 1;
            background-color: #333;
            padding: 10px;
            border-radius: 8px;
        }
        .comment .box-cmt2 .commented .name {
            font-weight: bold;
        }
        .video {
            width: 100%; /* Chiều ngang 100% */
            height: 100%; /* Tự động điều chỉnh chiều cao theo tỷ lệ khung hình */
            border-radius: 10px; /* Tùy chọn: bo tròn các góc */
            margin-bottom: 20px; /* Khoảng cách dưới */
        }
        
</style>

<?php
require_once('../model/connect.php');
session_start();

// Lấy ID phim từ URL
if (isset($_GET['id'])) {
    $movie_id = intval($_GET['id']);

    // Lấy thông tin phim
    $sql_movie = "SELECT * FROM movies WHERE movie_id = ?";
    $stmt_movie = $conn->prepare($sql_movie);
    $stmt_movie->bind_param("i", $movie_id);
    $stmt_movie->execute();
    $result_movie = $stmt_movie->get_result();

    if ($result_movie->num_rows > 0) {
        $movie = $result_movie->fetch_assoc();
    } else {
        die("Không tìm thấy phim.");
    }

    // Lấy danh sách phim tương tự
    $type = $movie['type'];
    $sql_similar = "SELECT movie_id, poster_url, title FROM movies WHERE type = ? AND movie_id != ?";
    $stmt_similar = $conn->prepare($sql_similar);
    $stmt_similar->bind_param("si", $type, $movie_id);
    $stmt_similar->execute();
    $result_similar = $stmt_similar->get_result();

    // Kiểm tra trạng thái yêu thích
    $user_id = $_SESSION['user_id'] ?? 1; // ID user giả định
    $sql_favorite = "SELECT * FROM favorites WHERE user_id = ? AND movie_id = ?";
    $stmt_favorite = $conn->prepare($sql_favorite);
    $stmt_favorite->bind_param("ii", $user_id, $movie_id);
    $stmt_favorite->execute();
    $is_favorite = $stmt_favorite->get_result()->num_rows > 0;

    // Lấy danh sách bình luận
    $sql_comments = "
        SELECT comments.content, comments.commented_at, users.username, users.avatar
        FROM comments 
        JOIN users ON comments.user_id = users.user_id 
        WHERE comments.movie_id = ?
    ";
    $stmt_comments = $conn->prepare($sql_comments);
    $stmt_comments->bind_param("i", $movie_id);
    $stmt_comments->execute();
    $result_comments = $stmt_comments->get_result();

    // Xử lý thêm bình luận
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['comment_content'])) {
        if (!isset($_SESSION['user_id'])) {
            die("Bạn cần đăng nhập để bình luận.");
        }
        $content = trim($_POST['comment_content']);
        if (!empty($content)) {
            $sql_insert_comment = "INSERT INTO comments (movie_id, user_id, content) VALUES (?, ?, ?)";
            $stmt_insert = $conn->prepare($sql_insert_comment);
            $stmt_insert->bind_param("iis", $movie_id, $user_id, $content);
            $stmt_insert->execute();
            header("Location: movie_showing.php?id=$movie_id");
            exit();
        }
    }
} else {
    die("Không có thông tin phim.");
}
?>

<body class="movieShow">
    <?php include('../model/header.php'); ?>
    <div class="container1">
        <div class="screen">
            <iframe class="video" src="<?php echo htmlspecialchars($movie['thumb_url']); ?>" frameborder="0" allowfullscreen></iframe>
        </div>
        <div class="other">
            <p>Các phim tương tự</p>
            <?php if ($result_similar->num_rows > 0) : ?>
                <?php while ($similar = $result_similar->fetch_assoc()) : ?>
                    <div class="other_movies">
                        <a href="movie_showing.php?id=<?php echo $similar['movie_id']; ?>">
                            <img src="<?php echo htmlspecialchars($similar['poster_url']); ?>" alt="<?php echo htmlspecialchars($similar['title']); ?>">
                        </a>
                    </div>
                <?php endwhile; ?>
            <?php else : ?>
                <p>Không có phim tương tự.</p>
            <?php endif; ?>
        </div>
    </div>

    <div class="big-container3">
        <div class="poster">
            <img src="<?php echo htmlspecialchars($movie['poster_url']); ?>" alt="">
            <div class="follow">
                <form method="POST" action="">
                    <input type="hidden" name="movie_id" value="<?php echo $movie_id; ?>">
                    <input type="hidden" name="action" value="<?php echo $is_favorite ? 'remove' : 'add'; ?>">
                    <button type="submit" class="favorite-btn <?php echo $is_favorite ? 'active' : ''; ?>">
                        <i class="fa-solid fa-heart"></i> <?php echo $is_favorite ? 'Đã theo dõi' : 'Theo dõi'; ?>
                    </button>
                </form>
            </div>
        </div>
        <div class="comment">
            <div class="box-cmt1">
                <form method="POST">
                    <input type="text" name="comment_content" placeholder="Viết bình luận của bạn..." required>
                    <button class="submit" type="submit">Gửi</button>
                </form>
            </div>
            <?php while ($comment = $result_comments->fetch_assoc()): ?>
                <div class="box-cmt2">
                    <div class="avt">
                        <img src="<?php echo htmlspecialchars($comment['avatar_url']); ?>" alt="">
                    </div>
                    <div class="commented">
                        <p class="name"><?php echo htmlspecialchars($comment['username']); ?></p>
                        <p class="cmt"><?php echo htmlspecialchars($comment['content']); ?></p>
                        <small><?php echo htmlspecialchars($comment['commented_at']); ?></small>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
    <?php include('../model/footer.php'); ?>
</body>

</html>