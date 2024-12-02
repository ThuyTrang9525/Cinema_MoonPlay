<?php require_once('../model/connect.php')?>
<style>
/* Container của slider */
.slider {
    position: relative;
    width: 100%;

    margin: auto;
    overflow: hidden; /* Ẩn các phần vượt quá slider */
}

/* Slideshow chứa các slide */
.slideshow {
    display: flex;
    transition: transform 0.5s ease-in-out; /* Hiệu ứng chuyển động mượt */
}

/* Mỗi slide chiếm 100% chiều rộng của slider */
.slide {
   
    box-sizing: border-box;
}

/* Cập nhật ảnh cho phù hợp với chiều rộng và chiều cao */
.slide img {
    height: 1200px; /* Chiều cao cố định 1000px */
    object-fit: cover; /* Đảm bảo ảnh không bị méo, cắt bỏ phần thừa */
    display: block; /* Loại bỏ khoảng trắng dưới ảnh */
}

/* Nút đăng ký */
.submit-button-banner {
    position: absolute;
    bottom: 10%;
    left: 20%;
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
                        <img src="' . htmlspecialchars($movie['poster_url']) . '" alt="Phim" style = "width: 100vw ; height: 1200px ">
                    </a>
                    <div class="submit-button-banner">
                    <a href="register.php">
                        <button type="button"><b>Đăng ký ngay</b></button>
                    </a>
                </div>
                </div>
                ';
            }
        } else {
            echo '<p>Không có phim nào để hiển thị.</p>';
        }
        ?>
        <!-- Nút đăng ký -->
    
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
document.addEventListener("DOMContentLoaded", function () {
    const slideshow = document.querySelector(".slideshow");
    const slides = document.querySelectorAll(".slide");
    const totalSlides = slides.length;
    let currentIndex = 0;

    // Hàm hiển thị slide tiếp theo
    function showNextSlide() {
        // Ẩn slide hiện tại
        slides[currentIndex].classList.remove('active');

        // Cập nhật chỉ số slide hiện tại
        currentIndex = (currentIndex + 1) % totalSlides;

        // Hiển thị slide mới
        slides[currentIndex].classList.add('active');
    }

    // Tự động chuyển slide mỗi 3 giây
    setInterval(showNextSlide, 3000);

    // Hiển thị slide đầu tiên khi trang tải
    slides[currentIndex].classList.add('active');
});


</script>
