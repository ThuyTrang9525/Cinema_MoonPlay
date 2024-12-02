<link rel="stylesheet" href="../assets/css/style.css">
    <h2>Top 5 phim hôm nay</h2>
    <div class="top_phim">
        <?php
            $query = "SELECT movie_id, poster_url FROM movies WHERE movie_id % 5 = 0 AND poster_url IS NOT NULL LIMIT 5";
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
    </div>
    <h2>Phim thuê đặc sắc</h2>
    <div class="phim_thue">
    <?php
            $query = "SELECT movie_id, poster_url FROM movies WHERE movie_id % 3 = 0 AND poster_url IS NOT NULL LIMIT 5";
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
    </div>

    <h2>Phim tài liệu thiên nhiên</h2>
    <div class="thien_nhien">
    <?php
            $query = "SELECT movie_id, poster_url FROM movies WHERE movie_id % 2 = 0 AND poster_url IS NOT NULL LIMIT 5";
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
    </div>