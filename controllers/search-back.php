<style>
    <style>
/* Tạo kiểu cho form tìm kiếm */
.search-form {
    display: flex;
    justify-content: center;
    margin-bottom: 20px;
}

.search-form input {
    padding: 8px;
    font-size: 14px;
    margin-right: 10px;
    width: 200px;
}

.search-form button {
    padding: 8px 12px;
    font-size: 14px;
    background-color: #007bff;
    color: white;
    border: none;
    cursor: pointer;
}

.search-form button:hover {
    background-color: #0056b3;
}

/* Tạo kiểu cho kết quả tìm kiếm */
.row {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
    gap: 20px;
    justify-items: center;
}

.col {
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.col:hover {
    transform: scale(1.05);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
}

.col img {
    width: 100%;
    height: auto;
    object-fit: cover;
}

.col .info {
    padding: 10px;
    text-align: center;
}

.col .info h3 {
    font-size: 16px;
    margin: 10px 0;
    color: #333;
    text-overflow: ellipsis;
    white-space: nowrap;
    overflow: hidden;
}

.col .info p {
    font-size: 14px;
    color: #666;
    margin: 5px 0;
}

.col .info .btn {
    display: inline-block;
    margin-top: 10px;
    padding: 5px 10px;
    font-size: 14px;
    color: white;
    background-color: #007bff;
    border: none;
    border-radius: 4px;
    text-decoration: none;
}

.col .info .btn:hover {
    background-color: #0056b3;
}
</style>


</style>

<?php
// Domain cơ sở để hoàn thiện URL
$base_url = "https://phimimg.com/"; // Sửa lại URL cơ sở cho ảnh

// Hàm gọi API tìm kiếm
function searchFilms($keyword, $limit) {
    $url = "https://phimapi.com/v1/api/tim-kiem?keyword=" . urlencode($keyword) . "&limit=" . intval($limit);
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
if (isset($_GET['keyword'])) {
    $keyword = $_GET['keyword'];

    // Gọi hàm tìm kiếm phim với từ khóa và số lượng
    $films = searchFilms($keyword, 10);

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
            echo '<p>Trạng thái: ' . htmlspecialchars($film['status'] ?? 'Không rõ') . '</p>';
            echo '<a href="../model/detail.php?slug=' . urlencode($film['slug']) . '" class="btn">Xem Chi Tiết</a>';
            echo '</div>'; // End .info
            
            echo '</div>'; // End .col
        }
        
        echo '</div>'; // End .row
    } else {
        echo "<p>Không tìm thấy kết quả nào.</p>";
    }
} else {
    echo "<p>Vui lòng nhập từ khóa và số lượng tìm kiếm.</p>";
}
?>
