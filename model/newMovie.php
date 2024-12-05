<style>
    .film-list {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); /* Tự điều chỉnh số cột */
    gap: 20px; /* Khoảng cách giữa các phim */
    padding: 20px;
    border-radius: 10px;
}

.posterNew {
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Đổ bóng */
    overflow: hidden;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.posterNew:hover {
    transform: scale(1.05); /* Hiệu ứng phóng to khi hover */
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3); /* Tăng độ đổ bóng */
}

.posterNew img {
    width: 100%; /* Chiếm toàn bộ chiều rộng */
    height: 100%; /* Tự động điều chỉnh chiều cao */
    border-bottom: 3px solid #ff4d4d; /* Viền dưới đỏ */
    display: block;
}

.posterNew h3 {
    font-size: 16px; /* Kích thước chữ */
    color: #ffffff; /* Màu chữ trắng */
    text-align: center;
    margin: 10px 0; /* Khoảng cách bên trên và dưới */
    padding: 0 10px; /* Khoảng cách bên trái và phải */
    overflow: hidden; /* Cắt bớt chữ nếu quá dài */
    white-space: nowrap; /* Không xuống dòng */
    text-overflow: ellipsis; /* Hiển thị dấu ... nếu quá dài */
}

.posterNew a {
    text-decoration: none; /* Bỏ gạch chân liên kết */
    color: inherit; /* Giữ màu chữ */
}

.posterNew a:hover h1 {
    color: #ff4d4d; /* Đổi màu chữ khi hover */
}

@media (max-width: 768px) {
    .film-list {
        grid-template-columns: repeat(auto-fill, minmax(150px, 1fr)); /* Điều chỉnh trên màn hình nhỏ */
    }

    .posterNew h3 {
        font-size: 14px; /* Giảm kích thước chữ trên màn hình nhỏ */
    }
}

</style>
<?php
function getFilmList() {
    $url = "https://phimapi.com/danh-sach/phim-moi-cap-nhat?page=10";  // URL lấy danh sách phim
    
    // Lấy dữ liệu từ API bằng file_get_contents
    $response = file_get_contents($url);
    
    // Kiểm tra nếu có lỗi trong việc lấy dữ liệu
    if ($response === false) {
        echo "Lỗi khi lấy dữ liệu từ API.";
        return null;
    }
    // Giải mã dữ liệu JSON thành mảng PHP
    $data = json_decode($response, true);  // Đảm bảo rằng bạn thêm `true` để giải mã thành mảng

    // Kiểm tra nếu giải mã không thành công
    if (json_last_error() !== JSON_ERROR_NONE) {
        echo "Lỗi khi giải mã JSON. Error: " . json_last_error_msg();
        return null;
    }

    return $data;
}

// Lấy danh sách phim
$films = getFilmList();

// Kiểm tra nếu $films không phải là null và tồn tại danh sách phim
if ($films && isset($films['items']) && is_array($films['items'])) {
    echo "<h2>Phim mới cập nhật hôm nay</h2>";
    echo "<div class='film-list'>";
    // Duyệt qua danh sách phim
    foreach ($films['items'] as $film) {
        // Kiểm tra xem poster và tên phim có tồn tại không
        if (isset($film['poster_url']) && isset($film['name'])) {
            echo "<div class='posterNew'>";         
            // Liên kết đến chi tiết phim
            echo "<a href='../model/detail.php?slug=" . urlencode($film['slug']) . "'>";      
            // Hiển thị poster phim
            echo "<img src='" . htmlspecialchars($film['poster_url']) . "' alt='" . htmlspecialchars($film['name']) . "' />";
            echo "</a>";
            echo "</div>";
        }
    }
    
    echo "</div>";
} else {
    echo "<p>Không tìm thấy phim nào.</p>";
}
?>
