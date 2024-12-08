<?php require_once('../model/connect.php')?>
<style>
/* Container của slider */
.slider {
    position: relative;
    width: 100%;
    margin: auto;
    overflow: hidden; /* Ẩn các phần vượt quá slider */
}
.slideshow {
    display: flex;
    width: 100%; /* Tổng chiều rộng là số lượng slide nhân 100% */
    height: 700px;
}

.slide {
    width: 100%; /* Mỗi slide chiếm toàn bộ chiều rộng slider */
    flex-shrink: 0; /* Đảm bảo kích thước không co lại */
}
.slide img {
    height: 100%;
    width: 100%;
}

/* Nút đăng ký */
.submit-button-banner {
    position: absolute;
    top: 550px;
    bottom: 400px;
    left: 400px;
    transform: translateX(-50%);
    align-items: center;
    display: flex;
}

.submit-button-banner button {
    width: 250px;
    height: 80px;
    font-size: 30px;
    color: white;
    border-radius: 10px;
    border: 1px solid white;
    background-color: red;
    cursor: pointer;
}

.submit-button-banner button:hover {
    color: white;
    background-color: grey;
    transform: scale(1.1); /* Phóng to nhẹ khi hover */
}

</style>

<!-- Start Slider --> 
<div class="slider">
    <div class="slideshow">
        <?php
        $query = "SELECT movie_id, poster_url FROM movies WHERE poster_url IS NOT NULL LIMIT 5";
        $result = $conn->query($query);

        if ($result && $result->num_rows > 0) {
            while ($movie = $result->fetch_assoc()) {
                echo '
                <div class="slide">
                    <a href="../model/detail_movie.php?movie_id=' . $movie['movie_id'] . '">
                        <img src="' . htmlspecialchars($movie['poster_url']) . '" alt="Phim" style="width: 100vw; height: 1200px;">
                    </a>
                </div>
                ';
            }
        } else {
            echo '<p>Không có phim nào để hiển thị.</p>';
        }
        ?>
    </div>
    <div class="submit-button-banner">
        <a href="../view/register.php">
            <button type="button"><b>Đăng ký ngay</b></button>
        </a>
    </div>
</div>

<!-- End slider -->

    <div class="film-hot">
        <h2 class="title"style= "color: black">Phim Hot</h2>
        <div class="film-img">
            <img src="../assets/image/Hình ảnh/TV & Film Treatment Deck Presentation in Black and White Red Dark & Serious Style 1.jpg">
            <img src="../assets/image/Hình ảnh/TV & Film Treatment Deck Presentation in Black and White Red Dark & Serious Style (1) 1.jpg">
            <img src="../assets/image/Hình ảnh/Yellow and Orange Retro Futuristic Typography Film Title Intro Video 1.jpg">
        </div>
    </div>
    <div class="banner">
        <img src="../assets/image/Hình ảnh/banner con 1.jpg" />
    </div>
    <script>
    // Chọn các phần tử cần thiết
    const slideshow = document.querySelector('.slideshow');
    const slides = document.querySelectorAll('.slide');
    let currentIndex = 0;

    // Tổng số slide
    const totalSlides = slides.length;

    // Hàm chuyển đến slide tiếp theo
    function nextSlide() {
        // Tăng chỉ số hiện tại
        currentIndex++;

        // Nếu vượt quá số slide, quay lại slide đầu tiên
        if (currentIndex >= totalSlides) {
            currentIndex = 0;
        }

        // Di chuyển slideshow
        slideshow.style.transform = `translateX(-${currentIndex * 100}%)`;
    }

    // Tự động chuyển slide sau mỗi 3 giây
    setInterval(nextSlide, 3000);
</script>

