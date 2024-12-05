<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie Screening</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        body.movieShow {
            background-color: black;
            color: #fff;
        }
        .screen {
            width: 100%;
            height: 700px;
        }
        .video {
            width: 100%;
            height: 100%;
            border-radius: 10px;
        }
        

        /* container2 */
        .container2 {
            display: flex;
            color: aliceblue;
            padding: 30px;
        }

        .container2 .title {
            color: aliceblue;
            margin: 0px;
        }
        .title-main {
            font-size: 50px;
            margin: 0;
            padding-right: 80px ;
            font-weight: bold;
        }
        .title-extra {
            font-size: 26px;

        }


        .star-rating {
            display: flex;
            color: yellow;
            padding-top: 15px;

        }
        .star i {
            font-size: 40px;
            padding-right: 10px;
        }

        /* Big container3 */
        .big-container3 {
            display: flex;
            padding: 0px 65px 0px ;
        }
        .describe {
            display: flex;
            width: 1450px;
        }

        .poster {
            width: 300px;
            height: 400px;
            padding-top: 20px;
        }
        .poster img {
            width: 100%;
            height: 100%;
            border-radius: 10px;
        }
        
        .title-pos-main {
            color: aliceblue;
            font-size: 25px;
            text-align: center;
        }
        .content {
            color: aliceblue;
            width: 700px;
            margin: 0px 50px 0px 20px ;
            font-size: 18px;
            

        }
        .small1-container3 {
            width: 1085px;
        }

        .follow {
            padding: 30px 0px;
        }
        .follow a {
            color: aliceblue;
            text-decoration: none;
            font-size: 26px;

        }
        .follow a:hover {
            color: red;
            transition: all 0.5s ease;

        }

        /* Comment */
        /* box-cmt1 */

        .comment .box-cmt1 input[type="text"] {
            width: calc(100% - 60px);
            padding: 10px;
            margin-bottom: 20px;
            border: none;
            border-radius: 20px;
            background-color: #444;
            color: #fff;
            outline: none;
            margin-right: 10px;
            font-size: 20px;
            transition: background-color 0.3s;
            margin-top: 70px;
        }
        .comment .box-cmt1 input[type="text"]:focus {
            background-color: #555;
        }
        .comment .box-cmt1 button {
            padding: 10px 20px;
            border: none;
            border-radius: 20px;
            background-color: #f56;
            color: #fff;
            font-size: 14px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .comment .box-cmt1 button:hover {
            background-color: #f33;
        }



        /* box-cmt2 */
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

        /* small2-container3 */

        .small2-container3 .other {
            padding: 0px 35px 0px 15px;
        }
        
        .small2-container3 .other_movies {
            width: 270px;
            height: 170px;
            padding-bottom: 20px ;
            transition: transform 0.3s ease;
        }
        .small2-container3 .other_movies:hover {
            transform: scale(1.1);

        }

        .small2-container3 .other_movies img {
            width: 100%;
            height: 100%;
            border-radius: 10px;
        
        }
        .small2-container3 .other p {
            color: aliceblue;
            font-size: 26px;
        }
        /* small2-container3 */
        .other {
        padding: 0px 20px;
        }

        .other_movies {
            width: 270px;
            height: 170px;
            padding-bottom: 20px ;
            transition: transform 0.3s ease;

        }
        .other_movies:hover {
            transform: scale(1.1);
        }
        .other_movies img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 10px;
        }

        .other p {
            color: aliceblue;
            font-size: 26px;
            margin-bottom: 20px;
        }

        

        /* Container4 */
        .container4 {
            padding: 150px 0px 35px 65px;
        }
        .recommend {
            color: aliceblue;
            font-size: 26px;
        }

        .movies {
            display: flex;
        }
        .movies div  {
            width: 1700px;
            height: 450px;
            padding: 10px 65px 50px 0px;
            transition: transform 0.3s ease;
        }
        .movies div:hover {
            transform: scale(1.1);

        }
        .movies img {
            width: 100%;
            height: 100%;
            border-radius: 15px;
        }

        
        .movies .recommend-type {
            color: aliceblue;
            font-size: 20px;
            text-align: center;
        }

</style>

<?php
    require_once('../model/connect.php');

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
} else {
    die("Không có thông tin phim.");
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
                                <i class="fa-solid fa-heart"></i> <?php echo $is_favorite ? 'Đã yêu thích' : 'Yêu thích'; ?>
                            </button>
                        </form>
                    </div>
                </div>
                <div class="poster-content">
                    <p class="title-pos-main"><?php echo htmlspecialchars($movie['title']); ?></p>
                    <p class="content"><?php echo htmlspecialchars($movie['description']); ?></p>
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