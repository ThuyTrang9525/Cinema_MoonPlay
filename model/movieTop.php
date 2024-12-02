
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="../assets/css/style.css">
<style>
.upcoming-movies {

}

.upcoming-movies .movie {
    display:flex;
    gap: 35px
}

.upcoming-movies .movie a {
    width: 450px;

}

.upcoming-movies .movie img {
    width: 435px;
}


</style>

<body>
<?php include('../model/connect.php'); ?>
    <div class="container">
        <!-- Section: Top movies -->
        <div class="section-title">TOP PHIM ĐẶC SẮC</div>
        <div class="top-movies">
            <div class="movie">
                <img alt="Movie poster of Trận Chiến Thời Tiền Sử" src="https://storage.googleapis.com/a1aa/image/ilhEifGsW4WpbSaZTg36SbCFU4Lliv0WhInWefsevjPksPOPB.jpg" />
                <div class="rank">1</div>
            </div>
            <div class="movie">
                <img alt="Movie poster of Người Con Trai" src="https://storage.googleapis.com/a1aa/image/tWNvagzevmQgQquJK7fEi8hheLQL2pbTcZxaEEuLkOZB2HnnA.jpg" />
                <div class="rank">2</div>
            </div>
            <div class="movie">
                <img alt="Movie poster of Knights of Zodiac" src="https://storage.googleapis.com/a1aa/image/fsgN91a69X1WciJw8sgrCn3LOBhbzuE4Lwf6DQUvZ9CM7jzTA.jpg" />
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
                    $query = "SELECT movie_id, poster_url FROM movies WHERE movie_id % 7 = 0 AND poster_url IS NOT NULL LIMIT 5";
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
        </div>
    </div>
</body>
</html>
