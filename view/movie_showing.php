<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie Screening</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/showing.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css//movie_showing.css">
    

<?php
    require_once('../model/connect.php');

    // Kiểm tra session trước khi khởi tạo
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }


// Kiểm tra xem người dùng đã đăng nhập hay chưa
$user_id = $_SESSION['user_id'] ?? null;

    
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
}

    // Lấy danh sách phim tương tự small2-container3
    $type = $movie['type'];
    $sql_similar2 = "SELECT movie_id, trailer_url, title FROM movies WHERE type = ? AND movie_id != ?";
    $stmt_similar2 = $conn->prepare($sql_similar2);
    $stmt_similar2->bind_param("si", $type, $movie_id);
    $stmt_similar2->execute();
    $result_similar2 = $stmt_similar2->get_result();


    // Lấy danh sách phim tương tự container4
    $type = $movie['type'];
    $sql_similar1 = "SELECT movie_id, poster_url, title FROM movies WHERE type = ? AND movie_id != ?";
    $stmt_similar1 = $conn->prepare($sql_similar1);
    $stmt_similar1->bind_param("si", $type, $movie_id);
    $stmt_similar1->execute();
    $result_similar1 = $stmt_similar1->get_result();

// Kiểm tra trạng thái yêu thích
    $user_id = $_SESSION['user_id'] ?? 1; // ID user giả định
    $sql_favorite = "SELECT * FROM favorites WHERE user_id = ? AND movie_id = ?";
    $stmt_favorite = $conn->prepare($sql_favorite);
    $stmt_favorite->bind_param("ii", $user_id, $movie_id);
    $stmt_favorite->execute();
    $is_favorite = $stmt_favorite->get_result()->num_rows > 0;

    // Xử lý thêm hoặc xóa yêu thích
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $action = $_POST['action']; // 'add' hoặc 'remove'

        if ($action === 'add') {
            // Thêm yêu thích
            $sql_add = "INSERT INTO favorites (user_id, movie_id) VALUES (?, ?)";
            $stmt_add = $conn->prepare($sql_add);
            $stmt_add->bind_param("ii", $user_id, $movie_id);
            if ($stmt_add->execute()) {
                echo "Đã thêm vào yêu thích!";
            } else {
                echo "Lỗi khi thêm yêu thích: " . $conn->error;
            }
        } elseif ($action === 'remove') {
            // Xóa yêu thích
            $sql_remove = "DELETE FROM favorites WHERE user_id = ? AND movie_id = ?";
            $stmt_remove = $conn->prepare($sql_remove);
            $stmt_remove->bind_param("ii", $user_id, $movie_id);
            if ($stmt_remove->execute()) {
                echo "Đã xóa khỏi yêu thích!";
            } else {
                echo "Lỗi khi xóa yêu thích: " . $conn->error;
            }
        }

        // Làm mới trang sau khi xử lý
        header("Location: {$_SERVER['PHP_SELF']}?id=$movie_id");
        exit();
    }

    // Truy vấn lấy danh sách bình luận
    $sql_comments = "SELECT comments.content, comments.commented_at, users.username, users.avatar
                     FROM comments
                     JOIN users ON comments.user_id = users.user_id
                     WHERE comments.movie_id = ?
                     ORDER BY comments.commented_at DESC";
    $stmt_comments = $conn->prepare($sql_comments);
    $stmt_comments->bind_param("i", $movie_id);
    $stmt_comments->execute();
    $result_comments = $stmt_comments->get_result();



// Xử lý thêm bình luận
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['comment_content'])) {
if (is_null($user_id)) { // Kiểm tra xem user_id có tồn tại không
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



?>

<body class="movieShow">
    <?php include('../model/header.php'); ?>
    <div class="screen">
        <iframe class="video" src="<?php echo htmlspecialchars($movie['thumb_url']); ?>" frameborder="0" allowfullscreen></iframe>
    </div>
    <div class="container2">
        <div class="title">
            <p class="title-main"><?php echo htmlspecialchars($movie['title']); ?></p>
            <p class="title-extra"><?php echo htmlspecialchars($movie['type']); ?></p>
        </div>
        <div class="star-rating">
            <?php for ($i = 1; $i <= 4; $i++) : ?>
                <div class="star"><i class="fa-solid fa-star"></i></div>
            <?php endfor; ?>
            <div class="star"><i class="fa-regular fa-star"></i></div>
        </div>
    </div>

    <div class="big-container3">
        <div class="small1-container3">
            <div class="describe">
                <div class="poster">
                    <img src="<?php echo htmlspecialchars($movie['poster_url']); ?>" alt="">
                    <div class="follow">
                        <form method="POST" action="">
                            <input type="hidden" name="movie_id" value="<?php echo $movie_id; ?>">
                            <input type="hidden" name="action" value="<?php echo $is_favorite ? 'remove' : 'add'; ?>">
                            <button type="submit" class="favorite-btn <?php echo $is_favorite ? 'active' : ''; ?>">
                                <i class="fa-solid fa-heart"></i> 
                                <?php echo $is_favorite ? 'Đã yêu thích' : 'Yêu thích'; ?>
                            </button>
                        </form>
                    </div>
                </div>
                <div class="poster-content">
                    <p class="title-pos-main"><?php echo htmlspecialchars($movie['title']); ?></p>
                    <p class="content"><?php echo htmlspecialchars($movie['description']); ?></p>
                </div>
            </div>
            -------------------------------------------------
            <div class="comment">
                <!-- Form nhập bình luận -->
                <div class="box-cmt1">
                    <div class="box-cmt1">
                        <form method="POST" action=" ">
                            <input type="text" name="comment_content" placeholder="Viết bình luận của bạn..." required>
                            
                            <!-- Ẩn các input movie_id và user_id (được lấy từ session) -->
                            <input type="hidden" name="movie_id" value="<?php echo htmlspecialchars($movie_id); ?>">
                            <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($user_id); ?>">
                            
                            <button class="submit" type="submit">Gửi</button>
                        </form>
                    </div>

                </div>

                <!-- Hiển thị danh sách bình luận -->
                <?php while ($comment = $result_comments->fetch_assoc()): ?>
                    <div class="box-cmt2">
                        <div class="avt">
                            <img src="<?php echo htmlspecialchars($comment['avatar']); ?>" alt="Avatar">
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
        <div class="small2-container3">
            <div class="other">
            <p>Các phim tương tự</p>
            <?php if ($result_similar2->num_rows > 0) : ?>
                <?php while ($similar2 = $result_similar2->fetch_assoc()) : ?>
                    <div class="other_movies">
                        <a href="movie_showing.php?id=<?php echo $similar2['movie_id']; ?>">
                            <img src="<?php echo htmlspecialchars($similar2['trailer_url']); ?>" alt="<?php echo htmlspecialchars($similar2['title']); ?>">
                        </a>
                    </div>
                <?php endwhile; ?>
            <?php else : ?>
                <p>Không có phim tương tự.</p>
            <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="container4">
        <p class="recommend">Có thể bạn muốn xem</p>
            <div class="movies">
            <?php while ($similar1 = $result_similar1->fetch_assoc()) : ?>
                <div>
                <a href="movie_showing.php?id=<?php echo $similar1['movie_id']; ?>">
                    <img src="<?php echo htmlspecialchars($similar1['poster_url']); ?>" alt="<?php echo htmlspecialchars($similar1['title']); ?>">
                </a>
                <p class="recommend-type"><?php echo htmlspecialchars($similar1['title']); ?></p>
            </div>
            <?php endwhile; ?>
            </div>
        
    </div>
    <?php include('../model/footer.php'); ?>
</body>

</html>