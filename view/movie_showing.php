<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie Screening</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        body.movieShow{
            background-color: black;
        }
    </style>
    <?php
    require_once('../model/connect.php');

    // Kiểm tra và lấy ID phim từ URL
    if (isset($_GET['id'])) {
        $movie_id = intval($_GET['id']);
    } 
    else {
        die("Không tìm thấy ID phim.");
    }

    // Lấy thông tin chi tiết phim
    $sql = "SELECT * FROM movies WHERE movie_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $movie_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $movie = $result->fetch_assoc();
    } 
    else {
        die("Không tìm thấy phim.");
    }

    // Lấy danh sách phim liên quan container1
    $sql_related1 = "SELECT * FROM movies WHERE type = ? AND movie_id != ? LIMIT 3";
    $stmt_related1 = $conn->prepare($sql_related1);
    $stmt_related1->bind_param("i", $movie_id);
    $stmt_related1->execute();
    $result_related1 = $stmt_related1->get_result();
    
    // Lấy danh sách phim liên quan 
    $sql_related = "SELECT * FROM movies WHERE type = ? AND movie_id != ? LIMIT 4";
    $stmt_related = $conn->prepare($sql_related);
    $stmt_related->bind_param("si", $movie['type'], $movie_id);
    $stmt_related->execute();
    $result_related = $stmt_related->get_result();


    // Kiểm tra trạng thái yêu thích
    $user_id = 1; // ID user giả định (thay bằng ID từ session)
    $sql_favorite = "SELECT * FROM favorites WHERE user_id = ? AND movie_id = ?";
    $stmt_favorite = $conn->prepare($sql_favorite);
    $stmt_favorite->bind_param("ii", $user_id, $movie_id);
    $stmt_favorite->execute();
    $is_favorite = $stmt_favorite->get_result()->num_rows > 0;

    // Xử lý thêm hoặc xóa yêu thích
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action'])) {
        $action = $_POST['action'];

        if ($action == 'add') {
            $sql_add_favorite = "INSERT INTO favorites (user_id, movie_id) VALUES (?, ?)";
            $stmt_add = $conn->prepare($sql_add_favorite);
            $stmt_add->bind_param("ii", $user_id, $movie_id);
            $stmt_add->execute();
        } 
        elseif ($action == 'remove') {
            $sql_remove_favorite = "DELETE FROM favorites WHERE user_id = ? AND movie_id = ?";
            $stmt_remove = $conn->prepare($sql_remove_favorite);
            $stmt_remove->bind_param("ii", $user_id, $movie_id);
            $stmt_remove->execute();
        }
        header("Location: movie_showing.php?id=$movie_id");
        exit();
    }

    // Lấy danh sách bình luận
    $sql_comments = "
        SELECT comments.content, comments.commented_at, users.username, users.avatar_url 
        FROM comments 
        JOIN users ON comments.user_id = users.user_id 
        WHERE comments.movie_id = ? 
        ORDER BY comments.commented_at DESC ";
    $stmt_comments = $conn->prepare($sql_comments);
    $stmt_comments->bind_param("i", $movie_id);
    $stmt_comments->execute();
    $result_comments = $stmt_comments->get_result();

    // Xử lý thêm bình luận
    $error_message = '';
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['comment_content'])) {
        $content = htmlspecialchars(trim($_POST['comment_content']));
        if (!empty($content)) {
            $sql_insert_comment = "INSERT INTO comments (movie_id, user_id, content) VALUES (?, ?, ?)";
            $stmt_insert = $conn->prepare($sql_insert_comment);
            $stmt_insert->bind_param("iis", $movie_id, $user_id, $content);
            $stmt_insert->execute();
            header("Location: movie_showing.php?id=$movie_id");
            exit();
        } 
        else {
            $error_message = 'Nội dung bình luận không được để trống.';
        }
    }
    
?>
</head>
<body class="movieShow">
    <!-- header -->
    <?php include('../model/header.php'); ?>
    <div class="container1">
        <div class="screen">
            <video controls class="video" src="<?php echo htmlspecialchars($movie['thumb_url']); ?>" type="video/mp4"></video>
        </div>

        <div class="other">
            <div><p>Các phim tương tự</p></div>
            <?php while ($related1 = $result_related1->fetch_assoc()): ?>
            <div class="other_movies">
                <img src="<?php echo htmlspecialchars($related1['poster_url']); ?>" alt="<?php echo htmlspecialchars($related1['title']); ?>">
            </div>
            <?php endwhile; ?>
        </div>
    </div>
    
    <div class="container2">
        <div class="title">
            <p class="title-main"><?php echo htmlspecialchars($movie['title']); ?></p>
            <p class="title-extra"><?php echo htmlspecialchars($movie['type']); ?></p>
        </div>
        <div class="star-rating">
            <div class="star"><i class="fa-solid fa-star"></i></div>
            <div class="star"><i class="fa-solid fa-star"></i></div>
            <div class="star"><i class="fa-solid fa-star"></i></div>
            <div class="star"><i class="fa-solid fa-star"></i></div>
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
                                <i class="fa-solid fa-heart"></i> <?php echo $is_favorite ? 'Đã theo dõi' : 'Theo dõi'; ?>
                            </button>
                        </form>
                    </div>
                </div>
                <div class="poster-content">
                    <div class="title-poster">
                        <p class="title-pos-main"><?php echo htmlspecialchars($movie['title']); ?></p>
                        <p class="title-pos-extra"><?php echo htmlspecialchars($movie['type']); ?></p>
                    </div>
                    <div>
                        <p class="content">
                        <?php echo htmlspecialchars($movie['description']); ?>
                        </p>
                    </div>
                </div>
            </div>
            <!-- Form thêm bình luận -->
        <div class="comment">
            <div class="box-cmt1">
                <form method="POST">
                    <input type="text" name="comment_content" placeholder="Viết bình luận của bạn..." required>
                    <button class="submit" type="submit">Gửi</button>
                </form>
            </div>
            <!-- Hiển thị bình luận -->
            <?php while ($comment = $result_comments->fetch_assoc()) : ?>
                <div class="box-cmt2">
                    <div class="fill-cmt2">
                        <div class="avt">
                            <img src="<?php echo htmlspecialchars($comment['avatar']); ?>" alt="">
                        </div>
                        <div class="commented">
                            <p class="name"><?php echo htmlspecialchars($comment['username']); ?></p>
                            <p class="cmt"><?php echo htmlspecialchars($comment['content']); ?></p>
                            <small><?php echo htmlspecialchars($comment['commented_at']); ?></small> 
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
        <div  class="small2-container3">
            <div class="other">
                <div><p>Các phim tương tự</p></div>
                <div class="other_movies"><img src="<?php echo htmlspecialchars($movie['trailer_url']); ?>" alt=""></div>
                <div class="other_movies"><img src="<?php echo htmlspecialchars($movie['trailer_url']); ?>" alt=""></div>
                <div class="other_movies"><img src="<?php echo htmlspecialchars($movie['trailer_url']); ?>" alt=""></div>
                <div class="other_movies"><img src="<?php echo htmlspecialchars($movie['trailer_url']); ?>" alt=""></div>
            </div>
        </div>
    </div>
    <div class="container4">
        <p class="recommend">Có thể bạn muốn xem</p>
        <div class="movies">
        <?php while ($related = $result_related->fetch_assoc()): ?>
            <div>
                <img src="<?php echo htmlspecialchars($related['poster_url']); ?>" alt="<?php echo htmlspecialchars($related['title']); ?>">
                <p><?php echo htmlspecialchars($related['title']); ?></p>
            </div>
        <?php endwhile; ?>
        </div>
    </div>
    <!-- Footer -->
    <?php include('../model/footer.php'); ?>
</body>
</html>