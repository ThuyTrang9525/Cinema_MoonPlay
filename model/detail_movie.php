
<link rel="stylesheet" href="../assets/css/detailMovie.css">
<?php
session_start();
require_once '../model/connect.php';

// Kiểm tra xem người dùng đã đăng nhập chưa
if (!isset($_SESSION['user_id'])) {
    header("Location: ../view/login.php"); // Chuyển hướng nếu chưa đăng nhập
    exit();
}

$user_id = $_SESSION['user_id'];

// Kiểm tra trạng thái đăng ký từ cơ sở dữ liệu và đồng bộ với $_SESSION
$sql = "SELECT subscription_status FROM users WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (!$user || $user['subscription_status'] == 0) {
    echo "<script>
        alert('Bạn cần chọn gói dịch vụ để tiếp tục.');
        window.location.href = '../view/package.php';
    </script>";
    exit();
}
$_SESSION['subscription_status'] = $user['subscription_status'];


// Lấy và kiểm tra `movie_id` từ URL
$movie_id = isset($_GET['movie_id']) ? intval($_GET['movie_id']) : 1;

if ($movie_id < 1) {
    die("Phim không hợp lệ.");
}

// Truy vấn thông tin chi tiết phim
$query = "SELECT * FROM movies WHERE movie_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $movie_id);
$stmt->execute();
$result = $stmt->get_result();

if (!$movie = $result->fetch_assoc()) {
    die("Không tìm thấy phim.");
}

// Lấy danh sách phim liên quan
$sql_related = "SELECT * FROM movies WHERE type = ? AND movie_id != ? LIMIT 4";
$stmt_related = $conn->prepare($sql_related);
$stmt_related->bind_param("si", $movie['type'], $movie_id);
$stmt_related->execute();
$result_related = $stmt_related->get_result();
?>

<div class="detailMovie">
<!-- Background -->
<div class="background">
    <img src="<?php echo htmlspecialchars($movie['trailer_url']); ?>" alt="<?php echo htmlspecialchars($movie['title']); ?>">
    <div class="type">
        <div><?php echo htmlspecialchars($movie['type']); ?></div>
    </div>
<!-- Thông tin phim -->

    <div class="infor-movie">
        <div class="poster">
            <div class="poster-img">
                <img src="<?php echo htmlspecialchars($movie['poster_url']); ?>" alt="<?php echo htmlspecialchars($movie['title']); ?>">
            </div>
            <button onclick="window.location.href='../view/movie_showing.php?id=<?php echo $movie_id; ?>'"><i class="fa-solid fa-play"></i> Xem ngay</button>             
        </div>
        <div class="infor">
            <div class="name">
                <h1><?php echo htmlspecialchars($movie['title']); ?></h1>
                <p class="time"><i class="fa-regular fa-clock"></i> <?php echo intval($movie['duration']); ?> phút</p>
            </div>
            <div class="detail">
                <p>Thể loại: <?php echo htmlspecialchars($movie['type']); ?> </p>
                <p>Khởi chiếu: <?php echo intval($movie['release_year']); ?> </p>
            </div>
        </div>
    </div>
</div>

<!-- Mô tả phim -->
<div class="describe-movie">
    <p><?php echo htmlspecialchars($movie['description']); ?></p>
</div>
<div class="title-film"><p>DIỄN VIÊN</p></div>
<div class="actor">
        <div class="performer">
            <div class="voiceover">
                <p><?php echo htmlspecialchars($movie['actor']); ?></p>
            </div>
        </div>
</div>

 <!-- Phim tương tự -->
<div class="title-film">
    <p>Phim liên quan</p>
</div>
<div class="movies">
    <?php while ($related = $result_related->fetch_assoc()): ?>
        <div>
            <a href="detail_movie.php?movie_id=<?php echo $related['movie_id']; ?>">
                <img src="<?php echo htmlspecialchars($related['poster_url']); ?>" alt="<?php echo htmlspecialchars($related['title']); ?>">
            </a>
            <p><?php echo htmlspecialchars($related['title']); ?></p>
        </div>
    <?php endwhile; ?>
</div>
</div>

