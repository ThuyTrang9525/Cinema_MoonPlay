<?php
require_once('../model/connect.php');
$movie_id = isset($_GET['movie_id']) ? intval($_GET['movie_id']) : 2;

// Truy vấn tất cả các thể loại duy nhất từ bảng movies
$query = "SELECT DISTINCT type FROM movies";
$result = $conn->query($query);

// Lưu các thể loại vào mảng
$categories = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $categories[] = $row['type'];
    }
}


$query = "SELECT * FROM movies WHERE movie_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $movie_id);
$stmt->execute();
$result = $stmt->get_result();
$movie = $result->fetch_assoc();
function getMoviesByCategory($conn, $type) {
    $stmt = $conn->prepare("SELECT * FROM movies WHERE type = ?");
    $stmt->bind_param("s", $type);
    $stmt->execute();
    return $stmt->get_result();
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>Trang chủ</title>
</head>
<body>
    <!-- Header -->
    <?php session_start(); ?>
    <?php include('../model/header.php'); ?>
<div class="container-category">
    <!-- Danh sách các thể loại -->
    <?php
    
    foreach ($categories as $category) {
        echo '<div class="mb-4" >';
        echo '<div>';
        echo '<h2>' . htmlspecialchars($category) . '</h2>'; // Tiêu đề thể loại
        echo '</div>';
        echo '</div>'; // Đóng mb-4
        echo '<div class="row">';
        
        $movies = getMoviesByCategory($conn, $category); // Lấy phim theo thể loại
        while ($movie = $movies->fetch_assoc()) {
            echo '
            <div class="col" >
                <a href="../model/detail_movie.php?movie_id=' . $movie['movie_id'] . '">  
                    <img src="' . htmlspecialchars($movie['poster_url']) . '" alt="' . htmlspecialchars($movie['title']) . '" class="img-fluid">
                </a>
            </div>';
        } /// cần phải link tới trang mình cần link chi tiết
        
        echo '</div>'; // Đóng row
        
    }
    ?>
</div>
<!-- Footer -->
<?php include('../model/footer.php'); ?>

</body>
</html>

<?php
$movie_id = isset($_GET['movie_id']) ? intval($_GET['movie_id']) : 1;

$query = "SELECT * FROM movies WHERE movie_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $movie_id);
$stmt->execute();
$result = $stmt->get_result();
$movie = $result->fetch_assoc();

if (!$movie) {
    die("Không tìm thấy phim.");
}
?>

