
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="../assets/css/style.css">
<style>
.upcoming-movies {
    display: flex;
    flex-wrap: wrap; /* Cho phép các phần tử gói lại thành nhiều dòng */
    gap: 35px;
    width: 100%;
}

.upcoming-movies .movie {
    display: flex;
    min-width: 290px;
    flex-direction: row;
    gap: 10px;
}

.upcoming-movies .movie a {
    width: 100%; /* Đảm bảo các liên kết chiếm toàn bộ chiều rộng của phần tử */
}

.upcoming-movies .movie img {
    width: 100%; /* Đảm bảo ảnh chiếm toàn bộ chiều rộng của phần tử */
    height: 100%; /* Giữ tỷ lệ khung hình của ảnh */
}


</style>

<body>
<?php include('../model/connect.php'); ?>
    <div class="container">
        <!-- Section: Top movies -->
        <div class="section-title">TOP PHIM ĐẶC SẮC</div>
        <div class="top-movies">
            <div class="movie">
            <?php
                    $query = "SELECT movie_id, poster_url FROM movies WHERE movie_id % 9 = 0 AND poster_url IS NOT NULL LIMIT 1";
                    $result = $conn->query($query);

                    if ($result && $result->num_rows > 0) {
                        while ($movie = $result->fetch_assoc()) {
                            echo '
                            
                                <a href="../model/detail_movie.php?movie_id=' . $movie['movie_id'] . '">
                                    <img src="' . htmlspecialchars($movie['poster_url']) . '" alt="Phim" >
                                </a>
                            ';
                        }
                    } else {
                        echo '<p>Không có phim nào để hiển thị.</p>';
                    }
                ?>
                <div class="rank">1</div>
            </div>
            <div class="movie">
            <?php
                    $query = "SELECT movie_id, poster_url FROM movies WHERE movie_id % 17 = 0 AND poster_url IS NOT NULL LIMIT 1";
                    $result = $conn->query($query);

                    if ($result && $result->num_rows > 0) {
                        while ($movie = $result->fetch_assoc()) {
                            echo '
                            
                                <a href="../model/detail_movie.php?movie_id=' . $movie['movie_id'] . '">
                                    <img src="' . htmlspecialchars($movie['poster_url']) . '" alt="Phim" >
                                </a>
                            ';
                        }
                    } else {
                        echo '<p>Không có phim nào để hiển thị.</p>';
                    }
                ?>
                <div class="rank">2</div>
            </div>
            <div class="movie">
            <?php
                    $query = "SELECT movie_id, poster_url FROM movies WHERE movie_id % 23 = 0 AND poster_url IS NOT NULL LIMIT 1";
                    $result = $conn->query($query);

                    if ($result && $result->num_rows > 0) {
                        while ($movie = $result->fetch_assoc()) {
                            echo '
                            
                                <a href="../model/detail_movie.php?movie_id=' . $movie['movie_id'] . '">
                                    <img src="' . htmlspecialchars($movie['poster_url']) . '" alt="Phim" >
                                </a>
                            ';
                        }
                    } else {
                        echo '<p>Không có phim nào để hiển thị.</p>';
                    }
                ?>
                <div class="rank">3</div>
            </div>
        </div>

        <!-- Section: Banner -->
        <div class="banner">
            <img alt="Banner for The Deal series" src="../assets/image/bannercon2.jpg" />
        </div>

        <!-- Section: Explore -->
        <div class="section-title">Khám phá</div>
        <div class="explore">
            <div class="category">Phim Chiếu rạp</div>
            <div class="category">Phim Cổ trang</div>
            <div class="category">Phim Hành động</div>
        </div>

        <!-- Section: Upcoming movies -->
        <div class="section-title">Phim sắp chiếu</div>
        <div class="upcoming-movies">
            <div class="movie">
                <?php
                    $query = "SELECT movie_id, poster_url FROM movies WHERE movie_id % 7 = 0 AND poster_url IS NOT NULL LIMIT 4";
                    $result = $conn->query($query);

                    if ($result && $result->num_rows > 0) {
                        while ($movie = $result->fetch_assoc()) {
                            echo '
                            
                                <a href="../model/detail_movie.php?movie_id=' . $movie['movie_id'] . '" >
                                    <img src="' . htmlspecialchars($movie['poster_url']) . '" alt="Phim" >
                                </a>
                            ';
                        }
                    } else {
                        echo '<p>Không có phim nào để hiển thị.</p>';
                    }
                ?>
            </div>
        </div>
    </div>
</body>
</html>
