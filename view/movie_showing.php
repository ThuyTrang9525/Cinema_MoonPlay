<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie Screening</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body class="movie-show">
    <?php include('../model/header.php'); ?>
    <div class="container1">
        <div class="screen">
            <video controls class="video" src="../assets/image/movie.mp4"></video>
        </div>

        <div class="other">
            <div><p>Các phim tương tự</p></div>
            <div class="other_movies"><img src="../assets/image/demon slayer.jpg" alt=""></div>
            <div class="other_movies"><img src="../assets/image/deadnote.jpg" alt=""></div>
            <div class="other_movies"><img src="../assets/image/Academi.jpg" alt=""></div>
        </div>
    </div>
    
    <div class="container2">
        <div class="title">
            <p class="title-main">Chainsaw Man</p>
            <p class="title-extra">Quỷ Cưa: Thợ Săn Quỷ(2020)</p>
        </div>
        <div class="star-rating">
            <div class="star"><i class="fa-solid fa-star"></i></div>
            <div class="star"><i class="fa-solid fa-star"></i></div>
            <div class="star"><i class="fa-solid fa-star"></i></div>
            <div class="star"><i class="fa-solid fa-star"></i></div>
            <div class="star"><i class="fa-regular fa-star"></i></div>
        </div>
    </div>

    <div class="big-container3">
        <div class="small1-container3">
            <div class="describe">
                <div class="poster">
                    <img src="../assets/image/poster.png" alt="">
                    <div class="follow">
                        <a href="#"><i class="fa-solid fa-heart"></i> Theo dõi</a>
                    </div>
                </div>
                <div class="poster-content">
                    <div class="title-poster">
                        <p class="title-pos-main">Chainsaw Man</p>
                        <p class="title-pos-extra">Quỷ Cưa: Thợ Săn Quỷ(2020)</p>
                    </div>
                    <div>
                        <p class="content">
                            Chainsaw Man là câu chuyện về Denji, một chàng trai nghèo khổ làm thợ săn quỷ để trả nợ, sống cùng chú chó quỷ cưa máy Pochita. 
                            Sau khi bị phản bội và giết chết, Pochita hy sinh bản thân để cứu Denji, biến cậu thành Chainsaw Man với sức mạnh quỷ cưa máy. 
                            Denji sau đó gia nhập tổ chức săn quỷ công, chiến đấu với quỷ dữ và khám phá ý nghĩa của tự do, tình yêu, cũng như khát vọng sống. 
                            Bộ truyện nổi bật với sự kết hợp giữa hành động, kinh dị, hài hước và những khoảnh khắc xúc động sâu sắc.
                        </p>
                    </div>
                </div>
            </div>
            <div class="title-cmt">
                <p>1 bình luận</p>
            </div>
            <div class="comment">
                <div class="box-cmt1">
                    <div class="fill-cmt1">
                        <div class="avt">
                            <img src="../assets/image/Kikunosuke_Toya.webp" alt="">
                        </div>
                        <div class="input-cmt">
                            <input type="text" placeholder = "Viết bình luận của bạn..." >
                        </div>
                    </div>
                </div>
                <div class="box-cmt2">
                    <div class="fill-cmt2">
                        <div class="avt">
                            <img src="../assets/image/Kikunosuke_Toya.webp" alt="">
                        </div>
                        <div class="commented">
                            <p class="name">Hồ Đức Thiện</p>
                            <p class="cmt">Phim rất hay !</p>
                            <div class="star-rating-cmt">
                                <div class="star-cmt"><i class="fa-solid fa-star"></i></div>
                                <div class="star-cmt"><i class="fa-solid fa-star"></i></div>
                                <div class="star-cmt"><i class="fa-solid fa-star"></i></div>
                                <div class="star-cmt"><i class="fa-solid fa-star"></i></div>
                                <div class="star-cmt"><i class="fa-regular fa-star"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div  class="small2-container3">
            <div class="other">
                <div><p>Các phim tương tự</p></div>
                <div class="other_movies"><img src="../assets/image/demon slayer.jpg" alt=""></div>
                <div class="other_movies"><img src="../assets/image/deadnote.jpg" alt=""></div>
                <div class="other_movies"><img src="../assets/image/Academi.jpg" alt=""></div>
                <div class="other_movies"><img src="../assets/image/dandadan-1728028147188432692569-17292205553731588090856.jpg" alt=""></div>
            </div>
        </div>
    </div>
    <div class="container4">
        <p class="recommend">Có thể bạn muốn xem</p>
        <div class="movies">
            <div><img src="../assets/image/kaiju-no-8.avif" alt=""></div>
            <div><img src="../assets/image/demon-slayer.avif" alt=""></div>
            <div><img src="../assets/image/attack-on-titan-eren-yeager-i195752.jpg" alt=""></div>
            <div><img src="../assets/image/61L74z3bhXS._AC_UF894,1000_QL80_.jpg" alt=""></div>
        </div>
    </div>
    <!-- Footer -->
    <?php include('../model/footer.php'); ?>
</body>
</html>