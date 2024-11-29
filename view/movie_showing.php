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

        // Lấy ID phim từ URL
        if (isset($_GET['id'])) {
            $movie_id = intval($_GET['id']);
        } else {
            die("Không tìm thấy ID phim.");
        }

        // Truy vấn thông tin chi tiết phim
        $sql = "SELECT * FROM movies WHERE movie_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $movie_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $movie = $result->fetch_assoc();
        } else {
            die("Không tìm thấy phim.");
        }

        // Lấy danh sách bình luận
        $sql_comments = "
            SELECT comments.content, comments.commented_at, users.username, users.avatar_url 
            FROM comments 
            JOIN users ON comments.user_id = users.user_id 
            WHERE comments.movie_id = ? 
            ORDER BY comments.commented_at DESC
        ";
        $stmt_comments = $conn->prepare($sql_comments);
        $stmt_comments->bind_param("i", $movie_id);
        $stmt_comments->execute();
        $result_comments = $stmt_comments->get_result();

        // Xử lý thêm bình luận
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['comment'])) {
            $user_id = 1; // ID user giả định (có thể lấy từ session khi làm hệ thống login)
            $content = trim($_POST['comment']);

            if (!empty($content)) {
                $sql_insert_comment = "INSERT INTO comments (movie_id, user_id, content) VALUES (?, ?, ?)";
                $stmt_insert = $conn->prepare($sql_insert_comment);
                $stmt_insert->bind_param("iis", $movie_id, $user_id, $content);
                $stmt_insert->execute();
                header("Location: movie_show.php?id=$movie_id");
                exit();
            }
        }
    ?>
</head>
<body class="movieShow">
    <?php include('../model/header.php'); ?>
    <div class="container1">
        <div class="screen">
            <video controls class="video" src="<?php echo htmlspecialchars($movie['thumb_url']); ?>" type="video/mp4"></video>
        </div>

        <div class="other">
            <div><p>Các phim tương tự</p></div>
            <div class="other_movies"><img src="<?php echo htmlspecialchars($movie['trailer_url']); ?>" alt=""></div>
            <div class="other_movies"><img src="<?php echo htmlspecialchars($movie['trailer_url']); ?>" alt=""></div>
            <div class="other_movies"><img src="<?php echo htmlspecialchars($movie['trailer_url']); ?>" alt=""></div>
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
                        <a href="#"><i class="fa-solid fa-heart"></i> Theo dõi</a>
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
                    <input type="text" name="comment" placeholder="Viết bình luận của bạn..." required>
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
            <div><img src="<?php echo htmlspecialchars($movie['poster_url']); ?>" alt=""></div>
            <div><img src="<?php echo htmlspecialchars($movie['poster_url']); ?>"  alt=""></div>
            <div><img src="<?php echo htmlspecialchars($movie['poster_url']); ?>"  alt=""></div>
            <div><img src="<?php echo htmlspecialchars($movie['poster_url']); ?>"  alt=""></div>
        </div>
    </div>
    <!-- Footer -->
    <?php include('../model/footer.php'); ?>
</body>
</html>