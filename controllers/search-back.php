<link rel="stylesheet" href="../assets/css/search.css">
<?php
// Domain cơ sở để hoàn thiện URL
$base_url = "https://phimimg.com/";

// Hàm gọi API tìm kiếm
function searchFilms($keyword) {
    $url = "https://phimapi.com/v1/api/tim-kiem?keyword=" . urlencode($keyword);
    $response = @file_get_contents($url);

    if ($response === false) {
        echo "<p class='error'>Không thể kết nối đến API với URL: $url.</p>";
        return null;
    }

    $data = json_decode($response, true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        echo "<p class='error'>Lỗi khi giải mã JSON: " . json_last_error_msg() . ".</p>";
        return null;
    }

    return $data;
}

if (isset($_POST['search_query'])) {
    $keyword = $_POST['search_query'];

    // Gọi hàm tìm kiếm phim với từ khóa và số lượng
    $films = searchFilms($keyword);

    if ($films && isset($films['data']['items']) && is_array($films['data']['items'])) {
        
        echo "<h2>Kết quả tìm kiếm cho: '$keyword'</h2>";
        echo '<div class="row">';
        // Hiển thị danh sách phim
        foreach ($films['data']['items'] as $film) {
            echo '<div class="col">';
            
            // Ảnh poster
            echo '<a href="../model/detail.php?slug=' . urlencode($film['slug']) . '">';
            $poster_url = strpos($film['poster_url'], 'http') === 0 ? $film['poster_url'] : $base_url . $film['poster_url'];
            echo '<img src="' . htmlspecialchars($poster_url) . '" alt="' . htmlspecialchars($film['name']) . '" class="img-fluid">';
            echo '</a>';
            
            // Thông tin phim
            echo '<div class="info">';
            echo '<h3>' . htmlspecialchars($film['name']) . '</h3>';
            echo '<p>Năm: ' . htmlspecialchars($film['year'] ?? 'Không rõ') . '</p>';
            echo '<p>Time: ' . htmlspecialchars($film['time'] ?? 'Không rõ') . '</p>';
            echo '<a href="../model/detail.php?slug=' . urlencode($film['slug']) . '" class="btn">Xem Chi Tiết</a>';
            echo '</div>'; // End .info
            
            echo '</div>'; // End .col
        }
        
        echo '</div>'; // End .row
    } else {
        echo "<p>Không tìm thấy kết quả nào.</p>";
    }
} else {
    echo "<p>Vui lòng nhập từ khóa</p>";
}
?>
