<style>
    body{
        background-color: black;
        z-index: -1;
    }
    .detailMovie{

    min-height: 100vh;
}
/* background */
.background {
    height: 700px;
    width: 100%;
    padding-top: 50px;
    position: absolute;
}
.background img {
    width: 100%;
    height: 100%;
}

.type {
    display: flex;
    justify-content: flex-end; 
    color: aliceblue;
    position: absolute;
    bottom: 10px; 
    right: 20px; 
    gap: 15px; 
}

.type div {
    border: 1px solid white;
    border-radius: 10px;
    padding: 10px 15px;
    margin-top: 20px;
}

/* container*/

.infor-movie {
    display: flex;
    position: absolute;
    top: 400px;
    padding-left: 70px;
}
.poster {
    position: relative; 
}
.poster-img {
    width: 400px;
    height: 600px;
    margin-top: 20px;
}

.poster-img img {
    width: 400px;
    height: 600px;
    border-radius: 10px;
}
.poster button {
    padding: 13px 20px;
    margin-top: 20px;
    font-size: 26px;
    color: white;
    background-color: red;
    border-radius: 10px;
    width: 100%;
    height: 60px;
    border: none;
    cursor: pointer;
    position: relative; 
    z-index: 10; 
    transition: transform 0.3s ease;

}
.poster button:hover {
    background-color: rgb(137, 137, 137);
    transition: all 0.3s ease;
    color: black;
    transform: scale(1.1);
}


.infor {
    padding-left: 80px;
}
.name {
    font-size: 40px;
    color: white;
}
.name h1 {
    margin-top: 20px;
    margin-bottom: 0;
}
.name .n1 {
    margin-top: 0;
    margin-bottom: 40px;
    font-size: 26px;
}

.name .time {
    margin-bottom: 10px;
    font-size: 35px;
}
.detail {
    padding-top: 100px;
    font-size: 26px;
    color: white;
}

/* describe-movie */
.describe-movie{
    color: rgb(255, 255, 255);
    position: relative; 
    font-size: 20px;
    padding: 1200px 75px 0px 75px;
}
.describe-movie-infomation {
    margin-top: 100px;
}
/* actor */
.title-film {
    font-size: 26px;
    color: aliceblue;
    padding: 30px 70px ;

}

.actor {
    display: flex;
}

.performer {
    padding: 0px 50px 0px 70px;
}

.performer .img {
    width: 180px;
    height: 160px;
    
}

.performer .img img {
    border-radius: 100%;
    width: 100%;
    height: 100%;
}

.voiceover {
    font-size: 20px;
    color: aliceblue;
    text-align: center;
}

/* Movies */
.movies {
    display: flex;
}
.movies div {
    width: 1600px;
    height: 400px;
    padding: 10px 50px;
    transition: transform 0.3s ease;
    cursor: pointer;
}
.movies div:hover {
    transform: scale(1.1);
}
.movies img {
    width: 100%;
    height: 100%;
    border-radius: 15px;
}
/* Loại bỏ gạch chân khỏi tên phim */
.movie-item a {
    text-decoration: none;
    color: white; /* Đặt màu chữ theo ý thích */
}


.movie-item a:hover {
    color: #ff4d4d; /* Màu sắc nổi bật khi hover */
}

/* Cải thiện giao diện danh sách phim */
.movies-list {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    justify-content: center;
    padding: 20px;
    background-color: #1c1c1c; /* Màu nền tối cho danh sách phim */
    border-radius: 10px;
}

/* Giao diện từng mục phim */
.movie-item {
    width: 250px;
    background-color: #282828; /* Nền từng mục */
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    overflow: hidden;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.movie-item:hover {
    transform: scale(1.05);
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
}

.movie-item img {
    width: 100%;
    height: 350px;
    object-fit: cover;
    border-bottom: 3px solid #ff4d4d;
}

.movie-item h3 {
    font-size: 20px;
    margin: 10px;
    text-align: center;
    font-weight: 600;
    color: white;
}

.movie-description {
    font-size: 14px;
    color: #d1d1d1;
    padding: 10px;
    text-align: justify;
    max-height: 100px;
    overflow: hidden;
    position: relative;
}

.movie-description::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 20px;
    background: linear-gradient(to bottom, transparent, #282828);
}

.actor-list {
    color: white;
    font-size: 18px;
    padding: 20px 70px;
}

.actor-list ul {
    list-style-type: none;
    padding: 0;
}

.actor-list li {
    margin-bottom: 10px;
    border-bottom: 1px solid #555;
    padding-bottom: 5px;
}

</style>

<?php

// Hàm lấy thông tin chi tiết phim từ API
function getFilmDetails($slug) {
    $url = "https://phimapi.com/phim/" . urlencode($slug); // URL đúng với slug
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


// Lấy slug từ URL
$slug = isset($_GET['slug']) ? $_GET['slug'] : ''; // Lấy slug từ URL

if ($slug) {
    // Lấy thông tin chi tiết phim từ API
    $film = getFilmDetails($slug);

    if ($film && isset($film['movie'])) {
        $filmData = $film['movie']; // Lấy thông tin chi tiết phim
      
    

        if ($film && isset($film['episodes'][0]['server_data'])) {
            // Lấy danh sách server_data
            $serverData = $film['episodes'][0]['server_data'];
        
            // Kiểm tra và lấy link_embed của tập đầu tiên
            if (!empty($serverData[0]['link_embed'])) {
                $videoLink = $serverData[0]['link_embed'];
                echo "Link video đầu tiên: " . $videoLink;
            } else {
                echo "Không tìm thấy link video!";
            }
        }
     
        // Ánh xạ tiêu đề có dấu
        $typeTitles = [
            "phim-le" => "Phim lẻ",
            "phim-bo" => "Phim bộ",
            "hoat-hinh" => "Hoạt hình",
            "tv-shows" => "TV Shows"
        ];
        
     
        $actors = isset($filmData['actor']) ? $filmData['actor'] : [];
                // Hiển thị thông tin phim
                ?>
                <div class="detailMovie">
                    <!-- Background -->
                    <div class="background">
                        <img src="<?php echo htmlspecialchars($filmData['thumb_url']); ?>" alt="<?php echo htmlspecialchars($filmData['name']); ?>">
                        <div class="type">
                            <div><?php echo htmlspecialchars($filmData['type']); ?></div>
                        </div>
                    </div>

                    <!-- Thông tin phim -->
                    <div class="infor-movie">
                        <div class="poster">
                            <div class="poster-img">
                                <img src="<?php echo htmlspecialchars($filmData['poster_url']); ?>" alt="<?php echo htmlspecialchars($filmData['name']); ?>">
                            </div>
                            <button onclick="window.location.href='../view/showing.php?slug=<?php echo urlencode($slug); ?>'"><i class="fa-solid fa-play"></i> Xem ngay</button>
                        </div>
                        <div class="infor">
                            <div class="name">
                                <h1><?php echo htmlspecialchars($filmData['name']); ?></h1>
                                
                            </div>
                            <div class="detail">
                                
                                <p>Thể loại: <?php echo htmlspecialchars($filmData['type']); ?> </p>
                                <p class="time"><i class="fa-regular fa-clock"></i> <?php echo intval($filmData['time']); ?> phút</p>
                                <p>Khởi chiếu: <?php echo intval($filmData['year']); ?> </p>
                                <p>Tên gốc: <?php echo htmlspecialchars($filmData['origin_name']); ?></p>
                                <p>Thời lượng: <?php echo intval($filmData['time']); ?> phút</p>
                                <p>Diễn viên:</p>
                                <?php
                                    if (!empty($actors)) {
                                        // Chuyển mảng thành chuỗi, ngăn cách bằng dấu phẩy
                                        echo "<p class='actor-list'>" . htmlspecialchars(implode(', ', $actors)) . "</p>";
                                    } else {
                                        echo "<p>Không có thông tin diễn viên.</p>";
                                    }
                                ?>

                            </div>
                        </div>
                    </div>

                    <!-- Mô tả phim -->
                    <div class="describe-movie">
                        <p><?php echo htmlspecialchars($filmData['content']); ?></p>
                    </div> 
                            
                </div>
                <?php
            } else {
                echo "<p>Không tìm thấy thông tin phim.</p>";
            }
        } else {
            echo "<p>Slug phim không được cung cấp.</p>";
        }


