<?php

// Hàm lấy thông tin chi tiết phim từ API
function getFilmDetails($slug) {
    $url = "https://phimapi.com/phim/" . urlencode($slug); 
    $response = @file_get_contents($url);

    if ($response === false) {
        echo "<p class='error'>Không thể kết nối đến API. Vui lòng thử lại sau.</p>";
        return null;
    }

    $data = json_decode($response, true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        echo "<p class='error'>Lỗi khi giải mã JSON: " . json_last_error_msg() . ".</p>";
        return null;
    }

    return $data;
}

// Lấy slug từ URL
$slug = isset($_GET['slug']) ? htmlspecialchars($_GET['slug']) : '';

if ($slug) {
    // Lấy thông tin chi tiết phim từ API
    $film = getFilmDetails($slug);

    if ($film && isset($film['movie'])) {
        $filmData = $film['movie'];
        ?>
        <div class="movie-showing">
            <!-- Thông tin phim -->
            <div class="infor-movie">
                <div class="infor">
                    <h1><?php echo htmlspecialchars($filmData['name']); ?></h1>
                    <p>Thể loại: <?php echo htmlspecialchars($filmData['type']); ?></p>
                    <p>Khởi chiếu: <?php echo intval($filmData['year']); ?></p>
                    <p>Tên gốc: <?php echo htmlspecialchars($filmData['origin_name']); ?></p>
                    <p>Thời gian: <?php echo intval($filmData['time']); ?> phút</p>
                    <p><?php echo htmlspecialchars($filmData['content']); ?></p>
                </div>
            </div>

            <!-- Video Player -->
            <div class="movie-player">
            <div class="screen">
    <?php
    // Kiểm tra nếu 'episodes' tồn tại và là một mảng hợp lệ
    if (isset($filmData['episodes']) && is_array($filmData['episodes']) && !empty($filmData['episodes'])) {
        // Lặp qua các tập phim
        foreach ($filmData['episodes'] as $episode) {
            // Kiểm tra nếu 'server_data' tồn tại và là một mảng hợp lệ
            if (isset($episode['server_data']) && is_array($episode['server_data']) && !empty($episode['server_data'])) {
                // Lặp qua từng server_data để lấy link_embed
                foreach ($episode['server_data'] as $server) {
                    // Kiểm tra nếu 'link_embed' tồn tại và không rỗng
                    if (isset($server['link_embed']) && !empty($server['link_embed'])) {
                        echo '<h2>' . htmlspecialchars($episode['name']) . '</h2>';
                        echo '<iframe class="video" src="' . htmlspecialchars($server['link_embed']) . '" frameborder="0" allowfullscreen></iframe>';
                    } else {
                        echo '<p>Không có video cho tập này.</p>';
                    }
                }
            } else {
                echo '<p>Không có server data cho tập này.</p>';
            }
        }
    } else {
        echo '<p>Không có tập phim nào để hiển thị.</p>';
    }
    ?>
</div>
            </div>
        </div>
        <?php
    } else {
        echo "<p class='error'>Không tìm thấy thông tin phim.</p>";
    }
} else {
    echo "<p class='error'>Slug phim không được cung cấp hoặc không hợp lệ.</p>";
}
?>
